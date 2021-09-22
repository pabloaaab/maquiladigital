<?php

namespace app\controllers;

use app\models\Ordenproducciondetalleproceso;
use app\models\ProcesoProduccion;
use app\models\Ordenproduccion;
use app\models\Ordenproducciondetalle;
use app\models\OrdenproduccionSearch;
use app\models\Ordenproducciontipo;
use app\models\Cliente;
use app\models\CantidadPrendaTerminadas;
use app\models\FormFiltroOrdenProduccionProceso;
use app\models\FormFiltroConsultaFichaoperacion;
use app\models\FormFiltroConsultaOrdenproduccion;
use app\models\FormFiltroProcesosOperaciones;
use app\models\FormPrendasTerminadas;
use app\models\FlujoOperaciones;
use app\models\Producto;
use app\models\Productodetalle;
use app\models\Balanceo;
use app\models\UsuarioDetalle;
use app\models\FormFiltroConsultaUnidadConfeccionada;
use app\models\FormFiltroEntradaSalida;
use app\models\SalidaEntradaProduccion;
use app\models\SalidaEntradaProduccionDetalle;
use app\models\FormFiltroOrdenTercero;
use app\models\OrdenProduccionTercero;
use app\models\OrdenProduccionTerceroDetalle;
//clases
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
use yii\db\Expression;
use yii\db\Query;


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
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',25])->all()){
                $searchModel = new OrdenproduccionSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            }else{
                return $this->redirect(['site/sinpermiso']);
            }
        }else{
            return $this->redirect(['site/login']);
        }
    }

    //INDEX DE CONSULTA DE UNDIADES CONFECCIONADAS
    
    public function actionConsultaunidadconfeccionada() {
        if (Yii::$app->user->identity) {
            if (UsuarioDetalle::find()->where(['=', 'codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=', 'id_permiso', 108])->all()) {
                $form = new FormFiltroConsultaUnidadConfeccionada();
                $id_balanceo = null;
                $idordenproduccion = null;
                $fecha_inicio = null;
                $fecha_corte = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $id_balanceo = Html::encode($form->id_balanceo);
                        $idordenproduccion = Html::encode($form->idordenproduccion);
                        $fecha_inicio = Html::encode($form->fecha_inicio);
                        $fecha_corte = Html::encode($form->fecha_corte);
                        $table = CantidadPrendaTerminadas::find()
                                ->andFilterWhere(['=', 'id_balanceo', $id_balanceo])
                                ->andFilterWhere(['=', 'idordenproduccion', $idordenproduccion])
                                ->andFilterWhere(['>=', 'fecha_entrada', $fecha_inicio])
                                ->andFilterWhere(['<=', 'fecha_entrada', $fecha_corte]);
                        $table = $table->orderBy('id_entrada DESC');
                        $tableexcel = $table->all();
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 100,
                            'totalCount' => $count->count()
                        ]);
                        $modelo = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                        if (isset($_POST['excel'])) {
                            $check = isset($_REQUEST['id_entrada  DESC']);
                            $this->actionExcelConsultaUnidades($tableexcel);
                        }
                    } else {
                        $form->getErrors();
                    }
                } else {
                    $table = CantidadPrendaTerminadas::find()
                             ->orderBy('id_entrada DESC');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $pages = new Pagination([
                        'pageSize' => 100,
                        'totalCount' => $count->count(),
                    ]);
                    $modelo = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if (isset($_POST['excel'])) {
                        //$table = $table->all();
                        $this->actionExcelConsultaUnidades($tableexcel);
                    }
                }
                $to = $count->count();
                return $this->render('consultaunidadconfeccionada', [
                            'modelo' => $modelo,
                            'form' => $form,
                            'pagination' => $pages,
                ]);
            } else {
                return $this->redirect(['site/sinpermiso']);
            }
        } else {
            return $this->redirect(['site/login']);
        }
    } 
    
    // INDEX DE ENTRADA Y SALIDAS DE LA OP DEL CLIENTE
     public function actionIndexentradasalida() {
        if (Yii::$app->user->identity) {
            if (UsuarioDetalle::find()->where(['=', 'codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=', 'id_permiso', 109])->all()) {
                $form = new FormFiltroEntradaSalida();
                $idcliente = null;
                $idordenproduccion = null;
                $fecha_desde = null;
                $fecha_hasta = null;
                $tipo_proceso = null;
                $codigo_producto = null;
                 $tipo_entrada = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $idcliente = Html::encode($form->idcliente);
                        $idordenproduccion = Html::encode($form->idordenproduccion);
                        $fecha_desde = Html::encode($form->fecha_desde);
                        $fecha_hasta = Html::encode($form->fecha_hasta);
                        $tipo_proceso = Html::encode($form->tipo_proceso);
                        $codigo_producto = Html::encode($form->codigo_producto);
                        $tipo_entrada = Html::encode($form->id_entrada_tipo);
                        $table = SalidaEntradaProduccion::find()
                                ->andFilterWhere(['=', 'idcliente', $idcliente])
                                ->andFilterWhere(['=', 'idordenproduccion', $idordenproduccion])
                                ->andFilterWhere(['>=', 'fecha_entrada_salida', $fecha_desde])
                                ->andFilterWhere(['<=', 'fecha_entrada_salida', $fecha_hasta])
                                ->andFilterWhere(['=', 'codigo_producto', $codigo_producto])
                                ->andFilterWhere(['=', 'tipo_proceso', $tipo_proceso])
                                 ->andFilterWhere(['=', 'id_entrada_tipo', $tipo_entrada]);
                        $table = $table->orderBy('id_salida DESC');
                        $tableexcel = $table->all();
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 40,
                            'totalCount' => $count->count()
                        ]);
                        $modelo = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                        if (isset($_POST['excel'])) {
                            $check = isset($_REQUEST['id_salida  DESC']);
                            $this->actionExcelEntradaSalida($tableexcel);
                        }
                    } else {
                        $form->getErrors();
                    }
                } else {
                    $table = SalidaEntradaProduccion::find()
                             ->orderBy('id_salida DESC');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $pages = new Pagination([
                        'pageSize' => 40,
                        'totalCount' => $count->count(),
                    ]);
                    $modelo = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if (isset($_POST['excel'])) {
                        //$table = $table->all();
                        $this->actionExcelEntradaSalida($tableexcel);
                    }
                }
                $to = $count->count();
                return $this->render('indexentradasalida', [
                            'modelo' => $modelo,
                            'form' => $form,
                            'pagination' => $pages,
                ]);
            } else {
                return $this->redirect(['site/sinpermiso']);
            }
        } else {
            return $this->redirect(['site/login']);
        }
    } 
    
    //orden de produccion para tercero
    
    public function actionIndextercero() {
        if (Yii::$app->user->identity) {
            if (UsuarioDetalle::find()->where(['=', 'codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=', 'id_permiso', 112])->all()) {
                $form = new FormFiltroOrdenTercero();
                $idproveedor = null;
                $idordenproduccion = null;
                $fecha_inicio = null;
                $fecha_corte = null;
                $idtipo = null;
                $idcliente = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $idproveedor = Html::encode($form->idproveedor);
                        $idordenproduccion = Html::encode($form->idordenproduccion);
                        $idtipo = Html::encode($form->idtipo);
                        $idcliente = Html::encode($form->idcliente);
                        $fecha_inicio = Html::encode($form->fecha_inicio);
                        $fecha_corte = Html::encode($form->fecha_corte);
                        $table = OrdenProduccionTercero::find()
                                ->andFilterWhere(['=', 'idtipo', $idtipo])
                                ->andFilterWhere(['=', 'idordenproduccion', $idordenproduccion])
                                ->andFilterWhere(['>=', 'fecha_proceso', $fecha_inicio])
                                ->andFilterWhere(['=', 'idproveedor', $idproveedor])
                                ->andFilterWhere(['=', 'idcliente', $idcliente])
                                ->andFilterWhere(['<=', 'fecha_proceso', $fecha_corte]);
                        $table = $table->orderBy('id_orden_tercero DESC');
                        $tableexcel = $table->all();
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 100,
                            'totalCount' => $count->count()
                        ]);
                        $modelo = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                        if (isset($_POST['excel'])) {
                            $check = isset($_REQUEST['id_orden_tercero  DESC']);
                            $this->actionExcelOrdenTercero($tableexcel);
                        }
                    } else {
                        $form->getErrors();
                    }
                } else {
                    $table = OrdenProduccionTercero::find()
                             ->orderBy('id_orden_tercero DESC');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $pages = new Pagination([
                        'pageSize' => 100,
                        'totalCount' => $count->count(),
                    ]);
                    $modelo = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if (isset($_POST['excel'])) {
                        //$table = $table->all();
                        $this->actionExcelOrdenTercero($tableexcel);
                    }
                }
                $to = $count->count();
                return $this->render('indextercero', [
                            'modelo' => $modelo,
                            'form' => $form,
                            'pagination' => $pages,
                ]);
            } else {
                return $this->redirect(['site/sinpermiso']);
            }
        } else {
            return $this->redirect(['site/login']);
        }
    } 
    //vista para orden de produccion
    public function actionView($id) {
        $modeldetalles = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $id])->all();
        $modeldetalle = new Ordenproducciondetalle();
        $mensaje = "";
        if (isset($_POST["eliminar"])) {
            if (isset($_POST["seleccion"])) {
                foreach ($_POST["seleccion"] as $intCodigo) {
                    try {
                            $eliminar = Ordenproducciondetalle::findOne($intCodigo);
                            $eliminar->delete();
                            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
                            $this->redirect(["orden-produccion/view", 'id' => $id]);
                        } catch (IntegrityException $e) {
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');
                        } catch (\Exception $e) {
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');
                        }
                }
                $this->Actualizartotal($id);
                $this->Actualizarcantidad($id);
                $this->redirect(["orden-produccion/view", 'id' => $id]);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Debe seleccionar al menos un registro.');                
            }                        
        }       
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modeldetalle' => $modeldetalle,
                    'modeldetalles' => $modeldetalles,
                    'mensaje' => $mensaje,
        ]);
    }
   
    // vista para salida de produccion
    public function actionViewsalida($id) {
        $modeldetalles = SalidaEntradaProduccionDetalle::find()->Where(['=', 'id_salida', $id])->all();
        $modeldetalle = new SalidaEntradaProduccionDetalle();
        $mensaje = "";
        if (isset($_POST["eliminarsalida"])) {
            if (isset($_POST["seleccion"])) {
                foreach ($_POST["seleccion"] as $intCodigo) {
                    try {
                            $eliminar = Ordenproducciondetalle::findOne($intCodigo);
                            $eliminar->delete();
                            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
                            $this->redirect(["orden-produccion/view", 'id' => $id]);
                        } catch (IntegrityException $e) {
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');
                        } catch (\Exception $e) {
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');
                        }
                }
                $this->redirect(["orden-produccion/viewsalida", 'id' => $id]);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Debe seleccionar al menos un registro.');                
            }                        
        }       
        return $this->render('viewsalida', [
                    'model' => SalidaEntradaProduccion::findOne($id),
                    'modeldetalle' => $modeldetalle,
                    'modeldetalles' => $modeldetalles,
                    'mensaje' => $mensaje,
        ]);
    }
    
    // vista para ordenes de tercero
    
    public function actionViewtercero($id) {
        $modeldetalles = OrdenProduccionTerceroDetalle::find()->Where(['=', 'id_orden_tercero', $id])->all();
        $modeldetalle = new OrdenProduccionTerceroDetalle();
        $mensaje = "";
        $model = OrdenProduccionTercero::findOne($id);
        if (isset($_POST["eliminar"])) {
            if (isset($_POST["seleccion"])) {
                foreach ($_POST["seleccion"] as $intCodigo) {
                    try {
                            $eliminar = Ordenproducciondetalle::findOne($intCodigo);
                            $eliminar->delete();
                            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
                            $this->redirect(["orden-produccion/view", 'id' => $id]);
                        } catch (IntegrityException $e) {
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');
                        } catch (\Exception $e) {
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');
                        }
                }
                $this->Actualizartotal($id);
                $this->Actualizarcantidad($id);
                $this->redirect(["orden-produccion/viewtercero", 'id' => $id]);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Debe seleccionar al menos un registro.');                
            }                        
        }       
        return $this->render('viewtercero', [
                    'model' => $model,
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
          $codigos = Producto::find()->orderBy('idproducto desc')->all(); 
        $ordenproducciontipos = Ordenproducciontipo::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->totalorden = 0;
            $model->estado = 0;
            $model->autorizado = 0;
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->update();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
                    'model' => $model,
              'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
                    'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
                    'codigos' => ArrayHelper::map($codigos, "codigo", "codigonombre"),
                    
        ]);
    }
    
    //NUEVA ORDER PARA TERCERO
    
     public function actionNuevaordentercero() {
        $model = new OrdenProduccionTercero();
        $clientes = Cliente::find()->all();
        $ordenproducciontipos = Ordenproducciontipo::find()->all();
        $codigos = Producto::find()->orderBy('idproducto desc')->all();        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $orden = Ordenproduccion::find()->where(['=','idcliente', $model->idcliente])
                                           ->andWhere(['=','codigoproducto', $model->codigo_producto])
                                           ->orderBy('idordenproduccion DESC')->one();
            $model->idordenproduccion = $orden->idordenproduccion;
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->autorizado = 0;
            $model->update();
            return $this->redirect(['indextercero']);
        }

        return $this->render('_formnewtercero', [
                    'model' => $model,
                    'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
                    'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
                    'codigos' => ArrayHelper::map($codigos, "codigo", "codigonombre"),
        ]);
    }
    
    // nuevo salida / entrada
    
    public function actionCreatesalida() {
        $model = new SalidaEntradaProduccion();
        $clientes = Cliente::find()->all();
        $orden = Ordenproduccion::find()->orderBy('idordenproduccion asc')->all();        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->usuariosistema = Yii::$app->user->identity->username;
            $orden = Ordenproduccion::findOne($model->idordenproduccion);
            $model->codigo_producto = $orden->codigoproducto;
            $model->update();
            return $this->redirect(['indexentradasalida']);
        }

        return $this->render('createsalida', [
                    'model' => $model,
                    'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
                    'orden' => ArrayHelper::map($orden, "idordenproduccion", "ordenproduccion"),
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
        $codigos = Producto::find()->where(['=','idcliente',$model->idcliente])->all();
        if (Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $id])->all() or $model->facturado == 1) {
            Yii::$app->getSession()->setFlash('warning', 'No se puede modificar la información, tiene detalles asociados');
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
                    'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
                    'codigos' => ArrayHelper::map($codigos, "codigo", "codigonombre"),
        ]);
    }
    
    //actualiza el registro de la orden de salida
    public function actionUpdatesalida($id) {
        $model = SalidaEntradaProduccion::findOne($id);
        $clientes = Cliente::find()->all();
        $orden = Ordenproduccion::find()->orderBy('idordenproduccion DESC')->all(); 
        if (SalidaEntradaProduccionDetalle::find()->where(['=', 'id_salida', $id])->all()) {
            Yii::$app->getSession()->setFlash('warning', 'No se puede modificar la información, tiene detalles asociados');
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $orden_produccion = Ordenproduccion::find()->where(['=','idordenproduccion', $model->idordenproduccion])->one();
                $model->codigo_producto = $orden_produccion->codigoproducto;
                $model->update();
                return $this->redirect(['indexentradasalida']);
            }
        }
        return $this->render('updatesalida', [
                    'model' => $model,
                    'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
                  'orden' => ArrayHelper::map($orden, "idordenproduccion", "ordenproduccion"),
        ]);
    }
    
    //PERMITE MODIFICAR LA ORDEN DE TERCERO
    public function actionEditarordentercero($id) {
        $model = OrdenProduccionTercero::findOne($id);
        $clientes = Cliente::find()->all();
        $codigos = Producto::find()->orderBy('idproducto desc')->all(); 
        $ordenproducciontipos = Ordenproducciontipo::find()->all();
        if (OrdenProduccionTerceroDetalle::find()->where(['=', 'id_orden_tercero', $id])->all()) {
            Yii::$app->getSession()->setFlash('warning', 'No se puede modificar la información, tiene detalles asociados');
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['indextercero']);
            }
        }
        return $this->render('_formnewtercero', [
                    'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
                    'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
                    'codigos' => ArrayHelper::map($codigos, "codigo", "codigonombre"),
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
    
    public function actionAutorizadosalidaentrada($id) {
        $model = SalidaEntradaProduccion::findOne($id);
        $entrada = SalidaEntradaProduccion::findOne($id);
        if($model->total_cantidad > $model->ordenproduccion->cantidad){
           Yii::$app->getSession()->setFlash('warning', 'Las unidades de entrada no pueden ser mayores que la cantidad del lote.'); 
           $this->redirect(["orden-produccion/viewsalida", 'id' => $id]);
        }else{
            if ($model->autorizado == 0) {
                $model->autorizado = 1;
                $model->update();
                $this->redirect(["orden-produccion/viewsalida", 'id' => $id]);
            } else {
                $model->autorizado = 0;
                $model->update();
                $this->redirect(["orden-produccion/viewsalida", 'id' => $id]);
            }
        }    
    }
    
   // proceso par autorizar las ordenes de tercero
    public function actionAutorizadotercero($id) {
        $model = OrdenProduccionTercero::findOne($id);
        if ($model->autorizado == 0) {
            $model->autorizado = 1;
            $model->update();
            $this->redirect(["orden-produccion/viewtercero", 'id' => $id]);
        } else {
            $model->autorizado = 0;
            $model->update();
            $this->redirect(["orden-produccion/viewtercero", 'id' => $id]);
        }
    }
  // nuevo detalle para las ordenes de produccion
    public function actionNuevodetalles($idordenproduccion, $idcliente) {
        $ordenProduccion = Ordenproduccion::findOne($idordenproduccion);
        //$productosCliente = Productodetalle::find()->where(['=', 'idcliente', $idcliente])->andWhere(['=', 'idtipo', $ordenProduccion->idtipo])->andWhere(['>', 'stock', 0])->all();
        $productocodigo = Producto::find()->where(['=','idcliente',$idcliente])->andWhere(['=','codigo',$ordenProduccion->codigoproducto])->one();        
        if ($productocodigo){
            $productosCliente = Productodetalle::find()->where(['=', 'idproducto', $productocodigo->idproducto])->all();            
        }else{
            Yii::$app->getSession()->setFlash('error', 'No tiene productos asociados al cliente, por favor verifique si el cliente tiene productos asociados y/o esta mal configurado la orden de produccion, edite la orden');            
            $productosCliente = Productodetalle::find()->where(['=','idproductodetalle',0])->all();            
        }                
        $ponderacion = 0;
        $error = 0;
        $totalorden = 0;
        $cantidad = 0;
        if (isset($_POST["idproductodetalle"])) {
            $intIndice = 0;
            foreach ($_POST["idproductodetalle"] as $intCodigo) {                   
                $detalles = Ordenproducciondetalle::find()
                        ->where(['=', 'idordenproduccion', $idordenproduccion])
                        ->andWhere(['=', 'idproductodetalle', $intCodigo])
                        ->all();
                $reg = count($detalles);
                if ($reg == 0) {                        
                    $table = new Ordenproducciondetalle();
                    $table->idproductodetalle = $_POST["idproductodetalle"][$intIndice];
                    $table->cantidad = $_POST["cantidad"][$intIndice];
                    $table->vlrprecio = $_POST["vlrventa"][$intIndice];
                    $table->codigoproducto = $_POST["codigoproducto"][$intIndice];
                    $table->subtotal = $_POST["cantidad"][$intIndice] * $_POST["vlrventa"][$intIndice];
                    $table->idordenproduccion = $idordenproduccion;
                    $table->ponderacion = $ordenProduccion->ponderacion;
                    $table->insert();                    
                }
                  $intIndice++;  
            }                    
        $this->Actualizartotal($idordenproduccion);
        $this->Actualizarcantidad($idordenproduccion);
        $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]); 
        }                                       
        return $this->render('_formnuevodetalles', [
                    'productosCliente' => $productosCliente,
                    'idordenproduccion' => $idordenproduccion,
                    'ordenProduccion' => $ordenProduccion,
        ]);
    }
    
    // nuevo detalle para los ordenes de produccion para tercero
    
    public function actionNuevodetallestercero($idordenproduccion, $idcliente, $id) {
        $ordenProduccion = OrdenProduccionTercero::findOne($id);
        $productocodigo = Producto::find()->where(['=','idcliente', $idcliente])->andWhere(['=','codigo',$ordenProduccion->codigo_producto])->one();        
        $detalle_orden = Ordenproducciondetalle::find()->where(['=','idordenproduccion', $idordenproduccion])->all();
            
        $ponderacion = 0;
        $error = 0;
        $totalorden = 0;
        $cantidad = 0;
        if (isset($_POST["idproductodetalle"])) {
            $intIndice = 0;
            foreach ($_POST["idproductodetalle"] as $intCodigo) {                       
                $detalles = OrdenProduccionTerceroDetalle::find()
                        ->where(['=', 'id_orden_tercero', $id])
                        ->andWhere(['=', 'idproductodetalle', $intCodigo])
                        ->all();
                $reg = count($detalles);
                if ($reg == 0) {  
                    if($_POST["cantidad"][$intIndice] > 0){
                        $table = new OrdenProduccionTerceroDetalle();
                        $table->id_orden_tercero = $id;
                        $table->idproductodetalle = $_POST["idproductodetalle"][$intIndice];
                        $table->cantidad = $_POST["cantidad"][$intIndice];
                        $table->vlr_minuto = $ordenProduccion->vlr_minuto;
                        $table->total_pagar =  ($table->cantidad *  $table->vlr_minuto) * $ordenProduccion->cantidad_minutos ;
                        $table->insert(); 
                    }    
                }
                  $intIndice++;  
            }                    
        $this->ActualizarValorTercero($id);
        $this->redirect(["orden-produccion/viewtercero", 'id' => $id, 'idordenproduccion' => $idordenproduccion]); 
        }                                       
        return $this->render('_formnuevodetallestercero', [
                    'id' => $id,
                    'idordenproduccion' => $idordenproduccion,
                    'detalle_orden' => $detalle_orden,
        ]);
    }
    
    //nueva linea de entrada o salida
    
    public function actionNuevalinea($id, $idordenproduccion, $idcliente) {
        $detalle_orden = Ordenproducciondetalle::find()->where(['=','idordenproduccion', $idordenproduccion])->all();        
        if (isset($_POST["idproductodetalle"])) {
            $intIndice = 0;
            foreach ($_POST["idproductodetalle"] as $intCodigo) {  
                if($_POST["entradasalida"][$intIndice] > 0){
                    $table = new SalidaEntradaProduccionDetalle();
                    $table->idproductodetalle = $_POST["idproductodetalle"][$intIndice];
                    $table->cantidad = $_POST["entradasalida"][$intIndice];
                    $table->id_salida = $id;
                    $table->insert(); 
                }    
                $intIndice++;  
            }                    
            $this->ActualizarCantidadEntradaSalida($id);
           $this->redirect(["orden-produccion/viewsalida", 'idordenproduccion' => $idordenproduccion, 'id' => $id]); 
        }                                       
        return $this->render('_formnuevalinea', [
                    'detalle_orden' => $detalle_orden,
                    'idordenproduccion' => $idordenproduccion,
                    'id' => $id,
        ]);
    }
    
 //proceso que actualiza las cantidades
    protected function ActualizarCantidadEntradaSalida($id)
    {
     $salida_entrada = SalidaEntradaProduccion::findOne($id);    
     $salida = SalidaEntradaProduccionDetalle::find()->where(['=','id_salida', $id])->all();
     $suma = 0;
     foreach ($salida as $valor):
         $suma += $valor->cantidad;
     endforeach;
     $salida_entrada->total_cantidad = $suma;
     $salida_entrada->save(false);
    }
    
    public function actionEditardetalle() {
        $iddetalleorden = Html::encode($_POST["iddetalleorden"]);
        $idordenproduccion = Html::encode($_POST["idordenproduccion"]);
        $error = 0;
        if (Yii::$app->request->post()) {
            if ((int) $iddetalleorden) {
                $table = Ordenproducciondetalle::findOne($iddetalleorden);
                $producto = Producto::findOne($table->idproductodetalle);
                if ($table) {
                    $table->cantidad = Html::encode($_POST["cantidad"]);
                    $table->vlrprecio = Html::encode($_POST["vlrprecio"]);
                    $table->subtotal = Html::encode($_POST["cantidad"]) * Html::encode($_POST["vlrprecio"]);
                    $table->idordenproduccion = Html::encode($_POST["idordenproduccion"]);

                    $ordenProduccion = Ordenproduccion::findOne($table->idordenproduccion);
                    $ordenProduccion->totalorden = $ordenProduccion->totalorden - Html::encode($_POST["subtotal"]);
                    $ordenProduccion->totalorden = $ordenProduccion->totalorden + $table->subtotal;
                                            
                    $table->update();
                    $ordenProduccion->update();
                    $this->Actualizarcantidad($idordenproduccion);
                    $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                                            
                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                    $tipomsg = "danger";
                }
            }
        }
        
    }
    
    //Editar detalles de la salida y entrada
    public function actionEditardetallesalida($id) {
        $mds = SalidaEntradaProduccionDetalle::find()->where(['=', 'id_salida', $id])->all();
         $entrada = SalidaEntradaProduccion::findOne($id);
        $error = 0;
        if (isset($_POST["consecutivo"])) {
            $intIndice = 0;
            foreach ($_POST["consecutivo"] as $intCodigo) {
                if ($_POST["cantidad"][$intIndice] > 0) {
                    $table = SalidaEntradaProduccionDetalle::findOne($intCodigo);
                    $table->cantidad = $_POST["cantidad"][$intIndice];
                    $table->update();                        
                }
                $intIndice++;
            }
         
            $this->ActualizarCantidadEntradaSalida($id);
            $this->redirect(["orden-produccion/viewsalida", 'id' => $id]);            
        }
        return $this->render('_formeditardetallesalida', [
                    'mds' => $mds,
                    'id' => $id,
                    'entrada' => $entrada,
        ]);
    }
    
    //EDITAR ENTRADA DE PRENDAS CONFECCIONADAS
    public function actionEditarentrada()
    {
        $identrada = Html::encode($_POST["identrada"]);
        $iddetalleorden = Html::encode($_POST["iddetalleorden"]);
        $error = 0;
        if (Yii::$app->request->post()) {
            if ((int) $identrada) {
                $table = CantidadPrendaTerminadas::findOne($identrada);
                if ($table) {
                    $table->cantidad_terminada = Html::encode($_POST["cantidad_terminada"]);
                    $table->observacion = Html::encode($_POST["observacion"]);
                   $table->update();
                   $this->redirect(["orden-produccion/vistatallas", 'iddetalleorden' => $iddetalleorden]);
                                            
                } else {
                    Yii::$app->getSession()->setFlash('warnig', 'No se encotro ningun registo para actualizar.');
                }
            }
        }
        
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
                    $cantidad = $table->cantidad;
                    $table->cantidad = $_POST["cantidad"][$intIndice];
                    $table->vlrprecio = $_POST["vlrprecio"][$intIndice];
                    $table->subtotal = $_POST["cantidad"][$intIndice] * $_POST["vlrprecio"][$intIndice];                    
                    $table->update();                        
                }
                $intIndice++;
            }
            $this->Actualizartotal($idordenproduccion);
            $this->Actualizarcantidad($idordenproduccion);
            $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);            
        }
        return $this->render('_formeditardetalles', [
                    'mds' => $mds,
                    'idordenproduccion' => $idordenproduccion,
        ]);
    }
    
    ///PERMITE MODIFICAR UNA LINEA DEL DETALLE DE ENTRADA Y SALIDA
   public function actionEditardetallesalidaunico() {
        $consecutivo = Html::encode($_POST["consecutivo"]);
        $id = Html::encode($_POST["id_salida"]);
        $error = 0;
        if (Yii::$app->request->post()) {
            if ((int) $consecutivo) {
                $table = SalidaEntradaProduccionDetalle::findOne($consecutivo);
                if ($table) {
                    $table->cantidad = Html::encode($_POST["cantidad"]);
                    $table->update();
                    $this->ActualizarCantidadEntradaSalida($id);
                    $this->redirect(["orden-produccion/viewsalida", 'id' => $id]);
                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                    $tipomsg = "danger";
                }
            }
        }
    }
    
  //ESTE PROCESO EDITA UN REGISTRO DE LA ORDEN DE TERCERO
  public function actionEditardetalletercero() {
        $id_detalle = Html::encode($_POST["id_detalle"]);
        $id = Html::encode($_POST["id"]);
        $error = 0;
        if (Yii::$app->request->post()) {
            if ((int) $id_detalle) {
                $table = OrdenProduccionTerceroDetalle::findOne($id_detalle);
                $total = 0;
                if ($table) {
                    $orden = OrdenProduccionTercero::findOne($id);
                    $table->cantidad = Html::encode($_POST["cantidad"]);
                    $table->total_pagar = ($table->vlr_minuto * $orden->cantidad_minutos) * $table->cantidad;
                    $table->update();
                    $this->ActualizarValorTercero($id);
                    $this->redirect(["orden-produccion/viewtercero", 'id' => $id]);
                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                    $tipomsg = "danger";
                }
            }
        }
    }  
    //editar flujo de operaciones
    
    public function actionEditarflujooperaciones($idordenproduccion) {
        $mds = FlujoOperaciones::find()->where(['=', 'idordenproduccion', $idordenproduccion])->orderBy('orden_aleatorio ASC')->all();
        $error = 0;
        if (isset($_POST["id"])) {
            $intIndice = 0;
            foreach ($_POST["id"] as $intCodigo) {
                    $table = FlujoOperaciones::findOne($intCodigo);
                    $table->orden_aleatorio = $_POST["orden_aleatorio"][$intIndice];
                    $table->operacion = $_POST["operacionflujo"][$intIndice];
                    $table->id_tipo = $_POST["id_tipo"][$intIndice];
                    $table->save(false); 
                
                $intIndice++;
            }
           $this->redirect(["orden-produccion/view_balanceo", 'id' => $idordenproduccion]);            
        }
        return $this->render('_formeditarflujooperaciones', [
                    'mds' => $mds,
                    'idordenproduccion' => $idordenproduccion,
        ]);
    }
    
    //balanceo de prendas
    
    public function actionBalanceoprenda($idordenproduccion) {
        $mds = FlujoOperaciones::find()->where(['=', 'idordenproduccion', $idordenproduccion])->orderBy('id_tipo DESC')->all();
        $error = 0;
        if (isset($_POST["id"])) {
            $intIndice = 0;
            foreach ($_POST["id"] as $intCodigo) {
                if ($_POST["orden_aleatorio"][$intIndice] > 0) {
                    $table = FlujoOperaciones::findOne($intCodigo);
                    $table->orden_aleatorio = $_POST["orden_aleatorio"][$intIndice];
                    $table->update();                        
                }
                $intIndice++;
            }
            $this->redirect(["orden-produccion/view_balanceo", 'id' => $idordenproduccion]);            
        }
        return $this->render('_formbalanceoprenda', [
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
                
                try {
                    OrdenProduccionDetalle::deleteAll("iddetalleorden=:iddetalleorden", [":iddetalleorden" => $iddetalleorden]);
                    $this->Actualizartotal($idordenproduccion);
                    $this->Actualizarcantidad($idordenproduccion);
                    $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                } catch (IntegrityException $e) {
                    $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en ficha de operaciones');
                } catch (\Exception $e) {
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en ficha de operaciones');
                    $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                }
                
                
            } else {
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("orden-produccion/index") . "'>";
            }
        } else {
            return $this->redirect(["orden-produccion/index"]);
        }
    }
    
    //ELIMINA LOS DETALLES DE LA ENTRADA  Y SALIDA
    
    public function actionEliminardetallesalida() {
        if (Yii::$app->request->post()) {
            $consecutivo = Html::encode($_POST["consecutivo"]);
            $id = Html::encode($_POST["id_salida"]);
            if ((int) $id) {
                $Detalle = SalidaEntradaProduccionDetalle::findOne($consecutivo);
                try {
                    SalidaEntradaProduccionDetalle::deleteAll("consecutivo=:consecutivo", [":consecutivo" => $consecutivo]);
                    $this->ActualizarCantidadEntradaSalida($id);
                    $this->redirect(["orden-produccion/viewsalida", 'id' => $id]);
                } catch (IntegrityException $e) {
                    $this->redirect(["orden-produccion/viewsalida", 'id' => $id]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en ficha de operaciones');
                } catch (\Exception $e) {
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en ficha de operaciones');
                    $this->redirect(["orden-produccion/viewsalida", 'id' => $id]);
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
        $error = 0;
        if (Yii::$app->request->post()) {
            $intIndice = 0;

            if (isset($_POST["seleccion"])) {
                foreach ($_POST["seleccion"] as $intCodigo) {
                    $ordenProduccionDetalle = OrdenProduccionDetalle::findOne($intCodigo);
                    $subtotal = $ordenProduccionDetalle->subtotal;
                    $cantidad = $ordenProduccionDetalle->cantidad;
                    
                    try {
                        OrdenProduccionDetalle::findOne($intCodigo)->delete();
                        $this->Actualizartotal($idordenproduccion);
                        $this->Actualizarcantidad($idordenproduccion);
                        //$this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                    } catch (IntegrityException $e) {
                        //$this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                        Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en ficha de operaciones');
                        $error = 1;
                    } catch (\Exception $e) {
                        Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en ficha de operaciones');
                        $error = 1;
                    }
                    
                }
                if($error == 1){
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en ficha de operaciones');
                }else{
                    $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
                }
                
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

    //ELIMINAR DETALLES DE LA ORDEN DE TERCERO
    
    public function actionEliminardetalletercero() {
        if (Yii::$app->request->post()) {
            $id_detalle = Html::encode($_POST["id_detalle_orden"]);
            $id = Html::encode($_POST["id"]);
            if ((int) $id) {
                $Detalle = OrdenProduccionTerceroDetalle::findOne($id_detalle);
                try {
                    OrdenProduccionTerceroDetalle::deleteAll("id_detalle=:id_detalle", [":id_detalle" => $id_detalle]);
                    $this->ActualizarValorTercero($id);
                    $this->redirect(["orden-produccion/viewtercero", 'id' => $id]);
                } catch (IntegrityException $e) {
                    $this->redirect(["orden-produccion/viewtercero", 'id' => $id]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otro proceso');
                } catch (\Exception $e) {
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados  en otro proceso');
                    $this->redirect(["orden-produccion/viewtercero", 'id' => $id]);
                }
                
                
            } else {
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("orden-produccion/indextercero") . "'>";
            }
        } else {
            return $this->redirect(["orden-produccion/indextercero"]);
        }
    }
   
   //IMPRIMIR ORDEN DE CONFECCION
    public function actionImprimir($id) {

        return $this->render('../formatos/ordenProduccion', [
                    'model' => $this->findModel($id),
        ]);
    }
    
     public function actionImprimirtercero($id) {
        $model = OrdenProduccionTercero::findOne($id);
        return $this->render('../formatos/ordenproducciontercero', [
                    'model' => $model,
        ]);
    }
     public function actionImprimirsalida($id) {
        $model = SalidaEntradaProduccion::findOne($id);       
        return $this->render('../formatos/salidaEntrada', [
                    'model' => $model,
        ]);
    }
    
    public function actionImprimirficha($id,$iddetalleorden) {

        return $this->render('../formatos/fichaOperaciones', [
                    'model' => $this->findModel($id),
                    'iddetalleorden' => $iddetalleorden
        ]);
    }
    
    protected function findModel($id) {
        if (($model = Ordenproduccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function Actualizarcantidad($idordenproduccion) {
        $ordenProduccion = Ordenproduccion::findOne($idordenproduccion);
        $ordenproducciondetalle = Ordenproducciondetalle::find()->where(['=','idordenproduccion',$idordenproduccion])->all();
        $cantidad = 0;
        foreach ($ordenproducciondetalle as $val) {
            $cantidad = $cantidad + $val->cantidad;
        }        
        $ordenProduccion->cantidad = $cantidad;
        $ordenProduccion->faltante = $cantidad;
        $ordenProduccion->update();
    }
    
    protected function Actualizartotal($idordenproduccion) {
        $ordenProduccion = Ordenproduccion::findOne($idordenproduccion);
        $ordenproducciondetalle = Ordenproducciondetalle::find()->where(['=','idordenproduccion',$idordenproduccion])->all();
        $total = 0;
        foreach ($ordenproducciondetalle as $val) {
            $total = $total + $val->subtotal;
        }        
        $ordenProduccion->totalorden = round($total,0);
        $ordenProduccion->update();
    }
    
   //SUBPROCESO QUE ACTUALIZA EL VALOR A PAGAR LA ORDEN PARA EL TERCERO
    protected function ActualizarValorTercero($id) {
        $ordenProduccion = OrdenProduccionTercero::findOne($id);
        $ordenproducciondetalle = OrdenProduccionTerceroDetalle::find()->where(['=','id_orden_tercero',$id])->all();
        $total = 0; $total_unidad = 0;
        foreach ($ordenproducciondetalle as $val) {
            $total = $total + $val->total_pagar;
            $total_unidad += $val->cantidad;
        }        
        $ordenProduccion->total_pagar = round($total,0);
        $ordenProduccion->cantidad_unidades = round($total_unidad,0);
        $ordenProduccion->update();
    }
    
    public function actionProceso() {
        if (Yii::$app->user->identity){
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',28])->all()){
            $form = new FormFiltroOrdenProduccionProceso();
            $idcliente = null;
            $ordenproduccion = null;
            $idtipo = null;
            $codigoproducto = null;
            $clientes = Cliente::find()->all();
            $ordenproducciontipos = Ordenproducciontipo::find()->all();
            if ($form->load(Yii::$app->request->get())) {
                if ($form->validate()) {
                    $idcliente = Html::encode($form->idcliente);
                    $ordenproduccion = Html::encode($form->ordenproduccion);
                    $idtipo = Html::encode($form->idtipo);
                    $codigoproducto = Html::encode($form->codigoproducto);
                    $table = Ordenproduccion::find()
                            ->andFilterWhere(['=', 'idcliente', $idcliente])
                            ->andFilterWhere(['like', 'ordenproduccion', $ordenproduccion])
                            ->andFilterWhere(['=', 'codigoproducto', $codigoproducto])
                            ->andFilterWhere(['=', 'idtipo', $idtipo])
                            ->orderBy('idordenproduccion desc');
                    $count = clone $table;
                    $to = $count->count();
                    $pages = new Pagination([
                        'pageSize' => 40,
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
                    'pageSize' => 40,
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
         }else{
            return $this->redirect(['site/sinpermiso']);
        }
        }else{
            return $this->redirect(['site/login']);
        }
    }
    
    //CODIGO QUE PERMITE COMENZAR EL PROCESO DE BALANCEO
    public function actionProduccionbalanceo() {
        if (Yii::$app->user->identity){
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',98])->all()){
            $balan = Balanceo::find()->all();
            $form = new FormFiltroOrdenProduccionProceso();
            $idcliente = null;
            $ordenproduccion = null;
            $idtipo = null;
            $codigoproducto = null;
            $clientes = Cliente::find()->all();
            $ordenproducciontipos = Ordenproducciontipo::find()->where(['=','ver_registro', 1])->all();
            if ($form->load(Yii::$app->request->get())) {
                if ($form->validate()) {
                    $idcliente = Html::encode($form->idcliente);
                    $ordenproduccion = Html::encode($form->ordenproduccion);
                    $idtipo = Html::encode($form->idtipo);
                    $codigoproducto = Html::encode($form->codigoproducto);
                    $table = Ordenproduccion::find()
                            ->andFilterWhere(['=', 'idcliente', $idcliente])
                            ->andFilterWhere(['like', 'idordenproduccion', $ordenproduccion])
                            ->andFilterWhere(['=', 'codigoproducto', $codigoproducto])
                            ->andFilterWhere(['=', 'idtipo', $idtipo])
                            ->andFilterWhere(['=','aplicar_balanceo', 1])
                           
                            ->orderBy('idordenproduccion desc');
                    $count = clone $table;
                    $to = $count->count();
                    $pages = new Pagination([
                        'pageSize' => 40,
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
                        ->where(['=', 'idtipo', 1])
                        ->orWhere(['=', 'idtipo', 4])
                        ->andWhere(['=','aplicar_balanceo', 1])
                        ->orderBy('idordenproduccion desc');
                $count = clone $table;
                $pages = new Pagination([
                    'pageSize' => 40,
                    'totalCount' => $count->count(),
                ]);
                $model = $table
                        ->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
            }

            return $this->render('produccionbalanceo', [
                        'model' => $model,
                        'form' => $form,
                        'pagination' => $pages,
                        'balan' => $balan,
                        'clientes' => ArrayHelper::map($clientes, "idcliente", "nombrecorto"),
                        'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
            ]);
         }else{
            return $this->redirect(['site/sinpermiso']);
        }
        }else{
            return $this->redirect(['site/login']);
        }
    }

    public function actionNuevo_detalle_proceso($id, $iddetalleorden) {
        $detalleorden = Ordenproducciondetalle::findOne($iddetalleorden);
        $formul = new FormFiltroProcesosOperaciones();
        $idproceso = null;
        $proceso = null;        
        if ($formul->load(Yii::$app->request->get())) {
            if ($formul->validate()) {
                if ($formul->validate()) {
                    $idproceso = Html::encode($formul->id);
                    $proceso = Html::encode($formul->proceso);                                        
                    $procesos = ProcesoProduccion::find()
                            ->andFilterWhere(['=', 'idproceso', $idproceso])
                            ->andFilterWhere(['like', 'proceso', $proceso]);                            
                    $procesos = $procesos->orderBy('proceso desc');                    
                    $count = clone $procesos;
                    $to = $count->count();
                    $pages = new Pagination([
                        'pageSize' => 60,
                        'totalCount' => $count->count()
                    ]);
                    $procesos = $procesos
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();                    
                } else {
                    $formul->getErrors();
                }
            }
        }else {
            $procesos = ProcesoProduccion::find()->orderBy('proceso ASC');
            //$cont = count($procesos);
            $count = clone $procesos;
            $pages = new Pagination([
                'pageSize' => 60,
                'totalCount' => $count->count(),
            ]);
            $procesos = $procesos
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        }
        
        if (isset($_POST["guardar"])) {
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
                        if($_POST["id_tipo"][$intIndice] > 0){
                            $table = new Ordenproducciondetalleproceso();
                            $table->idproceso = $intCodigo;
                            $table->proceso = $_POST["proceso"][$intIndice];
                            $table->duracion = $_POST["duracion"][$intIndice];
                            $table->ponderacion = $_POST["ponderacion"][$intIndice];
                            $table->cantidad_operada = 0;
                            $table->total = $_POST["duracion"][$intIndice] + ($_POST["duracion"][$intIndice] * $_POST["ponderacion"][$intIndice] / 100);
                            $table->totalproceso = $detalleorden->cantidad * $table->total;
                            $table->iddetalleorden = $iddetalleorden;
                            $table->id_tipo = $_POST["id_tipo"][$intIndice];
                            $table->id_tipo = $_POST["id_tipo"][$intIndice];
                            $table->insert();
                        }    
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
                            $tableprocesos->id_tipo = $val->id_tipo;
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
        }
        if (isset($_POST["guardarynuevo"])) {
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
                        if($_POST["id_tipo"][$intIndice] > 0){
                            $table = new Ordenproducciondetalleproceso();
                            $table->idproceso = $intCodigo;
                            $table->proceso = $_POST["proceso"][$intIndice];
                            $table->duracion = $_POST["duracion"][$intIndice];
                            $table->ponderacion = $_POST["ponderacion"][$intIndice];
                            $table->cantidad_operada = 0;
                            $table->total = $_POST["duracion"][$intIndice] + ($_POST["duracion"][$intIndice] * $_POST["ponderacion"][$intIndice] / 100);
                            $table->totalproceso = $detalleorden->cantidad * $table->total;
                            $table->iddetalleorden = $iddetalleorden;
                            $table->id_tipo = $_POST["id_tipo"][$intIndice];
                            $table->insert();
                        }    
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
                            $tableprocesos->id_tipo = $val->id_tipo;
                            $tableprocesos->insert();
                        }
                    }
                    $this->porcentajeproceso($dato->iddetalleorden);
                    $this->progresoproceso($dato->iddetalleorden, $dato->idordenproduccion);
                    $this->progresocantidad($dato->iddetalleorden, $dato->idordenproduccion);
                }
            }
            //$this->redirect(["orden-produccion/view_detalle", 'id' => $id]);
        }
        }
        return $this->render('_formnuevodetalleproceso', [
                    'procesos' => $procesos,
                    //'cont' => $cont,
                    'formul' => $formul,
                    'pagination' => $pages,
                    'id' => $id,
                    'iddetalleorden' => $iddetalleorden,
        ]);
    
    }
    
   //proceso que genera el porcentaje de produccion en la grafica despues de subir las unidades ESTE ES EL PROCESO
    public function actionDetalle_proceso($idordenproduccion, $iddetalleorden) {
        $procesos = Ordenproducciondetalleproceso::find()->Where(['=', 'iddetalleorden', $iddetalleorden])->orderBy('proceso asc')->all();
        $detalle = Ordenproducciondetalle::findOne($iddetalleorden);
        $error = 0;
        $cont = count($procesos);
        if (Yii::$app->request->post()) {
            if (isset($_POST["editar"])) {
                if (isset($_POST["iddetalleproceso1"])) {
                    $intIndice = 0;
                    foreach ($_POST["iddetalleproceso1"] as $intCodigo) {
                        if ($_POST["duracion"][$intIndice] > 0) {
                            $table = Ordenproducciondetalleproceso::findOne($intCodigo);
                            $table->duracion = $_POST["duracion"][$intIndice];
                            $table->ponderacion = $_POST["ponderacion"][$intIndice];
                            if ($_POST["cantidad_operada_todo"] <= 0){
                                $table->cantidad_operada = $_POST["cantidad_operada"][$intIndice];
                            }else{
                                $table->cantidad_operada = $_POST["cantidad_operada_todo"];
                            }
                            
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
                        Yii::$app->getSession()->setFlash('error', 'El valor de la cantidad no puede ser mayor a la cantidad operada '.$detalle->cantidad);
                    } else {
                        $this->redirect(["orden-produccion/view_detalle", 'id' => $idordenproduccion]);
                    }
                    $this->progresocantidad($iddetalleorden, $idordenproduccion);
                }
                //se replica los procesos a detalles que contengan el mismo codigo de producto, para agilizar la insercion de cada uno de las operaciones por detalle            
                $detallesordenproduccion = Ordenproducciondetalle::find()
                        ->where(['<>', 'iddetalleorden', $iddetalleorden])
                        ->andWhere(['idordenproduccion' => $idordenproduccion])
                        ->all();
                foreach ($detallesordenproduccion as $dato) {
                    if ($dato->codigoproducto == $detalle->codigoproducto) {
                        $detallesprocesos = Ordenproducciondetalleproceso::find()->where(['iddetalleorden' => $dato->iddetalleorden])->all();
                        foreach ($detallesprocesos as $val) {
                            $detallesp = Ordenproducciondetalleproceso::find()
                                    ->where(['=', 'idproceso', $val->idproceso])
                                    ->andWhere(['=', 'iddetalleorden', $dato->iddetalleorden])
                                    ->all();
                            $reg2 = count($detallesp);
                            if ($reg2!= 0) {
                                $datoaguardar = Ordenproducciondetalleproceso::find()->where(['=','idproceso',$val->idproceso])->andWhere(['=','iddetalleorden',$iddetalleorden])->one();
                                $tableprocesos = Ordenproducciondetalleproceso::findOne($val->iddetalleproceso);
                                $tableprocesos->duracion = $datoaguardar->duracion;
                                $tableprocesos->ponderacion = $datoaguardar->ponderacion;
                                $tableprocesos->total = $datoaguardar->total;
                                $tableprocesos->totalproceso = $datoaguardar->totalproceso;
                                $tableprocesos->update();
                            }
                        }
                //fin replicacion ediccion    
                    }
                }
            }
            if (isset($_POST["eliminar"])) {
                if (isset($_POST["iddetalleproceso2"])) {
                    foreach ($_POST["iddetalleproceso2"] as $intCodigo) {
                        $proceso = Ordenproducciondetalleproceso::find()->where(['=','iddetalleproceso',$intCodigo])->one();
                        $detallesordenes = Ordenproducciondetalle::find()->where(['=','idordenproduccion',$idordenproduccion])->all();
                        foreach ($detallesordenes as $val){
                            $detallesproceso = Ordenproducciondetalleproceso::find()->where(['=','iddetalleorden',$val->iddetalleorden])->andwhere(['=','idproceso',$proceso->idproceso])->one();
                            if ($detallesproceso){
                                $detallesproceso->delete();
                            }
                        }
                        /*if (Ordenproducciondetalleproceso::deleteAll("iddetalleproceso=:iddetalleproceso", [":iddetalleproceso" => $intCodigo])) {
                            
                        }*/
                    }
                    $this->porcentajeproceso($iddetalleorden);
                    $this->progresoproceso($iddetalleorden, $idordenproduccion);
                    $this->progresocantidad($iddetalleorden, $idordenproduccion);
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
            if (isset($_POST["acabrir"])) {//abrir/cerrar en la ejecucion del proceso si esta terminado o no ha sido terminado
                if (isset($_POST["iddetalleproceso1"])) {
                    $intIndice = 0;
                    foreach ($_POST["iddetalleproceso1"] as $intCodigo) {
                        if ($_POST["estado"][$intIndice] >= 0) {
                            $table = Ordenproducciondetalleproceso::findOne($intCodigo);                            
                            $table->estado = 0;
                            $table->update();
                        }
                        $intIndice++;
                    }
                }
            }
            if (isset($_POST["accerrar"])) {//abrir/cerrar en la ejecucion del proceso si esta terminado o no ha sido terminado
                if (isset($_POST["iddetalleproceso1"])) {
                    $intIndice = 0;
                    foreach ($_POST["iddetalleproceso1"] as $intCodigo) {
                        if ($_POST["estado"][$intIndice] >= 0) {
                            $table = Ordenproducciondetalleproceso::findOne($intCodigo);                            
                            $table->estado = 1;
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
                    'cont' => $cont,
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
    
    //VISTA PARA EL DETALLE DE BALANCEO
    public function actionView_balanceo($id) {
        $modeldetalles = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $id])->all();
        $ordendetalle = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $id])->one();
        $operaciones = Ordenproducciondetalleproceso::find()->Where(['=','iddetalleorden', $ordendetalle->iddetalleorden])
                                                                    ->orderBy('id_tipo DESC')
                                                                   ->all();
        $modulos = Balanceo::find()->where(['=','idordenproduccion', $id])->all();
        $cantidad_confeccionada = CantidadPrendaTerminadas::find()->where(['=','idordenproduccion', $id])->orderBy('fecha_entrada asc')->all();
        $modeldetalle = new Ordenproducciondetalle();
        if (Yii::$app->request->post()) {
            if (isset($_POST["eliminarflujo"])) {
                if (isset($_POST["id"])) {
                    foreach ($_POST["id"] as $intCodigo) {
                        try {
                            $eliminar = FlujoOperaciones::findOne($intCodigo);
                            $eliminar->delete();
                            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
                            $this->redirect(["orden-produccion/view_balanceo", 'id' => $id]);
                        } catch (IntegrityException $e) {
                          
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');
                        } catch (\Exception $e) {
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');

                        }
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Debe seleccionar al menos un registro.');
                }    
             }
        }        
       
        return $this->render('view_balanceo', [
                    'model' => $this->findModel($id),
                    'modeldetalle' => $modeldetalle,                    
                    'modeldetalles' => $modeldetalles,
                    'operaciones' => $operaciones,
                    'modulos' => $modulos,
                    'cantidad_confeccionada' => $cantidad_confeccionada,
                     
        ]);
    }        
  
    //VISTA DE CANTIDADES CONFECCINADAS POR TALLAS
    
    public function actionVistatallas($iddetalleorden)
    {
      $detalletallas = Ordenproducciondetalle::findOne($iddetalleorden);  
      $cantidades = CantidadPrendaTerminadas::find()->where(['=','iddetalleorden', $iddetalleorden])->orderBy('id_entrada DESC')->all();
       return $this->render('vistatallas', [
                    'detalletallas' => $detalletallas, 
                    'cantidades' => $cantidades,
                    
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
        $tabla->save(false);
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
        $ordendetalle = Ordenproducciondetalle::find()->where(['=','idordenproduccion',$idordenproduccion])->all();
        $reg = count($ordendetalle);
        $porc = 0;
        $porci = 0;
        foreach ($ordendetalle as $val){
            
            $porci = $val->cantidad / $orden->cantidad * $val->porcentaje_proceso; 
            $porc = $porc + $porci;
            
        }
        $orden->porcentaje_proceso = $porc;
        $orden->save(false);
    }

    protected function progresocantidad($iddetalleorden, $idordenproduccion) {
        $tabla = Ordenproducciondetalle::findOne(['=', 'iddetalleorden', $iddetalleorden]);
        $procesos = Ordenproducciondetalleproceso::find()->where(['=', 'iddetalleorden', $iddetalleorden])->all();                        
        $cantidadoperada = 0;                        
        $porcentaje = 0;
        $porcentajesuma = 0;
        $cont = 0;
        $totalsegundosgeneral = 0;
        foreach ($procesos as $val) {
            $totalsegundosgeneral = $totalsegundosgeneral + $val->totalproceso;
        }
        foreach ($procesos as $val) {
            if ($val->cantidad_operada > 0) {                
                $cantidadoperada = $cantidadoperada + $val->cantidad_operada;
                $porcentaje = ($val->total * $val->cantidad_operada) / $totalsegundosgeneral * 100;
                $porcentajesuma = $porcentajesuma + $porcentaje;
                $cont++;
            }            
        }
        $porcentajecantidad = $porcentajesuma;
        $tabla->porcentaje_cantidad = $porcentajecantidad;        
        if ($cont == 0){
            $tabla->cantidad_operada = $cantidadoperada;
        } else {
           echo $tabla->cantidad_operada = $cantidadoperada / $cont;
        } 
        $tabla->save(false);
        $orden = Ordenproduccion::findOne($idordenproduccion);
        $detalle = Ordenproducciondetalle::find()->where(['=','idordenproduccion',$idordenproduccion])->all();
        $porc = 0;
        $porci = 0;
        foreach ($detalle as $val){
            $porci = $val->cantidad_operada / $orden->cantidad * $val->porcentaje_cantidad; 
            $porc = $porc + $porci;
        }
        $orden->porcentaje_cantidad = $porc;
        $orden->save(false);
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
        $detalleorden->save(false);
        foreach ($detallesprocesos as $val) {
            $tabla = Ordenproducciondetalleproceso::findOne($val->iddetalleproceso);
            $tabla->porcentajeproceso = $val->totalproceso / $sumseg * 100;
            $tabla->save(false);            
        }
        $ordenproduccion = Ordenproduccion::findOne($detalleorden->idordenproduccion);
        $ordenproduccion->segundosficha = $sumsegficha;
        $ordenproduccion->save(false);
    }
    
    public function actionProductos($id){
        $rows = Producto::find()->where(['=','idcliente', $id])->orderBy('idproducto desc')->all();

        echo "<option value='' required>Seleccione un codigo...</option>";
        if(count($rows)>0){
            foreach($rows as $row){
                echo "<option value='$row->codigo' required>$row->codigonombre</option>";
            }
        }
    }
    
    public function actionOrdenes($id){
        $rows = Ordenproduccion::find()->where(['=','idcliente', $id])->orderBy('idordenproduccion desc')->all();

        echo "<option value='' required>Seleccione una orden...</option>";
        if(count($rows)>0){
            foreach($rows as $row){
                echo "<option value='$row->idordenproduccion' required>$row->ordenproduccion</option>";
            }
        }
    }
    
    //codigo que permite subir las prendas terminas
    public function actionSubirprendaterminada($id_balanceo, $idordenproduccion)
    {
        $model = new FormPrendasTerminadas();
        $suma = 0;
        $balanceo = Balanceo::findOne($id_balanceo);
        $total = 0;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if (isset($_POST["enviarcantidad"])) { 
                    if (isset($_POST["id_detalle_orden"])) {
                        $intIndice = 0;
                        foreach ($_POST["id_detalle_orden"] as $intCodigo):
                           $iddetalleorden = $intCodigo;
                            $orden_detalle = Ordenproducciondetalle::find()->where(['=','iddetalleorden', $intCodigo])->one();
                            $total = $orden_detalle->faltante + $model->cantidad_terminada;
                            if($total <= $orden_detalle->cantidad){
                                if($model->cantidad_terminada > 0 && $model->fecha_entrada != '' ){ 
                                    $table = new CantidadPrendaTerminadas();
                                    $table->id_balanceo = $id_balanceo;
                                    $table->idordenproduccion = $idordenproduccion;
                                    $table->cantidad_terminada = $model->cantidad_terminada;
                                    $table->fecha_entrada = $model->fecha_entrada;
                                    $table->nro_operarios = $model->nro_operarios;
                                    $table->usuariosistema = Yii::$app->user->identity->username;
                                    $table->observacion = $model->observacion;
                                    $table->iddetalleorden = $intCodigo;
                                    $table->insert();
                                    $intIndice ++;
                                }else{
                                   Yii::$app->getSession()->setFlash('warning', 'Campos vacios en el ingrero.'); 
                                }    
                            }else{
                                Yii::$app->getSession()->setFlash('error', 'Favor validar la cantidad de prendas confeccionadas.!');
                            }    
                        endforeach;
                        $detalle_proceso = Ordenproducciondetalleproceso::find()->where(['=','iddetalleorden', $intCodigo])->all();
                        $contar = 0;
                        foreach ($detalle_proceso as $entrarcantidad):
                           $contar = $entrarcantidad->cantidad_operada; 
                           $entrarcantidad->cantidad_operada = $model->cantidad_terminada + $contar;
                           $entrarcantidad->save(false);
                           $contar = 0;
                        endforeach;
                        $orden = Ordenproduccion::findOne($idordenproduccion);
                        $unidades = 0;
                        $orden_detalle = Ordenproducciondetalle::find()->where(['=','iddetalleorden', $intCodigo])->one();
                        $cantidad = CantidadPrendaTerminadas::find()->where(['=','iddetalleorden', $intCodigo])->all();
                        $ordenunidad = CantidadPrendaTerminadas::find()->where(['=','idordenproduccion', $idordenproduccion])->all();
                        $suma = 0;
                        $cantidad_real = 0;
                        foreach ($cantidad as $detalle):
                            $suma +=$detalle->cantidad_terminada; 
                        endforeach;
                        $orden_detalle->faltante = $suma;
                        $orden_detalle->save(false);
                        foreach ($ordenunidad as $cant):
                            $unidades += $cant->cantidad_terminada; 
                        endforeach;
                        $cantidad_real= $orden->cantidad;
                        $orden->faltante = $cantidad_real - $unidades;
                        $orden->save(false);
                       $this->ActualizaPorcentajeCantidad($iddetalleorden, $idordenproduccion);                    
                       return $this->redirect(['view_balanceo','id' => $idordenproduccion]);
                    }
                }
            }                
        }
        if (Yii::$app->request->get($id_balanceo, $idordenproduccion)) {
            $model->nro_operarios = $balanceo->cantidad_empleados;
        }
        return $this->renderAjax('_subirprendaterminada', [
            'model' => $model,       
            'idordenproduccion' => $idordenproduccion,
            'balanceo' => $balanceo,
            
        ]);      
    }
        
    protected function ActualizaPorcentajeCantidad($iddetalleorden, $idordenproduccion) {
        //actualiza detale
        $canti_operada = 0; $cantidad = 0; $porcentaje = 0;
        $orden_detalle_actualizada = Ordenproducciondetalle::find()->where(['=','iddetalleorden', $iddetalleorden])->one();
        $canti_operada = $orden_detalle_actualizada->faltante;
        $cantidad = $orden_detalle_actualizada->cantidad;
        $porcentaje = number_format(($canti_operada * 100)/ $cantidad,4);
        $orden_detalle_actualizada->porcentaje_cantidad = $porcentaje;
        $orden_detalle_actualizada->cantidad_operada = $canti_operada;
        $orden_detalle_actualizada->save(false);
        //actuliza orden produccion
        $orden = Ordenproduccion::findOne($idordenproduccion);
        $sumadetalle = Ordenproducciondetalle::find()->where(['=','idordenproduccion', $idordenproduccion])->all();
        $contador = 0;
        $total_porcentaje = 0;
        foreach ($sumadetalle as $sumar):
            $contador += $sumar->cantidad_operada;
        endforeach;
        $total_porcentaje = number_format(($contador * 100)/ $orden->cantidad,4);
        $orden->porcentaje_cantidad = $total_porcentaje;
        $orden->save(false);
    }
    public function actionIndexconsulta() {
        if (Yii::$app->user->identity){
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',95])->all()){
            $form = new FormFiltroConsultaOrdenproduccion();
            $idcliente = null;
            $desde = null;
            $hasta = null;
            $codigoproducto = null;
            $facturado = null;
            $tipo = null;
            $ordenproduccionint = null;
            $ordenproduccionext = null;
            if ($form->load(Yii::$app->request->get())) {
                if ($form->validate()) {
                    $idcliente = Html::encode($form->idcliente);
                    $desde = Html::encode($form->desde);
                    $hasta = Html::encode($form->hasta);
                    $codigoproducto = Html::encode($form->codigoproducto);
                    $facturado = Html::encode($form->facturado);
                    $tipo = Html::encode($form->tipo);
                    $ordenproduccionint = Html::encode($form->ordenproduccionint);
                    $ordenproduccionext = Html::encode($form->ordenproduccionext);
                    $table = Ordenproduccion::find()
                            ->andFilterWhere(['=', 'idcliente', $idcliente])
                            ->andFilterWhere(['>=', 'fechallegada', $desde])
                            ->andFilterWhere(['<=', 'fechallegada', $hasta])
                            ->andFilterWhere(['=', 'facturado', $facturado])
                            ->andFilterWhere(['=', 'idtipo', $tipo])
                            ->andFilterWhere(['=', 'ordenproduccion', $ordenproduccionint])
                            ->andFilterWhere(['=', 'codigoproducto', $codigoproducto])
                            ->andFilterWhere(['=', 'ordenproduccionext', $ordenproduccionext]);
                    $table = $table->orderBy('idordenproduccion desc');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $to = $count->count();
                    $pages = new Pagination([
                        'pageSize' => 60,
                        'totalCount' => $count->count()
                    ]);
                    $model = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if(isset($_POST['excel'])){
                        //$table = $table->all();
                        $this->actionExcelconsulta($tableexcel);
                    }
                } else {
                    $form->getErrors();
                }
            } else {
                $table = Ordenproduccion::find()
                        ->orderBy('idordenproduccion desc');
                $tableexcel = $table->all();
                $count = clone $table;
                $pages = new Pagination([
                    'pageSize' => 60,
                    'totalCount' => $count->count(),
                ]);
                $model = $table
                        ->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
                if(isset($_POST['excel'])){
                    //$table = $table->all();
                    $this->actionExcelconsulta($tableexcel);
                }
            }
            $to = $count->count();
            return $this->render('index_consulta', [
                        'model' => $model,
                        'form' => $form,
                        'pagination' => $pages,
            ]);
        }else{
            return $this->redirect(['site/sinpermiso']);
        }
        }else{
            return $this->redirect(['site/login']);
        }
    }
    
    public function actionIndexconsultaficha() {
        if (Yii::$app->user->identity){
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',47])->all()){
            $form = new FormFiltroConsultaFichaoperacion();
            $idcliente = null;
            $ordenproduccion = null;
            $idtipo = null;
            $codigoproducto = null;
            $clientes = Cliente::find()->orderBy('nombrecorto ASC')->all();
            $ordenproducciontipos = Ordenproducciontipo::find()->all();
            if ($form->load(Yii::$app->request->get())) {
                if ($form->validate()) {
                    $idcliente = Html::encode($form->idcliente);
                    $ordenproduccion = Html::encode($form->ordenproduccion);
                    $idtipo = Html::encode($form->idtipo);
                    $codigoproducto = Html::encode($form->codigoproducto);
                    $table = Ordenproduccion::find()
                            ->andFilterWhere(['=', 'idcliente', $idcliente])
                            ->andFilterWhere(['like', 'ordenproduccion', $ordenproduccion])
                            ->andFilterWhere(['=', 'codigoproducto', $codigoproducto])
                            ->andFilterWhere(['=', 'idtipo', $idtipo])
                            ->orderBy('idordenproduccion desc');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $to = $count->count();
                    $pages = new Pagination([
                        'pageSize' => 40,
                        'totalCount' => $count->count()
                    ]);
                    $model = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if(isset($_POST['excel'])){
                        //$table = $table->all();
                        $this->actionExcelconsultaficha($tableexcel);
                    }
                } else {
                    $form->getErrors();
                }
            } else {
                $table = Ordenproduccion::find()
                        ->orderBy('idordenproduccion desc');
                $tableexcel = $table->all();
                $count = clone $table;
                $pages = new Pagination([
                    'pageSize' => 40,
                    'totalCount' => $count->count(),
                ]);
                $model = $table
                        ->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
                if(isset($_POST['excel'])){
                        //$table = $table->all();
                        $this->actionExcelconsultaficha($tableexcel);
                }
            }

            return $this->render('index_consulta_ficha', [
                        'model' => $model,
                        'form' => $form,
                        'pagination' => $pages,
                        'clientes' => ArrayHelper::map($clientes, "idcliente", "nombrecorto"),
                        'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
            ]);
         }else{
            return $this->redirect(['site/sinpermiso']);
        }
        }else{
            return $this->redirect(['site/login']);
        }
    }
    
    public function actionViewconsulta($id) {
        $modeldetalles = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $id])->all();
        $modeldetalle = new Ordenproducciondetalle();
        $mensaje = "";
              
        return $this->render('view_consulta', [
                    'model' => $this->findModel($id),
                    'modeldetalle' => $modeldetalle,
                    'modeldetalles' => $modeldetalles,
                    'mensaje' => $mensaje,
        ]);
    }
    
    public function actionViewconsultaficha($id) {
        $modeldetalles = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $id])->all();
        $modulos = Balanceo::find()->where(['=','idordenproduccion', $id])->all();
        $modeldetalle = new Ordenproducciondetalle();
        
        return $this->render('view_consulta_ficha', [
                    'model' => $this->findModel($id),
                    'modeldetalle' => $modeldetalle,                    
                    'modeldetalles' => $modeldetalles,
                    'modulos' => $modulos,
                    
        ]);
    }
    
  //VENTANA MODAL DE LA EFICIENCIA DEL MODULO
    
    public function actionEficienciamodulo($id_balanceo){
       $unidades= CantidadPrendaTerminadas::find()->where(['=','id_balanceo', $id_balanceo])->groupBy('fecha_entrada')->all(); 
        return $this->render('eficienciafecha', [
                        'unidades' => $unidades,
                        'id_balanceo' => $id_balanceo,
            ]);    
       
    }
    
    public function actionDetalle_proceso_consulta($idordenproduccion, $iddetalleorden) {
        $procesos = Ordenproducciondetalleproceso::find()->Where(['=', 'iddetalleorden', $iddetalleorden])->orderBy('proceso asc')->all();
        $detalle = Ordenproducciondetalle::findOne($iddetalleorden);
        $error = 0;
        $cont = count($procesos);
        
        return $this->renderAjax('_formdetalleprocesoconsulta', [
                    'procesos' => $procesos,
                    'cont' => $cont,
                    'idordenproduccion' => $idordenproduccion,
                    'iddetalleorden' => $iddetalleorden,
        ]);
    }
    
    public function actionExcelconsulta($tableexcel) {                
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("EMPRESA")
            ->setLastModifiedBy("EMPRESA")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
                               
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Id')
                    ->setCellValue('B1', 'Cod Producto')
                    ->setCellValue('C1', 'Cliente')
                    ->setCellValue('D1', 'Orden Prod Int')
                    ->setCellValue('E1', 'Orden Prod Ext')
                    ->setCellValue('F1', 'Fecha Llegada')
                    ->setCellValue('G1', 'Fecha Proceso')
                    ->setCellValue('H1', 'Fecha Entrega')
                    ->setCellValue('I1', 'Cantidad')
                    ->setCellValue('J1', 'Tipo')
                    ->setCellValue('K1', 'Total')
                    ->setCellValue('L1', 'Autorizado')
                    ->setCellValue('M1', 'Facturado')
                    ->setCellValue('N1', 'Observacion');
        $i = 2;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->idordenproduccion)
                    ->setCellValue('B' . $i, $val->codigoproducto)
                    ->setCellValue('C' . $i, $val->cliente->nombreClientes)
                    ->setCellValue('D' . $i, $val->ordenproduccion)
                    ->setCellValue('E' . $i, $val->ordenproduccionext)
                    ->setCellValue('F' . $i, $val->fechallegada)
                    ->setCellValue('G' . $i, $val->fechaprocesada)
                    ->setCellValue('H' . $i, $val->fechaentrega)
                    ->setCellValue('I' . $i, $val->cantidad)
                    ->setCellValue('J' . $i, $val->tipo->tipo)
                    ->setCellValue('K' . $i, round($val->totalorden,0))
                    ->setCellValue('L' . $i, $val->autorizar)
                    ->setCellValue('M' . $i, $val->facturar)
                    ->setCellValue('N' . $i, $val->observacion);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('ordenes_produccion');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ordenes_produccion.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }
    
    public function actionExcelconsultaficha($tableexcel) {                
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("EMPRESA")
            ->setLastModifiedBy("EMPRESA")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
                               
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Id')
                    ->setCellValue('B1', 'Cod Producto')
                    ->setCellValue('C1', 'Cliente')
                    ->setCellValue('D1', 'Orden Prod Int')
                    ->setCellValue('E1', 'Orden Prod Ext')
                    ->setCellValue('F1', 'Fecha Llegada')
                    ->setCellValue('G1', 'Fecha Proceso')
                    ->setCellValue('H1', 'Fecha Entrega')
                    ->setCellValue('I1', 'Cantidad')
                    ->setCellValue('J1', 'Tipo')                    
                    ->setCellValue('K1', 'Porcentaje');
        $i = 2;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->idordenproduccion)
                    ->setCellValue('B' . $i, $val->codigoproducto)
                    ->setCellValue('C' . $i, $val->cliente->nombreClientes)
                    ->setCellValue('D' . $i, $val->ordenproduccion)
                    ->setCellValue('E' . $i, $val->ordenproduccionext)
                    ->setCellValue('F' . $i, $val->fechallegada)
                    ->setCellValue('G' . $i, $val->fechaprocesada)
                    ->setCellValue('H' . $i, $val->fechaentrega)
                    ->setCellValue('I' . $i, $val->cantidad)
                    ->setCellValue('J' . $i, $val->tipo->tipo)
                    ->setCellValue('K' . $i, 'Proceso '.round($val->porcentaje_proceso,1).' % - Cantidad '.round($val->porcentaje_cantidad,1).' %');
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Ficha_operaciones');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Ficha_operaciones.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }
    
    public function actionExcelconsultaUnidades($tableexcel) {                
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("EMPRESA")
            ->setLastModifiedBy("EMPRESA")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
                               
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID')
                    ->setCellValue('B1', 'NRO BALANCEO')
                    ->setCellValue('C1', 'ORD. PRODUCCION')
                    ->setCellValue('D1', 'CLIENTE')
                    ->setCellValue('E1', 'REFERENCIA')
                    ->setCellValue('F1', 'CANTIDADES')
                    ->setCellValue('G1', 'FACTURADO')
                    ->setCellValue('H1', 'FECHA PROCESO')
                    ->setCellValue('I1', 'USUARIO')
                    ->setCellValue('J1', 'OBSERVACION');
        $i = 2;
        $facturado = 0;
        foreach ($tableexcel as $val) {
           $facturado = round($val->detalleorden->vlrprecio * $val->cantidad_terminada);                      
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->id_entrada)
                    ->setCellValue('B' . $i, $val->id_balanceo)
                    ->setCellValue('C' . $i, $val->idordenproduccion)
                    ->setCellValue('D' . $i, $val->ordenproduccion->cliente->nombreClientes)
                    ->setCellValue('E' . $i, $val->detalleorden->productodetalle->prendatipo->prenda .' / '. $val->detalleorden->productodetalle->prendatipo->talla->talla)
                    ->setCellValue('F' . $i, $val->cantidad_terminada)
                     ->setCellValue('G' . $i, $facturado)
                    ->setCellValue('H' . $i, $val->fecha_entrada)
                    ->setCellValue('I' . $i, $val->usuariosistema)
                    ->setCellValue('J' . $i, $val->observacion);
                  
            $i++;
        }
        $objPHPExcel->getActiveSheet()->setTitle('Unidades_confeccionadas');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Cantidad_unidades.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }
    public function actionExcelOrdenTercero($tableexcel) {                
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("EMPRESA")
            ->setLastModifiedBy("EMPRESA")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
                               
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'NRO ORDEN')
                    ->setCellValue('B1', 'PROVEEDOR')
                    ->setCellValue('C1', 'CLIENTE')
                    ->setCellValue('D1', 'OP CLIENTE')
                    ->setCellValue('E1', 'PROCESO')
                    ->setCellValue('F1', 'REFERENCIA')
                    ->setCellValue('G1', 'FECHA PROCESO')
                    ->setCellValue('H1', 'FECHA REGISTRO')
                    ->setCellValue('I1', 'VR. MINUTO')
                    ->setCellValue('J1', 'TOTAL MINUTOS')
                    ->setCellValue('K1', 'TOTAL UNIDADES')
                     ->setCellValue('L1', 'TOTAL PAGAR')
                     ->setCellValue('M1', 'USUARIO')
                     ->setCellValue('N1', 'AUTORIZADO')
                     ->setCellValue('O1', 'OBSERVACION');
                    
        $i = 2;
        foreach ($tableexcel as $val) {
         
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->id_orden_tercero)
                    ->setCellValue('B' . $i, $val->proveedor->nombrecorto)
                    ->setCellValue('C' . $i, $val->cliente->nombrecorto)
                    ->setCellValue('D' . $i, $val->idordenproduccion)
                    ->setCellValue('E' . $i, $val->tipo->tipo)
                    ->setCellValue('F' . $i, $val->codigo_producto)
                    ->setCellValue('G' . $i, $val->fecha_proceso)
                    ->setCellValue('H' . $i, $val->fecha_registro)
                    ->setCellValue('I' . $i, $val->vlr_minuto)
                    ->setCellValue('J' . $i, $val->cantidad_minutos)
                    ->setCellValue('K' . $i, $val->cantidad_unidades)
                    ->setCellValue('L' . $i, $val->total_pagar)
                    ->setCellValue('M' . $i, $val->usuariosistema)
                    ->setCellValue('N' . $i, $val->autorizadoTercero)
                    ->setCellValue('O' . $i, $val->observacion);
                    
                  
            $i++;
        }
        $objPHPExcel->getActiveSheet()->setTitle('Orden_prodccion_tercero');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Orden_produccion.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }
    
    public function actionExceloperaciones($id,$iddetalleorden) {
        $orden = Ordenproduccion::findOne($id);
        $ordendetalle = Ordenproducciondetalle::findOne($iddetalleorden);
        $ordendetalleproceso = Ordenproducciondetalleproceso::find()->where(['=','iddetalleorden',$iddetalleorden])->all();
        $items = count($ordendetalleproceso);
        $totalsegundos = 0;
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("EMPRESA")
            ->setLastModifiedBy("EMPRESA")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('4')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
                               
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'FICHA OPERACIONES')
                    ->setCellValue('A2', 'NIT:')
                    ->setCellValue('B2', $orden->cliente->cedulanit . '-' . $orden->cliente->dv)
                    ->setCellValue('C2', 'FECHA LLEGADA:')
                    ->setCellValue('D2', $orden->fechallegada)
                    ->setCellValue('A3', 'CLIENTE:')
                    ->setCellValue('B3', $orden->cliente->nombrecorto)
                    ->setCellValue('C3', 'FECHA ENTREGA:')
                    ->setCellValue('D3', $orden->fechaentrega)
                    ->setCellValue('A4', 'COD PRODUCTO:')
                    ->setCellValue('B4', $orden->codigoproducto)
                    ->setCellValue('C4', 'ORDEN PRODUCCION:')
                    ->setCellValue('D4', $orden->ordenproduccion)
                    ->setCellValue('A5', 'PRODUCTO:')
                    ->setCellValue('B5', $ordendetalle->productodetalle->prendatipo->prenda.' / '.$ordendetalle->productodetalle->prendatipo->talla->talla)
                    ->setCellValue('C5', 'TIPO ORDEN:')
                    ->setCellValue('D5', $orden->tipo->tipo)
                    ->setCellValue('A6', 'ID')
                    ->setCellValue('B6', 'PROCESO')
                    ->setCellValue('C6', 'DURACION(SEG)')
                    ->setCellValue('D6', 'TOTAL OPERACION')
                    ->setCellValue('E6', 'PONDERACION (SEG)')
                    ->setCellValue('F6', 'TOTAL (SEG)') 
                    ->setCellValue('G6', 'MAQUINA');
                   
        $i = 7;
        
        foreach ($ordendetalleproceso as $val) {
            $totalsegundos = $totalsegundos + $val->total;                      
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->iddetalleproceso)
                    ->setCellValue('B' . $i, $val->proceso)
                    ->setCellValue('C' . $i, $val->duracion)
                    ->setCellValue('D' . $i, round(60 / $val->duracion * 60))
                    ->setCellValue('E' . $i, $val->ponderacion)                    
                    ->setCellValue('F' . $i, $val->total)                    
                     ->setCellValue('G' . $i, $val->tipomaquina->descripcion);
                    
                   
                        
            $i++;
        }
        $j = $i + 1;
        $objPHPExcel->getActiveSheet()->getStyle($j)->getFont()->setBold(true);
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('C' . $j, 'Items: '.$items)
                ->setCellValue('D' . $j, 'Total Segundos: '. $totalsegundos)
                ->setCellValue('E' . $j, 'Total Minutos: '. round($totalsegundos / 60),1);
        
        $objPHPExcel->getActiveSheet()->setTitle('ficha_operaciones');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ficha_operaciones.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }
    
    public function actionCantidadconfeccionada($iddetalleorden) {                
        $cantidades = CantidadPrendaTerminadas::find()->where(['=','iddetalleorden', $iddetalleorden])->all();
        $detalletallas = Ordenproducciondetalle::findOne($iddetalleorden);
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("EMPRESA")
            ->setLastModifiedBy("EMPRESA")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        
                               
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID')
                    ->setCellValue('B1', 'F. ENTRADA')
                    ->setCellValue('C1', 'F. REGISTRO')
                    ->setCellValue('D1', 'CANT.')
                    ->setCellValue('E1', 'USUARIO')
                    ->setCellValue('F1', 'OBSERVACION');
        $i = 2;
        
        foreach ($cantidades as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->id_entrada)
                    ->setCellValue('B' . $i, $val->fecha_entrada)
                    ->setCellValue('C' . $i, $val->fecha_procesada)
                    ->setCellValue('D' . $i, $val->cantidad_terminada)
                    ->setCellValue('E' . $i, $val->usuariosistema)
                    ->setCellValue('F' . $i, $val->observacion);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Cantidad x tallas');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Cantidades_Talla.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }

}
