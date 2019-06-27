<?php

namespace app\controllers;

use Yii;
use app\models\Facturaventatipo;
use app\models\FacturaventatipoSearch;
use app\models\Facturaventatipocuenta;
use app\models\CuentaPub;
use app\models\FormFacturaventatipocuentanuevo;
use app\models\FormFacturaVentaTipoDetalleEditar;
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
use app\models\UsuarioDetalle;

/**
 * FacturaventatipoController implements the CRUD actions for Facturaventatipo model.
 */
class FacturaventatipoController extends Controller
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
     * Lists all Facturaventatipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',48])->all()){
                $searchModel = new FacturaventatipoSearch();
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

    /**
     * Displays a single Facturaventatipo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modeldetalles = Facturaventatipocuenta::find()->Where(['=', 'id_factura_venta_tipo', $id])->all();
        $registros = count($modeldetalles);
        if (Yii::$app->request->post()) {
            if (isset($_POST["eliminar"])) {
                if (isset($_POST["id_factura_venta_tipo_cuenta"])) {
                    foreach ($_POST["id_factura_venta_tipo_cuenta"] as $intCodigo) {
                        try {
                            $eliminar = Facturaventatipocuenta::findOne($intCodigo);
                            $eliminar->delete();
                            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
                            $this->redirect(["facturaventatipo/view", 'id' => $id]);
                        } catch (IntegrityException $e) {
                            //$this->redirect(["producto/view", 'id' => $id]);
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');
                        } catch (\Exception $e) {
                            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el detalle, tiene registros asociados en otros procesos');
                            //$this->redirect(["producto/view", 'id' => $id]);
                        }
                    }
                    //$this->redirect(["producto/view", 'id' => $id]);
                }
            } else {
                    Yii::$app->getSession()->setFlash('error', 'Debe seleccionar al menos un registro.');
                    $this->redirect(["facturaventatipo/view", 'id' => $id]);
                   }
        }        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modeldetalles' => $modeldetalles,
            'registros' => $registros,
        ]);
    }

    /**
     * Creates a new Facturaventatipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Facturaventatipo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_factura_venta_tipo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Facturaventatipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_factura_venta_tipo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Facturaventatipo model.
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
    
    public function actionNuevodetalles($id_factura_venta_tipo)
    {
        $model = new FormFacturaventatipocuentanuevo();
        $cuentas = CuentaPub::find()->all();         
        if ($model->load(Yii::$app->request->post())) {
            $cuenta = CuentaPub::find()->where(['=','codigo_cuenta',$model->cuenta])->one();
            if ($cuenta){
                $table = new Facturaventatipocuenta;
                $table->id_factura_venta_tipo = $id_factura_venta_tipo;
                $table->cuenta = $model->cuenta;
                $table->tipocuenta = $model->tipocuenta;
                $table->base = $model->base;
                $table->subtotal = $model->subtotal;
                $table->iva = $model->iva;
                $table->rete_fuente = $model->rete_fuente;
                $table->rete_iva = $model->rete_iva;
                $table->total = $model->total;
                $table->base_rete_fuente = $model->base_rete_fuente;
                $table->save(false);
                $this->redirect(["facturaventatipo/view", 'id' => $id_factura_venta_tipo]);
            }else{                
                Yii::$app->getSession()->setFlash('error', 'No exite la cuenta que desea ingresar, verificar en las cuentas del PUB!');
            }
            
        }

        return $this->render('_formnuevodetalles', [
            'model' => $model,
            'cuentas' => ArrayHelper::map($cuentas, "codigo_cuenta", "codigo_cuenta"),
            'id' => $id_factura_venta_tipo
        ]);
    }
    
    public function actionEditardetalle($id_factura_venta_tipo_cuenta) {
        $model = new FormFacturaVentaTipoDetalleEditar;
        $cuentas = CuentaPub::find()->all();        
        $facturaventatipocuenta = Facturaventatipocuenta::findOne($id_factura_venta_tipo_cuenta);
        
        if ($model->load(Yii::$app->request->post())) {                        
            $facturaventatipocuenta->cuenta = $model->cuenta;
            $facturaventatipocuenta->tipocuenta = $model->tipocuenta;
            $facturaventatipocuenta->base = $model->base;
            $facturaventatipocuenta->subtotal = $model->subtotal;
            $facturaventatipocuenta->iva = $model->iva;
            $facturaventatipocuenta->rete_fuente = $model->rete_fuente;
            $facturaventatipocuenta->rete_iva = $model->rete_iva;
            $facturaventatipocuenta->total = $model->total;
            $facturaventatipocuenta->base_rete_fuente = $model->base_rete_fuente;
            $facturaventatipocuenta->save(false);                                      
            return $this->redirect(['facturaventatipo/view','id' => $facturaventatipocuenta->id_factura_venta_tipo]);
        }
        if (Yii::$app->request->get("id_factura_venta_tipo_cuenta")) {
            $table = Facturaventatipocuenta::find()->where(['id_factura_venta_tipo_cuenta' => $id_factura_venta_tipo_cuenta])->one();
            if ($table) {
                $model->cuenta = $table->cuenta;
                $model->tipocuenta = $table->tipocuenta;
                $model->base = $table->base;
                $model->subtotal = $table->subtotal;
                $model->iva = $table->iva;
                $model->rete_fuente = $table->rete_fuente;
                $model->rete_iva = $table->rete_iva;
                $model->total = $table->total;
                $model->base_rete_fuente = $table->base_rete_fuente;
            }    
        }
        return $this->render('_formeditardetalle', [
            'model' => $model,
            'facturaventatipocuenta' => $facturaventatipocuenta,
            'cuentas' => ArrayHelper::map($cuentas, "codigo_cuenta", "codigo_cuenta"),
        ]);        
    }

    /**
     * Finds the Facturaventatipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Facturaventatipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Facturaventatipo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
