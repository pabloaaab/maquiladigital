<?php

namespace app\controllers;


use Yii;
use app\models\Recibocaja;
use app\models\ReciboCajaSearch;
use app\models\Recibocajadetalle;
use app\models\Facturaventa;
use app\models\Consecutivo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Cliente;
use app\models\Municipio;
use app\models\TipoRecibo;
use yii\helpers\ArrayHelper;
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


/**
 * RecibocajaController implements the CRUD actions for Recibocaja model.
 */
class RecibocajaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all Recibocaja models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReciboCajaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Recibocaja model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modeldetalles = Recibocajadetalle::find()->Where(['=', 'idrecibo', $id])->all();
        $modeldetalle = new Recibocajadetalle();
        $mensaje = "";
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modeldetalle' => $modeldetalle,
            'modeldetalles' => $modeldetalles,
            'mensaje' => $mensaje,
        ]);
    }

    /**
     * Creates a new Recibocaja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Recibocaja();
        $clientes = Cliente::find()->all();
        $municipios = Municipio::find()->all();
        $tipoRecibos = TipoRecibo::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->valorletras = "-";
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->update();
            return $this->redirect(['view', 'id' => $model->idrecibo]);
        }

        return $this->render('create', [
            'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreclientes"),
            'tiporecibos' => ArrayHelper::map($tipoRecibos, "idtiporecibo", "concepto"),
            'municipios' => ArrayHelper::map($municipios, "idmunicipio", "municipioCompleto"),
        ]);
    }

    /**
     * Updates an existing Recibocaja model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $clientes = Cliente::find()->all();
        $municipios = Municipio::find()->all();
        $tipoRecibos = TipoRecibo::find()->all();
        if(Recibocajadetalle::find()->where(['=', 'idrecibo', $id])->all() or $model->estado <> 0){
           Yii::$app->getSession()->setFlash('warning', 'No se puede modificar la información, tiene detalles asociados');
        }
        else if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrecibo]);
        }

        return $this->render('update', [
            'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreclientes"),
            'tiporecibos' => ArrayHelper::map($tipoRecibos, "idtiporecibo", "concepto"),
            'municipios' => ArrayHelper::map($municipios, "idmunicipio", "municipioCompleto"),
        ]);
    }

    /**
     * Deletes an existing Recibocaja model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
            $this->redirect(["recibocaja/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["recibocaja/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el recibo de caja, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el recibo de caja, tiene registros asociados en otros procesos');
            $this->redirect(["recibocaja/index"]);
        }
    }

    /**
     * Finds the Recibocaja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recibocaja the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionNuevodetalles($idcliente,$idrecibo)
    {

        $reciboFactura = Facturaventa::find()
            ->where(['=', 'idcliente', $idcliente])
            ->andWhere(['=', 'autorizado', 1])->andWhere(['<>', 'nrofactura', 0])
            ->andWhere(['<>', 'saldo', 0])
            ->all();
        $mensaje = "";
        if(Yii::$app->request->post()) {
            if (isset($_POST["idfactura"])) {
                $intIndice = 0;
                foreach ($_POST["idfactura"] as $intCodigo) {
                    $table = new Recibocajadetalle();
                    $factura = Facturaventa::find()->where(['idfactura' => $intCodigo])->one();
                    $detalles = Recibocajadetalle::find()
                        ->where(['=', 'idfactura', $factura->idfactura])
                        ->andWhere(['=', 'idrecibo', $idrecibo])
                        ->all();
                    $reg = count($detalles);
                    if ($reg == 0) {
                        $table->idfactura = $factura->idfactura;
                        $table->vlrabono = $factura->totalpagar;
                        $table->vlrsaldo = $factura->saldo;
                        $table->retefuente = $factura->retencionfuente;
                        $table->reteiva = $factura->retencioniva;
                        $table->idrecibo = $idrecibo;
                        $table->insert();
                        $recibo = Recibocaja::findOne($idrecibo);
                        //$recibo->valorpagado = $recibo->valorpagado + $table->vlrabono;
                        //$recibo->update();
                    }
                }
                $this->redirect(["recibocaja/view", 'id' => $idrecibo]);
            } else {
                $mensaje = "Debe seleccionar al menos un registro";
            }
        }
        return $this->render('_formnuevodetalles', [
            'reciboFactura' => $reciboFactura,
            'idrecibo' => $idrecibo,
            'mensaje' => $mensaje,

        ]);
    }

    public function actionEditardetalle()
    {
        $iddetallerecibo = Html::encode($_POST["iddetallerecibo"]);
        $idrecibo = Html::encode($_POST["idrecibo"]);

        if(Yii::$app->request->post()){

            if((int) $iddetallerecibo)
            {
                $table = Recibocajadetalle::findOne($iddetallerecibo);
                if ($table) {

                    $table->vlrabono = Html::encode($_POST["vlrabono"]);

                    $table->idrecibo = Html::encode($_POST["idrecibo"]);
                    $table->update();

                    /*$recibo = Recibocaja::findOne($table->idrecibo);
                    $recibo->valorpagado = $recibo->valorpagado - Html::encode($_POST["total"]);
                    $recibo->valorpagado = $recibo->valorpagado + $table->vlrabono;
                    $recibo->update();*/

                    $this->redirect(["recibocaja/view",'id' => $idrecibo]);

                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                    $tipomsg = "danger";
                }
            }
        }
        //return $this->render("_formeditardetalle", ["model" => $model,]);
    }

    public function actionEditardetalles($idrecibo)
    {
        $mds = Recibocajadetalle::find()->where(['=', 'idrecibo', $idrecibo])->all();

        if (isset($_POST["iddetallerecibo"])) {
            $intIndice = 0;
            foreach ($_POST["iddetallerecibo"] as $intCodigo) {
                if($_POST["vlrabono"][$intIndice] > 0 ){
                    $table = Recibocajadetalle::findOne($intCodigo);
                    $total = $table->vlrabono;
                    $table->vlrabono = $_POST["vlrabono"][$intIndice];

                    /*$table->update();
                    $recibo = Recibocaja::findOne($idrecibo);
                    $recibo->valorpagado = $recibo->valorpagado - $total;
                    $recibo->valorpagado = $recibo->valorpagado + $table->vlrabono;

                    $recibo->update();*/
                }
                $intIndice++;
            }
            $this->redirect(["recibocaja/view",'id' => $idrecibo]);
        }
        return $this->render('_formeditardetalles', [
            'mds' => $mds,
            'idrecibo' => $idrecibo,
        ]);
    }

    public function actionEliminardetalle()
    {
        if(Yii::$app->request->post())
        {
            $iddetallerecibo = Html::encode($_POST["iddetallerecibo"]);
            $idrecibo = Html::encode($_POST["idrecibo"]);
            if((int) $iddetallerecibo)
            {
                $reciboDetalle = Recibocajadetalle::findOne($iddetallerecibo);
                $total = $reciboDetalle->vlrabono;
                if(Recibocajadetalle::deleteAll("iddetallerecibo=:iddetallerecibo", [":iddetallerecibo" => $iddetallerecibo]))
                {
                    /*$recibo = Recibocaja::findOne($idrecibo);
                    $recibo->valorpagado = $recibo->valorpagado - $total;
                    $recibo->update();*/

                    $this->redirect(["recibocaja/view",'id' => $idrecibo]);
                }
                else
                {
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("recibocaja/index")."'>";
                }
            }
            else
            {
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("recibocaja/index")."'>";
            }
        }
        else
        {
            return $this->redirect(["recibocaja/index"]);
        }
    }

    public function actionEliminardetalles($idrecibo)
    {
        $mds = Recibocajadetalle::find()->where(['=', 'idrecibo', $idrecibo])->all();
        $mensaje = "";
        if(Yii::$app->request->post())
        {
            $intIndice = 0;

            if (isset($_POST["seleccion"])) {
                foreach ($_POST["seleccion"] as $intCodigo)
                {
                    $reciboDetalle = Recibocajadetalle::findOne($intCodigo);
                    $total = $reciboDetalle->vlrabono;
                    if(Recibocajadetalle::deleteAll("iddetallerecibo=:iddetallerecibo", [":iddetallerecibo" => $intCodigo]))
                    {
                        /*$recibo = Recibocaja::findOne($idrecibo);
                        $recibo->valorpagado = $recibo->valorpagado - $total;
                        $recibo->update();*/
                    }
                }
                $this->redirect(["recibocaja/view",'id' => $idrecibo]);
            }else {
                $mensaje = "Debe seleccionar al menos un registro";
            }
        }
        return $this->render('_formeliminardetalles', [
            'mds' => $mds,
            'idrecibo' => $idrecibo,
            'mensaje' => $mensaje,
        ]);
    }

    public function actionAutorizado($id)
    {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->autorizado == 0){
            $detalles = Recibocajadetalle::find()
                ->where(['=', 'idrecibo', $id])
                ->all();
            $reg = count($detalles);
            if ($reg <> 0) {
                $error = 0;
                foreach ($detalles as $dato){
                    if ($dato->vlrabono > $dato->vlrsaldo){
                        $error = 1;
                    }
                }
                if ($error == 0){
                    $model->autorizado = 1;
                    $model->update();
                    $this->redirect(["recibocaja/view",'id' => $id]);
                }else{
                    Yii::$app->getSession()->setFlash('error', 'Los abonos no pueden ser mayores a los saldos.');
                    $this->redirect(["recibocaja/view",'id' => $id]);
                }

            }else{
                Yii::$app->getSession()->setFlash('error', 'Para autorizar el registro, debe tener facturas relacionados en el recibo de caja.');
                $this->redirect(["recibocaja/view",'id' => $id]);
            }

        } else {
            if ($model->valorpagado <> 0) {
                Yii::$app->getSession()->setFlash('error', 'No se puede desautorizar el registro, ya fue pagado.');
                $this->redirect(["recibocaja/view",'id' => $id]);
            } else {
                $model->autorizado = 0;
                $model->update();
                $this->redirect(["recibocaja/view",'id' => $id]);
            }
        }
    }

    public function actionPagar($id)
    {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->autorizado == 1){
            if ($model->valorpagado == 0){
                $recibodetalles = Recibocajadetalle::find()
                    ->where(['idrecibo' => $id])
                    ->all();
                $total = 0;
                $error = 0;
                foreach ($recibodetalles as $dato){
                    if ($dato->vlrabono > $dato->vlrsaldo){
                        $error = 1;
                    }
                }
                if ($error == 0){
                    foreach ($recibodetalles as $val) {
                        $recibodetalle = Recibocajadetalle::findOne($val->iddetallerecibo);
                        $recibodetalle->vlrsaldo = ($recibodetalle->vlrsaldo) - ($recibodetalle->vlrabono);
                        $total = $total + $val->vlrabono;
                        $recibodetalle->update();
                        $factura = Facturaventa::findOne($val->idfactura);
                        $factura->saldo = $recibodetalle->vlrsaldo;
                        if($factura->saldo <= 0){
                            $factura->estado = 2; //estado 0 = abieto, estado 1 = abono, estado 2 = pagada, estado 3 = anulada por notacredito (saldo 0 en la factura) 
                        }elseif ($factura->saldo >= 0){
                            $factura->estado = 1; //estado 0 = abieto, estado 1 = abono, estado 2 = pagada, estado 3 = anulada por notacredito (saldo 0 en la factura)
                        }
                        $factura->update();
                    }
                    $model->valorpagado = $total;
                    $model->fechapago = date('Y-m-d');
                    //generar consecutivo numero de la nota credito
                    $consecutivo = Consecutivo::findOne(3);//2 nota credito
                    $consecutivo->consecutivo = $consecutivo->consecutivo + 1;
                    $model->numero = $consecutivo->consecutivo;
                    $model->update();
                    $consecutivo->update();
                    //fin generar consecutivo
                    $this->redirect(["recibocaja/view",'id' => $id]);
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Los abonos no pueden ser mayores a los saldos.');
                        $this->redirect(["recibocaja/view",'id' => $id]);
                    }
            }else{
                Yii::$app->getSession()->setFlash('error', 'Ya se realizo el pago del recibo de caja.');
                $this->redirect(["recibocaja/view",'id' => $id]);
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Para pagar el recibo de caja debe estar autorizado');
            $this->redirect(["recibocaja/view",'id' => $id]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Recibocaja::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionImprimir($id)
    {                                
        return $this->render('../formatos/reciboCaja', [
            'model' => $this->findModel($id),
            
        ]);
    }
}
