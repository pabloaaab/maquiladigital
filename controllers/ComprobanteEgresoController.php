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
        $modeldetalles = ComprobanteEgresoDetalle::find()->Where(['=', 'id_comprobante_egreso_detalle', $id])->all();
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
        $model = new FormRecibocajalibre;
        $clientes = Cliente::find()->all();
        $municipios = Municipio::find()->all();
        $bancos = Banco::find()->all();
        $tipoRecibos = TipoRecibo::find()->all();
        if ($model->load(Yii::$app->request->post())) {
            $table = new Recibocaja;
            $table->idcliente = $model->idcliente;
            $table->idbanco = $model->idbanco;            
            $table->observacion = $model->observacion;
            $table->fechapago = $model->fechapago;
            $table->idtiporecibo = $model->idtiporecibo;
            $table->idmunicipio = $model->idmunicipio;
            $table->valorletras = "-";
            $table->usuariosistema = Yii::$app->user->identity->username;
            $table->libre = 1;
            $table->insert();
            return $this->redirect(['index']);
        }

        return $this->render('_formlibre', [
            'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreclientes"),
            'tiporecibos' => ArrayHelper::map($tipoRecibos, "idtiporecibo", "concepto"),
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_comprobante_egreso]);
        }

        return $this->render('update', [
            'model' => $model,
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}
