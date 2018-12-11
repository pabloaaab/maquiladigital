<?php

namespace app\controllers;

use app\models\Ordenproducciondetalleproceso;
use app\models\ProcesoProduccion;
use Yii;
use app\models\Ordenproduccion;
use app\models\Ordenproducciondetalle;
use app\models\OrdenproduccionSearch;
use app\models\Ordenproducciontipo;
use app\models\Cliente;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FormFiltroOrdenProduccionProceso;
use app\models\Producto;
use yii\db\ActiveQuery;
use yii\base\Model;
use yii\web\Response;
use yii\web\Session;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use Codeception\Lib\HelperModule;

/**
 * OrdenProduccionController implements the CRUD actions for Ordenproduccion model.
 */
class OrdenProduccionController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ordenproduccion models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new OrdenproduccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ordenproduccion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $modeldetalles = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $id])->all();
        $modeldetalle = new Ordenproducciondetalle();
        $mensaje = "";
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modeldetalle' => $modeldetalle,
                    'modeldetalles' => $modeldetalles,
                    'mensaje' => $mensaje,
        ]);
    }

    /**
     * Creates a new Ordenproduccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Ordenproduccion();
        $clientes = Cliente::find()->all();
        $ordenproducciontipos = Ordenproducciontipo::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->totalorden = 0;
            $model->estado = 0;
            $model->autorizado = 0;
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->update();
            return $this->redirect(['view', 'id' => $model->idordenproduccion]);
        }

        return $this->render('create', [
                    'model' => $model,
                    'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
                    'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
        ]);
    }

    /**
     * Updates an existing Ordenproduccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $clientes = Cliente::find()->all();
        $ordenproducciontipos = Ordenproducciontipo::find()->all();
        if (Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $id])->all() or $model->facturado == 1) {
            Yii::$app->getSession()->setFlash('warning', 'No se puede modificar la información, tiene detalles asociados');
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idordenproduccion]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
                    'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
        ]);
    }

    /**
     * Deletes an existing Ordenproduccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
            $this->redirect(["orden-produccion/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["orden-produccion/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar la orden de producción, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar la orden de producción, tiene registros asociados en otros procesos');
            $this->redirect(["orden-produccion/index"]);
        }
    }

    public function actionAutorizado($id) {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->autorizado == 0) {
            $detalles = Ordenproducciondetalle::find()
                    ->where(['=', 'idordenproduccion', $id])
                    ->all();
            $totalcantidad = 0;
            foreach ($detalles as $val){
                $totalcantidad = $totalcantidad + $val->cantidad;
            }
            $reg = count($detalles);
            if ($reg <> 0) {
                $model->autorizado = 1;
                $model->cantidad = $totalcantidad;
                $model->update();
                $this->redirect(["orden-produccion/view", 'id' => $id]);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Para autorizar el registro, debe tener productos relacionados en la orden de producción.');
                $this->redirect(["orden-produccion/view", 'id' => $id]);
            }
        } else {
            $model->autorizado = 0;
            $model->update();
            $this->redirect(["orden-produccion/view", 'id' => $id]);
        }
    }

    public function actionNuevodetalles($idordenproduccion, $idcliente) {
        $ordenProduccion = Ordenproduccion::findOne($idordenproduccion);
        $productosCliente = Producto::find()->where(['=', 'idcliente', $idcliente])->andWhere(['=', 'idtipo', $ordenProduccion->idtipo])->andWhere(['>', 'stock', 0])->all();
        foreach ($productosCliente as $value) {
            if ($value->cantidad < $value->stock) {
                Yii::$app->getSession()->setFlash('warning', 'Hay stock que no fueron descontados en la facturacion, no se generó en la orden completa, generar el descargue de las unidades');
            }
        }
        $ponderacion = 0;
        $error = 0;
        if (isset($_POST["idproducto"])) {
            $intIndice = 0;
            foreach ($_POST["idproducto"] as $intCodigo) {
                if ($_POST["stock"][$intIndice] > 0) {
                    $detalles = Ordenproducciondetalle::find()
                            ->where(['=', 'idordenproduccion', $idordenproduccion])
                            ->andWhere(['=', 'idproducto', $intCodigo])
                            ->all();
                    $reg = count($detalles);
                    if ($reg == 0) {
                        $producto = Producto::findOne($intCodigo);
                        if ($_POST["stock"][$intIndice] <= $producto->cantidad) {//se valida que la cantidad a ingresar no sea mayor a la cantidad disponible                            
                            if ($producto->cantidad > $producto->stock and $producto->stock > 0) {
                                $error = 2;
                            } else {
                                $table = new Ordenproducciondetalle();
                                $table->idproducto = $_POST["idproducto"][$intIndice];
                                $table->cantidad = $_POST["stock"][$intIndice];
                                $table->vlrprecio = $_POST["vlrventa"][$intIndice];
                                $table->codigoproducto = $_POST["codigoproducto"][$intIndice];
                                $table->subtotal = $_POST["stock"][$intIndice] * $_POST["vlrventa"][$intIndice];
                                $table->idordenproduccion = $idordenproduccion;
                                $table->ponderacion = $ordenProduccion->ponderacion;
                                $table->insert();
                                $ordenProduccion->totalorden = $ordenProduccion->totalorden + $table->subtotal;
                                $ordenProduccion->update();
                            }
                        } else {
                            $error = 1;
                        }
                    }
                }
                $intIndice++;
            }
            if ($error == 1) {
                Yii::$app->getSession()->setFlash('error', 'El valor de la cantidad no puede ser mayor a la cantidad disponible');
                if ($error == 2) {
                    Yii::$app->getSession()->setFlash('warning', 'Hay stock que no fueron descontados en la facturacion, no se generó en la orden completa, generar el descargue de las unidades');
                }
            } else {
                $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
            }
        }

        return $this->render('_formnuevodetalles', [
                    'productosCliente' => $productosCliente,
                    'idordenproduccion' => $idordenproduccion,
        ]);
    }

    public function actionEditardetalle() {
        $iddetalleorden = Html::encode($_POST["iddetalleorden"]);
        $idordenproduccion = Html::encode($_POST["idordenproduccion"]);
        $error = 0;
        if (Yii::$app->request->post()) {

            if ((int) $iddetalleorden) {
                $table = Ordenproducciondetalle::findOne($iddetalleorden);
                $producto = Producto::findOne($table->idproducto);
                if ($table) {

                    $table->cantidad = Html::encode($_POST["cantidad"]);
                    $table->vlrprecio = Html::encode($_POST["vlrprecio"]);
                    $table->subtotal = Html::encode($_POST["cantidad"]) * Html::encode($_POST["vlrprecio"]);
                    $table->idordenproduccion = Html::encode($_POST["idordenproduccion"]);

                    $ordenProduccion = Ordenproduccion::findOne($table->idordenproduccion);

                    $ordenProduccion->totalorden = $ordenProduccion->totalorden - Html::encode($_POST["subtotal"]);
                    $ordenProduccion->totalorden = $ordenProduccion->totalorden + $table->subtotal;
                    if (Html::encode($_POST["cantidad"]) <= $producto->stock) {//se valida que la cantidad a ingresar no sea mayor a la cantidad disponible
                        if ($producto->cantidad > $producto->stock and $producto->stock > 0) {
                            $error = 2;
                        } else {
                            $table->update();
                            $ordenProduccion->update();
                            $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'El valor de la cantidad no puede ser mayor a la cantidad disponible');
                        $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                    }
                    if ($error == 2) {
                        Yii::$app->getSession()->setFlash('warning', 'Hay stock que no fueron descontados en la facturacion, no se generó en la orden completa, generar el descargue de las unidades');
                    }
                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                    $tipomsg = "danger";
                }
            }
        }
        //return $this->render("_formeditardetalle", ["model" => $model,]);
    }

    public function actionEditardetalles($idordenproduccion) {
        $mds = Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $idordenproduccion])->all();
        $error = 0;
        if (isset($_POST["iddetalleorden"])) {
            $intIndice = 0;
            foreach ($_POST["iddetalleorden"] as $intCodigo) {
                if ($_POST["cantidad"][$intIndice] > 0) {
                    $table = Ordenproducciondetalle::findOne($intCodigo);
                    $subtotal = $table->subtotal;
                    $table->cantidad = $_POST["cantidad"][$intIndice];
                    $table->vlrprecio = $_POST["vlrprecio"][$intIndice];

                    $table->subtotal = $_POST["cantidad"][$intIndice] * $_POST["vlrprecio"][$intIndice];

                    $ordenProduccion = Ordenproduccion::findOne($idordenproduccion);
                    $ordenProduccion->totalorden = $ordenProduccion->totalorden - $subtotal;
                    $ordenProduccion->totalorden = $ordenProduccion->totalorden + $table->subtotal;
                    $producto = Producto::findOne($intCodigo);
                    if ($_POST["cantidad"][$intIndice] <= $table->stock) {//se valida que la cantidad a ingresar no sea mayor a la cantidad disponible
                        if ($producto->cantidad > $producto->stock and $producto->stock > 0) {
                            $error = 2;
                        } else {
                            $table->update();
                            $ordenProduccion->update();
                        }
                    } else {
                        $error = 1;
                    }
                }
                $intIndice++;
            }
            if ($error == 1) {
                Yii::$app->getSession()->setFlash('error', 'El valor de la cantidad no puede ser mayor a la cantidad disponible');
                $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
            } else {
                if ($error == 2) {
                    Yii::$app->getSession()->setFlash('warning', 'Hay stock que no fueron descontados en la facturacion, no se generó en la orden completa, generar el descargue de las unidades');
                    $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                } else {
                    $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                }
            }
        }
        return $this->render('_formeditardetalles', [
                    'mds' => $mds,
                    'idordenproduccion' => $idordenproduccion,
        ]);
    }

    public function actionEliminardetalle() {
        if (Yii::$app->request->post()) {
            $iddetalleorden = Html::encode($_POST["iddetalleorden"]);
            $idordenproduccion = Html::encode($_POST["idordenproduccion"]);
            if ((int) $iddetalleorden) {
                $ordenProduccionDetalle = OrdenProduccionDetalle::findOne($iddetalleorden);
                $subtotal = $ordenProduccionDetalle->subtotal;
                if (OrdenProduccionDetalle::deleteAll("iddetalleorden=:iddetalleorden", [":iddetalleorden" => $iddetalleorden])) {
                    $ordenProduccion = OrdenProduccion::findOne($idordenproduccion);
                    $ordenProduccion->totalorden = $ordenProduccion->totalorden - $subtotal;
                    $ordenProduccion->update();
                    $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                } else {
                    echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("orden-produccion/index") . "'>";
                }
            } else {
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("orden-produccion/index") . "'>";
            }
        } else {
            return $this->redirect(["orden-produccion/index"]);
        }
    }

    public function actionEliminardetalles($idordenproduccion) {
        $mds = Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $idordenproduccion])->all();
        $mensaje = "";
        if (Yii::$app->request->post()) {
            $intIndice = 0;

            if (isset($_POST["seleccion"])) {
                foreach ($_POST["seleccion"] as $intCodigo) {
                    $ordenProduccionDetalle = OrdenProduccionDetalle::findOne($intCodigo);
                    $subtotal = $ordenProduccionDetalle->subtotal;
                    if (OrdenProduccionDetalle::deleteAll("iddetalleorden=:iddetalleorden", [":iddetalleorden" => $intCodigo])) {
                        $ordenProduccion = OrdenProduccion::findOne($idordenproduccion);
                        $ordenProduccion->totalorden = $ordenProduccion->totalorden - $subtotal;
                        $ordenProduccion->update();
                    }
                }
                $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
            } else {
                $mensaje = "Debe seleccionar al menos un registro";
            }
        }
        return $this->render('_formeliminardetalles', [
                    'mds' => $mds,
                    'idordenproduccion' => $idordenproduccion,
                    'mensaje' => $mensaje,
        ]);
    }

    public function actionImprimir($id) {

        return $this->render('../formatos/ordenProduccion', [
                    'model' => $this->findModel($id),
        ]);
    }
    
    protected function findModel($id) {
        if (($model = Ordenproduccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionProceso() {
        //if (!Yii::$app->user->isGuest) {
        $form = new FormFiltroOrdenProduccionProceso();
        $idcliente = null;
        $ordenproduccion = null;
        $idtipo = null;
        $clientes = Cliente::find()->all();
        $ordenproducciontipos = Ordenproducciontipo::find()->all();
        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
                $idcliente = Html::encode($form->idcliente);
                $ordenproduccion = Html::encode($form->ordenproduccion);
                $idtipo = Html::encode($form->idtipo);
                $table = Ordenproduccion::find()
                        ->andFilterWhere(['=', 'idcliente', $idcliente])
                        ->andFilterWhere(['like', 'ordenproduccion', $ordenproduccion])
                        ->andFilterWhere(['=', 'idtipo', $idtipo])
                        ->orderBy('idordenproduccion desc');
                $count = clone $table;
                $to = $count->count();
                $pages = new Pagination([
                    'pageSize' => 10,
                    'totalCount' => $count->count()
                ]);
                $model = $table
                        ->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
            } else {
                $form->getErrors();
            }
        } else {
            $table = Ordenproduccion::find()
                    ->orderBy('idordenproduccion desc');
            $count = clone $table;
            $pages = new Pagination([
                'pageSize' => 10,
                'totalCount' => $count->count(),
            ]);
            $model = $table
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        }

        return $this->render('ordenproduccionproceso', [
                    'model' => $model,
                    'form' => $form,
                    'pagination' => $pages,
                    'clientes' => ArrayHelper::map($clientes, "idcliente", "nombrecorto"),
                    'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
        ]);
        /* }else{
          return $this->redirect(["site/login"]);
          } */
    }

    public function actionNuevo_detalle_proceso($id, $iddetalleorden) {
        $detalleorden = Ordenproducciondetalle::findOne($iddetalleorden);
        $procesos = ProcesoProduccion::find()->all();
        if (isset($_POST["idproceso"])) {
            $intIndice = 0;
            foreach ($_POST["idproceso"] as $intCodigo) {
                if ($_POST["duracion"][$intIndice] > 0) {
                    $detalles = Ordenproducciondetalleproceso::find()
                            ->where(['=', 'idproceso', $intCodigo])
                            ->andWhere(['=', 'iddetalleorden', $iddetalleorden])
                            ->all();
                    $reg = count($detalles);
                    if ($reg == 0) {
                        $table = new Ordenproducciondetalleproceso();
                        $table->idproceso = $intCodigo;
                        $table->proceso = $_POST["proceso"][$intIndice];
                        $table->duracion = $_POST["duracion"][$intIndice];
                        $table->ponderacion = $_POST["ponderacion"][$intIndice];
                        $table->cantidad_operada = 0;
                        $table->total = $_POST["duracion"][$intIndice] + ($_POST["duracion"][$intIndice] * $_POST["ponderacion"][$intIndice] / 100);
                        $table->totalproceso = $detalleorden->cantidad * $table->total;
                        $table->iddetalleorden = $iddetalleorden;
                        $table->insert();
                    }
                }
                $intIndice++;
            }
            $this->porcentajeproceso($iddetalleorden);
            $this->progresoproceso($iddetalleorden, $detalleorden->idordenproduccion);
            $this->progresocantidad($iddetalleorden, $detalleorden->idordenproduccion);
            //se replica los procesos a detalles que contengan el mismo codigo de producto, para agilizar la insercion de cada uno de las operaciones por detalle            
            $detallesordenproduccion = Ordenproducciondetalle::find()
                    ->where(['<>', 'iddetalleorden', $iddetalleorden])
                    ->andWhere(['idordenproduccion' => $detalleorden->idordenproduccion])
                    ->all();
            foreach ($detallesordenproduccion as $dato) {
                if ($dato->codigoproducto == $detalleorden->codigoproducto) {
                    $detallesprocesos = Ordenproducciondetalleproceso::find()->where(['iddetalleorden' => $iddetalleorden])->all();
                    foreach ($detallesprocesos as $val) {
                        $detallesp = Ordenproducciondetalleproceso::find()
                                ->where(['=', 'idproceso', $val->idproceso])
                                ->andWhere(['=', 'iddetalleorden', $dato->iddetalleorden])
                                ->all();
                        $reg2 = count($detallesp);
                        if ($reg2 == 0) {
                            $tableprocesos = new Ordenproducciondetalleproceso();
                            $tableprocesos->idproceso = $val->idproceso;
                            $tableprocesos->proceso = $val->proceso;
                            $tableprocesos->duracion = $val->duracion;
                            $tableprocesos->ponderacion = $val->ponderacion;
                            $tableprocesos->total = $val->total;
                            $tableprocesos->cantidad_operada = 0;
                            $tableprocesos->totalproceso = $dato->cantidad * $tableprocesos->total;
                            $tableprocesos->iddetalleorden = $dato->iddetalleorden;
                            $tableprocesos->insert();
                        }
                    }
                    $this->porcentajeproceso($dato->iddetalleorden);
                    $this->progresoproceso($dato->iddetalleorden, $dato->idordenproduccion);
                    $this->progresocantidad($dato->iddetalleorden, $dato->idordenproduccion);
                }
            }
            $this->redirect(["orden-produccion/view_detalle", 'id' => $id]);
        }

        return $this->renderAjax('_formnuevodetalleproceso', [
                    'procesos' => $procesos,
                    'id' => $id,
                    'iddetalleorden' => $iddetalleorden,
        ]);
    }

    public function actionDetalle_proceso($idordenproduccion, $iddetalleorden) {
        $procesos = Ordenproducciondetalleproceso::find()->Where(['=', 'iddetalleorden', $iddetalleorden])->all();
        $detalle = Ordenproducciondetalle::findOne($iddetalleorden);
        $error = 0;
        if (Yii::$app->request->post()) {
            if (isset($_POST["editar"])) {
                if (isset($_POST["iddetalleproceso1"])) {
                    $intIndice = 0;
                    foreach ($_POST["iddetalleproceso1"] as $intCodigo) {
                        if ($_POST["duracion"][$intIndice] > 0) {
                            $table = Ordenproducciondetalleproceso::findOne($intCodigo);
                            $table->duracion = $_POST["duracion"][$intIndice];
                            $table->ponderacion = $_POST["ponderacion"][$intIndice];
                            $table->cantidad_operada = $_POST["cantidad_operada"][$intIndice];
                            $table->total = $_POST["duracion"][$intIndice] + ($_POST["duracion"][$intIndice] * $_POST["ponderacion"][$intIndice] / 100);
                            $table->totalproceso = $detalle->cantidad * $table->total;
                            if ($_POST["cantidad_operada"][$intIndice] <= $detalle->cantidad) {//se valida que la cantidad a operada no sea mayor a la cantidad a operar
                                $table->update();
                            } else {
                                $error = 1;
                            }
                        }
                        $intIndice++;
                    }
                    if ($error == 1) {
                        Yii::$app->getSession()->setFlash('error', 'El valor de la cantidad no puede ser mayor a la cantidad operada');
                    } else {
                        $this->redirect(["orden-produccion/view_detalle", 'id' => $idordenproduccion]);
                    }
                    $this->progresocantidad($iddetalleorden, $idordenproduccion);
                }
            }
            if (isset($_POST["eliminar"])) {
                if (isset($_POST["iddetalleproceso2"])) {
                    foreach ($_POST["iddetalleproceso2"] as $intCodigo) {

                        if (Ordenproducciondetalleproceso::deleteAll("iddetalleproceso=:iddetalleproceso", [":iddetalleproceso" => $intCodigo])) {
                            
                        }
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Debe seleccionar al menos un registro.');
                    $this->redirect(["orden-produccion/view_detalle", 'id' => $idordenproduccion]);
                }
            }
            if (isset($_POST["ac"])) {//abrir/cerrar en la ejecucion del proceso si esta terminado o no ha sido terminado
                if (isset($_POST["iddetalleproceso1"])) {
                    $intIndice = 0;
                    foreach ($_POST["iddetalleproceso1"] as $intCodigo) {
                        if ($_POST["estado"][$intIndice] >= 0) {
                            $table = Ordenproducciondetalleproceso::findOne($intCodigo);
                            $table->estado = $_POST["estado"][$intIndice];
                            $table->update();
                        }
                        $intIndice++;
                    }
                }
            }
            $this->porcentajeproceso($iddetalleorden);
            $this->progresoproceso($iddetalleorden, $idordenproduccion);
            $this->progresocantidad($iddetalleorden, $idordenproduccion);
            $this->redirect(["orden-produccion/view_detalle", 'id' => $idordenproduccion]);
        }
        return $this->renderAjax('_formdetalleproceso', [
                    'procesos' => $procesos,
                    'idordenproduccion' => $idordenproduccion,
                    'iddetalleorden' => $iddetalleorden,
        ]);
    }

    public function actionView_detalle($id) {
        $modeldetalles = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $id])->all();
        $modeldetalle = new Ordenproducciondetalle();
        return $this->render('view_detalle', [
                    'model' => $this->findModel($id),
                    'modeldetalle' => $modeldetalle,
                    'modeldetalles' => $modeldetalles,
        ]);
    }        

    protected function progresoproceso($iddetalleorden, $idordenproduccion) {
        $tabla = Ordenproducciondetalle::findOne(['=', 'iddetalleorden', $iddetalleorden]);
        $procesos = Ordenproducciondetalleproceso::find()->where(['=', 'iddetalleorden', $iddetalleorden])->all();
        $progreso = 0;
        $totalprogresodetalle = 0;
        $totalprocesodetalle = 0;
        $cantidadefectiva = 0;
        $sumacantxoperar = 0;
        $totalsegxdetalle = 0;
        foreach ($procesos as $val) {
            if ($val->estado == 1) {
                $cantidadefectiva = $cantidadefectiva + $tabla->cantidad;
                $totalprogresodetalle = $totalprogresodetalle + $val->porcentajeproceso;
            }
        }
        $tsegundosproceso = (new \yii\db\Query())->from('ordenproducciondetalleproceso');
        $sumsegproc = $tsegundosproceso->where(['=', 'iddetalleorden', $iddetalleorden])->sum('totalproceso');
        $total = $totalprogresodetalle;
        $tabla->porcentaje_proceso = $total;
        $sumacantxoperar = $tabla->cantidad * count($procesos);
        if ($sumacantxoperar == 0) {
            $sumacantxoperar = 1;
        }
        $totalsegxdetalle = ($sumsegproc * $cantidadefectiva) / $sumacantxoperar;
        $tabla->cantidad_efectiva = $cantidadefectiva;
        $tabla->totalsegundos = $totalsegxdetalle;
        $tabla->update();
        $totaldetallesseg = Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $idordenproduccion])->all();
        $tdetallesseg = 0;
        $ts = 0;
        foreach ($totaldetallesseg as $value) {
            $tdetallesseg = $tdetallesseg + $value->totalsegundos;            
            $procesosx = Ordenproducciondetalleproceso::find()->where(['=', 'iddetalleorden', $value->iddetalleorden])->all();
            foreach ($procesosx as $v) {
                $ts = $ts + $v->totalproceso;
            }
        }
        
        $orden = Ordenproduccion::findOne($idordenproduccion);
        if ($ts == 0) {
            $ts = 1;
        }
        $orden->porcentaje_proceso = 100 * $tdetallesseg / $ts;
        $orden->update();
    }

    protected function progresocantidad($iddetalleorden, $idordenproduccion) {
        $tabla = Ordenproducciondetalle::findOne(['=', 'iddetalleorden', $iddetalleorden]);
        $procesos = Ordenproducciondetalleproceso::find()->where(['=', 'iddetalleorden', $iddetalleorden])->all();
        $progreso = 0;
        $totalprogresodetalle = 0;
        $totalprocesodetalle = 0;
        $cantidadoperada = 0;
        $sumacantxoperar = 0;
        $totalsegxdetalle = 0;
        foreach ($procesos as $val) {
            if ($val->cantidad_operada > 0) {
                $cantidadoperada = $cantidadoperada + $val->cantidad_operada;
                $totalprogresodetalle = $totalprogresodetalle + $val->porcentajeproceso;
            }
        }
        $tsegundosproceso = (new \yii\db\Query())->from('ordenproducciondetalleproceso');
        $sumsegproc = $tsegundosproceso->where(['=', 'iddetalleorden', $iddetalleorden])->sum('totalproceso');
        $total = ($tabla->cantidad_operada * $totalprogresodetalle) / $tabla->cantidad;
        $tabla->porcentaje_cantidad = $total;
        $sumacantxoperar = $tabla->cantidad * count($procesos);
        if ($sumacantxoperar == 0) {
            $sumacantxoperar = 1;
        }
        $totalsegxdetalle = ($sumsegproc * $cantidadoperada) / $sumacantxoperar;
        $tabla->cantidad_operada = $cantidadoperada;
        $tabla->totalsegundos = $totalsegxdetalle;
        $tabla->update();
        $totaldetallesseg = Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $idordenproduccion])->all();
        $tdetallesseg = 0;
        $ts = 0;
        $segundosficha = 0;
        foreach ($totaldetallesseg as $value) {
            $tdetallesseg = $tdetallesseg + $value->totalsegundos;
            $segundosficha = $segundosficha + $value->segundosficha;
            $procesosx = Ordenproducciondetalleproceso::find()->where(['=', 'iddetalleorden', $value->iddetalleorden])->all();
            foreach ($procesosx as $v) {
                $ts = $ts + $v->totalproceso;
            }
        }
        $orden = Ordenproduccion::findOne($idordenproduccion);
        if ($ts == 0) {
            $ts = 1;
        }
        $orden->porcentaje_cantidad = 100 * $tdetallesseg / $ts;
        $orden->segundosficha = $segundosficha;
        $orden->update();
    }

    protected function porcentajeproceso($iddetalleorden) {
        $detalleorden = Ordenproducciondetalle::findOne($iddetalleorden);
        $detallesprocesos = Ordenproducciondetalleproceso::find()->where(['=', 'iddetalleorden', $iddetalleorden])->all();
        $totalproceso = 0;
        //suma de segundos de todos los procesos
        $totalsegundos = (new \yii\db\Query())->from('ordenproducciondetalleproceso');
        $sumseg = $totalsegundos->where(['=', 'iddetalleorden', $iddetalleorden])->sum('totalproceso');
        //suma de segundos por cada ficha
        $totalsegundosficha = (new \yii\db\Query())->from('ordenproducciondetalleproceso');
        $sumsegficha = $totalsegundosficha->where(['=', 'iddetalleorden', $iddetalleorden])->sum('total');
        $detalleorden->segundosficha = $sumsegficha;
        $detalleorden->update();
        foreach ($detallesprocesos as $val) {
            $tabla = Ordenproducciondetalleproceso::findOne($val->iddetalleproceso);
            $tabla->porcentajeproceso = $val->totalproceso / $sumseg * 100;
            $tabla->update();
            
        }
    }

}
