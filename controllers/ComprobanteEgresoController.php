<?php

namespace app\controllers;

use Yii;
use app\models\ComprobanteEgreso;
use app\models\ComprobanteEgresoSearch;
use app\models\Proveedor;
use app\models\ComprobanteEgresoTipo;
use app\models\ComprobanteEgresoDetalle;
use app\models\Municipio;
use app\models\Consecutivo;
use app\models\UsuarioDetalle;
use app\models\Banco;
use app\models\Compra;
use app\models\FormComprobanteegresolibre;
use app\models\FormComprobanteegresonuevodetallelibre;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
 * ComprobanteEgresoController implements the CRUD actions for ComprobanteEgreso model.
 */
class ComprobanteEgresoController extends Controller
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
     * Lists all ComprobanteEgreso models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',38])->all()){
            $searchModel = new ComprobanteEgresoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['site/sinpermiso']);
        }    
    }

    /**
     * Displays a single ComprobanteEgreso model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modeldetalles = ComprobanteEgresoDetalle::find()->Where(['=', 'id_comprobante_egreso', $id])->all();
        $modeldetalle = new ComprobanteEgresoDetalle();
        $mensaje = "";
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modeldetalle' => $modeldetalle,
            'modeldetalles' => $modeldetalles,
            'mensaje' => $mensaje,
        ]);
    }

    /**
     * Creates a new ComprobanteEgreso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComprobanteEgreso();
        $proveedores = Proveedor::find()->all();
        $municipios = Municipio::find()->all();
        $bancos = Banco::find()->all();
        $tipos = ComprobanteEgresoTipo::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {            
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->update();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'proveedores' => ArrayHelper::map($proveedores, "idproveedor", "nombreproveedores"),
            'tipos' => ArrayHelper::map($tipos, "id_comprobante_egreso_tipo", "concepto"),
            'municipios' => ArrayHelper::map($municipios, "idmunicipio", "municipioCompleto"),
            'bancos' => ArrayHelper::map($bancos, "idbanco", "entidad"),
        ]);
    }
    
    public function actionCreatelibre()
    {
        $model = new FormComprobanteegresolibre();
        $proveedores = Proveedor::find()->all();
        $municipios = Municipio::find()->all();
        $bancos = Banco::find()->all();
        $tipos = ComprobanteEgresoTipo::find()->all();
        if ($model->load(Yii::$app->request->post())) {
            $table = new ComprobanteEgreso;
            $table->id_proveedor = $model->id_proveedor;
            $table->id_banco = $model->id_banco;            
            $table->observacion = $model->observacion;
            $table->fecha_comprobante = $model->fecha_comprobante;
            $table->id_comprobante_egreso_tipo = $model->id_comprobante_egreso_tipo;
            $table->id_municipio = $model->id_municipio;            
            $table->usuariosistema = Yii::$app->user->identity->username;
            $table->libre = 1;
            $table->insert();
            return $this->redirect(['index']);
        }

        return $this->render('_formlibre', [
            'model' => $model,
            'proveedores' => ArrayHelper::map($proveedores, "idproveedor", "nombreproveedores"),
            'tipo' => ArrayHelper::map($tipos, "id_comprobante_egreso_tipo", "concepto"),
            'municipios' => ArrayHelper::map($municipios, "idmunicipio", "municipioCompleto"),
            'bancos' => ArrayHelper::map($bancos, "idbanco", "entidad"),
        ]);
    }

    /**
     * Updates an existing ComprobanteEgreso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $proveedores = Proveedor::find()->all();
        $municipios = Municipio::find()->all();
        $bancos = Banco::find()->all();
        $tipos = ComprobanteEgresoTipo::find()->all();
        if($model->libre == 1){
                return $this->redirect(['updatelibre', 'id' => $id]);
            }
        if(ComprobanteEgresoDetalle::find()->where(['=', 'id_comprobante_egreso', $id])->all() or $model->estado <> 0){
           Yii::$app->getSession()->setFlash('warning', 'No se puede modificar la información, tiene detalles asociados');
        }
        else             
            if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_comprobante_egreso]);
        }

        return $this->render('update', [
            'model' => $model,
            'proveedores' => ArrayHelper::map($proveedores, "idproveedor", "nombreproveedores"),
            'tipos' => ArrayHelper::map($tipos, "id_comprobante_egreso_tipo", "concepto"),
            'municipios' => ArrayHelper::map($municipios, "idmunicipio", "municipioCompleto"),
            'bancos' => ArrayHelper::map($bancos, "idbanco", "entidad"),
        ]);
    }
    
    public function actionUpdatelibre($id) {
        $model = new FormComprobanteegresolibre;
        $proveedores = Proveedor::find()->all();
        $municipios = Municipio::find()->all();
        $bancos = Banco::find()->all();
        $tipos = ComprobanteEgresoTipo::find()->all();
        $table = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if(ComprobanteEgresoDetalle::find()->where(['=', 'id_comprobante_egreso', $id])->all() or $table->estado <> 0){
           Yii::$app->getSession()->setFlash('warning', 'No se puede modificar la información, tiene detalles asociados');
           //return $this->redirect(['updatelibre', 'id' => $id]);
        }
        else{
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    if ($table) {                                        
                        $table->id_proveedor = $model->id_proveedor;
                        $table->id_banco = $model->id_banco;            
                        $table->observacion = $model->observacion;
                        $table->fecha_comprobante = $model->fecha_comprobante;
                        $table->id_comprobante_egreso_tipo = $model->id_comprobante_egreso_tipo;
                        $table->id_municipio = $model->id_municipio;                                            
                        if ($table->update()) {
                            $msg = "El registro ha sido actualizado correctamente";
                            return $this->redirect(["index"]);
                        } else {
                            $msg = "El registro no sufrio ningun cambio";
                            return $this->redirect(["index"]);
                        }
                    } else {
                        $msg = "El registro seleccionado no ha sido encontrado";
                    }
                } else {
                    $model->getErrors();
                }
            }
        }
        if (Yii::$app->request->get("id")) {
            $table = $this->findModel($id);
            if ($table) {
                $model->id_proveedor = $table->id_proveedor;
                $model->id_banco = $table->id_banco;
                $model->fecha_comprobante = $table->fecha_comprobante;                
                $model->observacion = $table->observacion;
                $model->id_municipio = $table->id_municipio;
                $model->id_comprobante_egreso_tipo = $table->id_comprobante_egreso_tipo;
            } else {
                return $this->redirect(["index"]);
            }
        } else {
            return $this->redirect(["index"]);
        }
        return $this->render('_formlibre', [
            'model' => $model,
            'proveedores' => ArrayHelper::map($proveedores, "idproveedor", "nombreproveedores"),
            'tipo' => ArrayHelper::map($tipos, "id_comprobante_egreso_tipo", "concepto"),
            'municipios' => ArrayHelper::map($municipios, "idmunicipio", "municipioCompleto"),
            'bancos' => ArrayHelper::map($bancos, "idbanco", "entidad"),
        ]);
    }

    /**
     * Deletes an existing ComprobanteEgreso model.
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
            $this->redirect(["comprobante-egreso/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["comprobante-egreso/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el comprobante, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el comprobante, tiene registros asociados en otros procesos');
            $this->redirect(["comprobante-egreso/index"]);
        }
    }
    
    public function actionNuevodetalles($id_proveedor,$id_comprobante_egreso)
    {
        $compraegreso = Compra::find()
            ->where(['=', 'id_proveedor', $id_proveedor])
            ->andWhere(['=', 'autorizado', 1])->andWhere(['<>', 'numero', 0])
            ->andWhere(['<>', 'saldo', 0])
            ->all();
        $mensaje = "";
        if(Yii::$app->request->post()) {
            if (isset($_POST["id_compra"])) {
                $intIndice = 0;
                foreach ($_POST["id_compra"] as $intCodigo) {
                    $table = new ComprobanteEgresoDetalle();
                    $compra = Compra::find()->where(['id_compra' => $intCodigo])->one();
                    $detalles = ComprobanteEgresoDetalle::find()
                        ->where(['=', 'id_compra', $compra->id_compra])
                        ->andWhere(['=', 'id_comprobante_egreso', $id_comprobante_egreso])
                        ->all();
                    $reg = count($detalles);
                    if ($reg == 0) {
                        $table->id_compra = $compra->id_compra;
                        $table->vlr_abono = $compra->total;
                        $table->vlr_saldo = $compra->saldo;
                        $table->retefuente = $compra->retencionfuente;
                        $table->reteiva = $compra->retencioniva;
                        $table->id_comprobante_egreso = $id_comprobante_egreso;
                        $table->insert();
                        //$recibo = ComprobanteEgreso::findOne($id_comprobante_egreso);                        
                    }
                }
                $this->redirect(["comprobante-egreso/view", 'id' => $id_comprobante_egreso]);
            } else {
                $mensaje = "Debe seleccionar al menos un registro";
            }
        }
        return $this->render('_formnuevodetalles', [
            'compraegreso' => $compraegreso,
            'id_comprobante_egreso' => $id_comprobante_egreso,
            'mensaje' => $mensaje,

        ]);
    }
    
    public function actionNuevodetallelibre($id) {
        $model = new FormComprobanteegresonuevodetallelibre();        
        if ($model->load(Yii::$app->request->post())) {
            $table = new ComprobanteEgresoDetalle();
            $table->vlr_abono = $model->vlr_abono;
            $table->id_comprobante_egreso = $id;
            $table->vlr_saldo = 0;
            $table->retefuente = 0;
            $table->reteiva = 0;
            $table->reteica = 0;
            $table->base_aiu = 0;
            $table->save(false);
            return $this->redirect(['view','id' => $id]);
        }
        return $this->renderAjax('_formnuevodetallelibre', [
            'model' => $model,            
        ]);        
    }
    
    public function actionEditardetalle()
    {
        $id_comprobante_egreso_detalle = Html::encode($_POST["id_comprobante_egreso_detalle"]);
        $id_comprobante_egreso = Html::encode($_POST["id_comprobante_egreso"]);
        if(Yii::$app->request->post()){

            if((int) $id_comprobante_egreso_detalle)
            {
                $table = ComprobanteEgresoDetalle::findOne($id_comprobante_egreso_detalle);
                if ($table) {

                    $table->vlr_abono = Html::encode($_POST["vlr_abono"]);
                    $table->id_comprobante_egreso = Html::encode($_POST["id_comprobante_egreso"]);
                    $table->update();
                    $this->redirect(["comprobante-egreso/view",'id' => $id_comprobante_egreso]);

                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                    $tipomsg = "danger";
                }
            }
        }
        //return $this->render("_formeditardetalle", ["model" => $model,]);
    }
    
    public function actionEditardetalles($id_comprobante_egreso)
    {
        $mds = ComprobanteEgresoDetalle::find()->where(['=', 'id_comprobante_egreso', $id_comprobante_egreso])->all();

        if (isset($_POST["id_comprobante_egreso_detalle"])) {
            $intIndice = 0;
            foreach ($_POST["id_comprobante_egreso_detalle"] as $intCodigo) {
                if($_POST["vlr_abono"][$intIndice] > 0 ){
                    $table = ComprobanteEgresoDetalle::findOne($intCodigo);
                    $total = $table->vlr_abono;
                    $table->vlr_abono = $_POST["vlr_abono"][$intIndice];
                    $table->update();
                }
                $intIndice++;
            }
            $this->redirect(["comprobante-egreso/view",'id' => $id_comprobante_egreso]);
        }
        return $this->render('_formeditardetalles', [
            'mds' => $mds,
            'id_comprobante_egreso' => $id_comprobante_egreso,
        ]);
    }
    
    public function actionEliminardetalle()
    {
        if(Yii::$app->request->post())
        {
            $id_comprobante_egreso_detalle = Html::encode($_POST["id_comprobante_egreso_detalle"]);
            $id_comprobante_egreso = Html::encode($_POST["id_comprobante_egreso"]);
            if((int) $id_comprobante_egreso_detalle)
            {
                $comprobanteDetalle = ComprobanteEgresoDetalle::findOne($id_comprobante_egreso_detalle);
                $total = $comprobanteDetalle->vlr_abono;
                if(ComprobanteEgresoDetalle::deleteAll("id_comprobante_egreso_detalle=:id_comprobante_egreso_detalle", [":id_comprobante_egreso_detalle" => $id_comprobante_egreso_detalle]))
                {                   
                    $this->redirect(["comprobante-egreso/view",'id' => $id_comprobante_egreso]);
                }
                else
                {
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("comprobante-egreso/index")."'>";
                }
            }
            else
            {
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("comprobante-egreso/index")."'>";
            }
        }
        else
        {
            return $this->redirect(["comprobante-egreso/index"]);
        }
    }
    
    public function actionEliminardetalles($id_comprobante_egreso)
    {
        $mds = ComprobanteEgresoDetalle::find()->where(['=', 'id_comprobante_egreso', $id_comprobante_egreso])->all();
        $mensaje = "";
        if(Yii::$app->request->post())
        {
            $intIndice = 0;

            if (isset($_POST["seleccion"])) {
                foreach ($_POST["seleccion"] as $intCodigo)
                {
                    $comprobanteDetalle = ComprobanteEgresoDetalle::findOne($intCodigo);
                    $total = $comprobanteDetalle->vlr_abono;
                    if(ComprobanteEgresoDetalle::deleteAll("id_comprobante_egreso_detalle=:id_comprobante_egreso_detalle", [":id_comprobante_egreso_detalle" => $intCodigo]))
                    {
                        /*$recibo = Recibocaja::findOne($idrecibo);
                        $recibo->valorpagado = $recibo->valorpagado - $total;
                        $recibo->update();*/
                    }
                }
                $this->redirect(["comprobante-egreso/view",'id' => $id_comprobante_egreso]);
            }else {
                $mensaje = "Debe seleccionar al menos un registro";
            }
        }
        return $this->render('_formeliminardetalles', [
            'mds' => $mds,
            'id_comprobante_egreso' => $id_comprobante_egreso,
            'mensaje' => $mensaje,
        ]);
    }
    
    public function actionAutorizado($id)
    {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->autorizado == 0){
            $detalles = ComprobanteEgresoDetalle::find()
                ->where(['=', 'id_comprobante_egreso', $id])
                ->all();
            $reg = count($detalles);
            if ($reg <> 0) {
                $error = 0;
                if($model->libre == 1){
                    $error = 0;
                }else{
                    foreach ($detalles as $dato){
                        /*if ($dato->vlrabono > $dato->vlrsaldo){
                            $error = 1;
                        }*/
                    }
                }               
                if ($error == 0){
                    $model->autorizado = 1;
                    $model->save(false);
                    $this->redirect(["comprobante-egreso/view",'id' => $id]);
                }else{
                    Yii::$app->getSession()->setFlash('error', 'Los abonos no pueden ser mayores a los saldos.');
                    $this->redirect(["comprobante-egreso/view",'id' => $id]);
                }
            }else{
                Yii::$app->getSession()->setFlash('error', 'Para autorizar el registro, debe tener compras relacionados en el comprobante.');
                $this->redirect(["comprobante-egreso/view",'id' => $id]);
            }
        } else {
            if ($model->valor <> 0) {
                Yii::$app->getSession()->setFlash('error', 'No se puede desautorizar el registro, ya fue pagado.');
                $this->redirect(["comprobante-egreso/view",'id' => $id]);
            } else {
                $model->autorizado = 0;
                $model->update();
                $this->redirect(["comprobante-egreso/view",'id' => $id]);
            }
        }
    }
    
    public function actionPagar($id)
    {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->autorizado == 1){
            if ($model->valor == 0){
                $comprobantedetalles = ComprobanteEgresoDetalle::find()
                    ->where(['id_comprobante_egreso' => $id])
                    ->all();
                $total = 0;
                $error = 0;
                if ($model->libre == 0){
                    foreach ($comprobantedetalles as $dato){
                        /*if ($dato->vlrabono > $dato->vlrsaldo){
                            $error = 1;
                        }*/
                    }
                }else{
                    $error = 0;
                }                
                if ($error == 0){
                    if ($model->libre == 0){
                        foreach ($comprobantedetalles as $val) {
                            $comprobantedetalle = ComprobanteEgresoDetalle::findOne($val->id_comprobante_egreso_detalle);
                            $comprobantedetalle->vlr_saldo = ($comprobantedetalle->vlr_saldo) - ($comprobantedetalle->vlr_abono);
                            $total = $total + $val->vlr_abono;
                            $comprobantedetalle->update();
                            $compra = Compra::findOne($val->id_compra);
                            $compra->saldo = $comprobantedetalle->vlr_saldo;
                            if($compra->saldo <= 0){
                                $compra->estado = 2; //estado 0 = abieto, estado 1 = abono, estado 2 = pagada, estado 3 = anulada por otro procesos (saldo 0 en la compra), estado 4 = descuento por otro proceso
                            }elseif ($compra->saldo >= 0){
                                $compra->estado = 1; //estado 0 = abieto, estado 1 = abono, estado 2 = pagada, estado 3 = anulada por otro procesos (saldo 0 en la compra), estado 4 = descuento por otro proceso
                            }
                            $compra->update();
                        }
                        $model->valor = $total;
                        //$model->fechapago = date('Y-m-d');
                        //generar consecutivo numero de la nota credito
                        $consecutivo = Consecutivo::findOne(6);//6 comprobante de egreso
                        $consecutivo->consecutivo = $consecutivo->consecutivo + 1;
                        $model->numero = $consecutivo->consecutivo;
                        $model->save(false);
                        $consecutivo->update();
                        //fin generar consecutivo
                        $this->redirect(["comprobante-egreso/view",'id' => $id]);
                    }else{
                        foreach ($comprobantedetalles as $val) {                            
                            $total = $total + $val->vlr_abono;                            
                        }
                        $model->valor = $total;                        
                        $consecutivo = Consecutivo::findOne(6);//6 comprobante de egreso
                        $consecutivo->consecutivo = $consecutivo->consecutivo + 1;
                        $model->numero = $consecutivo->consecutivo;
                        $model->save(false);
                        $consecutivo->update();
                        //fin generar consecutivo
                        $this->redirect(["comprobante-egreso/view",'id' => $id]);
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Los abonos no pueden ser mayores a los saldos.');
                    $this->redirect(["comprobante-egreso/view",'id' => $id]);
                }
            }else{
                Yii::$app->getSession()->setFlash('error', 'Ya se realizo el pago del comprobante.');
                $this->redirect(["comprobante-egreso/view",'id' => $id]);
            }
        } else {
            Yii::$app->getSession()->setFlash('error', 'Para pagar el comprobante debe estar autorizado');
            $this->redirect(["comprobante-egreso/view",'id' => $id]);
        }
    }

    /**
     * Finds the ComprobanteEgreso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComprobanteEgreso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComprobanteEgreso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionImprimir($id)
    {                                
        return $this->render('../formatos/comprobanteEgreso', [
            'model' => $this->findModel($id),
            
        ]);
    }
}
