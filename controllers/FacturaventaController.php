<?php

namespace app\controllers;

use app\models\Ordenproducciondetalle;
use app\models\Resolucion;
use Yii;
use app\models\Facturaventa;
use app\models\FacturaventaSearch;
use app\models\Facturaventadetalle;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Cliente;
use app\models\Ordenproduccion;
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
 * FacturaventaController implements the CRUD actions for Facturaventa model.
 */
class FacturaventaController extends Controller
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
     * Lists all Facturaventa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FacturaventaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Facturaventa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modeldetalles = Facturaventadetalle::find()->Where(['=', 'idfactura', $id])->all();
        $modeldetalle = new Facturaventadetalle();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modeldetalle' => $modeldetalle,
            'modeldetalles' => $modeldetalles,

        ]);
    }

    /**
     * Creates a new Facturaventa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Facturaventa();
        $clientes = Cliente::find()->all();
        $ordenesproduccion = Ordenproduccion::find()->all();
        $resolucion = Resolucion::find()->where(['=', 'activo', 1])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $table = Cliente::find()->where(['=', 'idcliente', $model->idcliente])->one();
            $fecha = date( $model->fechainicio);
            $nuevafecha = strtotime ( '+'.$table->plazopago.' day' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );

            echo $nuevafecha;
            $model->nrofactura = 0;
            $model->fechavcto = $nuevafecha;
            $model->formapago = $table->formapago;
            $model->plazopago = $table->plazopago;
            $model->porcentajefuente = 0;
            $model->porcentajeiva = 0;
            $model->porcentajereteiva = 0;
            $model->subtotal = 0;
            $model->retencionfuente = 0;
            $model->retencioniva = 0;
            $model->impuestoiva = 0;
            $model->saldo = 0;
            $model->totalpagar = 0;
            $model->valorletras = "-" ;
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->idresolucion = $resolucion->idresolucion;
            $model->update();
            return $this->redirect(['view', 'id' => $model->idfactura]);
        }

        return $this->render('create', [
            'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreclientes"),
            'ordenesproduccion' => ArrayHelper::map($ordenesproduccion, "idordenproduccion", "idordenproduccion"),
        ]);
    }

    /**
     * Updates an existing Facturaventa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $clientes = Cliente::find()->all();
        $table = Facturaventa::find()->where(['idfactura' => $id])->one();
        $ordenesproduccion = Ordenproduccion::find()->Where(['=', 'idordenproduccion', $table->idordenproduccion])->all();
        $ordenesproduccion = ArrayHelper::map($ordenesproduccion, "idordenproduccion", "ordenProduccion");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idfactura]);
        }

        return $this->render('update', [
            'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombrecorto"),
            'ordenesproduccion' => $ordenesproduccion,

        ]);
    }

    /**
     * Deletes an existing Facturaventa model.
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
     * Finds the Facturaventa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Facturaventa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionNuevodetalles($idordenproduccion,$idfactura)
    {

        $facturaOrden = Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $idordenproduccion])->all();

        if (isset($_POST["iddetalleorden"])) {
            foreach ($_POST["iddetalleorden"] as $intCodigo) {
                    $table = new Facturaventadetalle();
                    $ordenProduccion = Ordenproducciondetalle::find($intCodigo)->one();
                    $table->idproducto = $ordenProduccion->idproducto;
                    $table->cantidad = $ordenProduccion->cantidad;
                    $table->preciounitario = $ordenProduccion->vlrprecio;
                    $table->codigoproducto = $ordenProduccion->codigoproducto;
                    $table->total = $ordenProduccion->subtotal;
                    $table->idfactura = $idfactura;
                    $table->insert();
                    $factura = Facturaventa::findOne($idfactura);
                    $factura->totalpagar = $factura->totalpagar + $table->total;
                    $factura->update();
            }
            $this->redirect(["facturaventa/view",'id' => $idfactura]);
        }
        return $this->render('_formnuevodetalles', [
            'facturaOrden' => $facturaOrden,
            'idfactura' => $idfactura,

        ]);
    }

    public function actionOrdenp($id){
        $rows = Ordenproduccion::find()->where(['idcliente' => $id])->all();

        echo "<option required>Seleccione...</option>";
        if(count($rows)>0){
            foreach($rows as $row){
                echo "<option value='$row->idordenproduccion' required>$row->ordenProduccion</option>";
            }
        }
    }

    protected function findModel($id)
    {
        if (($model = Facturaventa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
