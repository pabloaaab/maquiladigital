<?php

namespace app\controllers;

use Yii;
use app\models\Compra;
use app\models\CompraTipo;
use app\models\CompraConcepto;
use app\models\Proveedor;
use app\models\CompraSearch;
use app\models\UsuarioDetalle;
use app\models\Consecutivo;
use app\models\Matriculaempresa;
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

/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller
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
     * Lists all Compra models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',35])->all()){
            $searchModel = new CompraSearch();
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
     * Displays a single Compra model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Compra();
        $proveedores = Proveedor::find()->all();
        $conceptos = CompraConcepto::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->usuariosistema = Yii::$app->user->identity->username;            
            $model->update();
            $this->calculo($model->id_compra);
            return $this->redirect(['view', 'id' => $model->id_compra]);
        }

        return $this->render('create', [
            'model' => $model,
            'proveedores' => ArrayHelper::map($proveedores, "idproveedor", "nombreProveedores"),
            'conceptos' => ArrayHelper::map($conceptos, "id_compra_concepto", "concepto"),
        ]);
    }

    /**
     * Updates an existing Compra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $proveedores = Proveedor::find()->all();
        $conceptos = CompraConcepto::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->calculo($id);
            return $this->redirect(['view', 'id' => $model->id_compra]);
        }

        return $this->render('update', [
            'model' => $model,
            'proveedores' => ArrayHelper::map($proveedores, "idproveedor", "nombreProveedores"),
            'conceptos' => ArrayHelper::map($conceptos, "id_compra_concepto", "concepto"),
        ]);
    }

    /**
     * Deletes an existing Compra model.
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
            $this->redirect(["compra/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["compra/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar la compra, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar la compra, tiene registros asociados en otros procesos');
            $this->redirect(["compra/index"]);
        }
    }

    /**
     * Finds the Compra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionAutorizado($id) {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->autorizado == 0) {                        
            $model->autorizado = 1;            
            $model->update();
            $this->redirect(["compra/view", 'id' => $id]);            
        } else {
            if($model->numero == 0){
                $model->autorizado = 0;
                $model->update();
                $this->redirect(["compra/view", 'id' => $id]);
            }else{
                Yii::$app->getSession()->setFlash('error', 'El registro ya fue generado, no se puede desautorizar.');
                $this->redirect(["compra/view",'id' => $id]);
            }
            
        }
    }
    
    protected function calculo($id)
    {
        $model = $this->findModel($id);
        $proveedor = Proveedor::findOne($model->id_proveedor);
        $concepto = CompraConcepto::findOne($model->id_compra_concepto);
        $configuracion = Matriculaempresa::findOne(1);
        $porcentajeiva = 0;
        $porcentajereteiva = 0;
        $porcentajeretefuente = 0;
        $porcentajebaseaiu = 0;
        $baseaiu = 0;
        if ($proveedor->tiporegimen == 1){ //comun
            if ($concepto->base_aiu <> 0){ //calculo para la base aiu y el iva
                $baseaiu = round($model->subtotal * $concepto->base_aiu / 100);
                $porcentajebaseaiu = $concepto->base_aiu;
                $impuestoiva = round($baseaiu * $concepto->porcentaje_iva / 100); //calculo iva
                $porcentajeiva = $concepto->porcentaje_iva;
                if ($baseaiu >= $concepto->base_retencion){
                    $retencionfuente = round($baseaiu * $concepto->porcentaje_retefuente / 100);
                    $porcentajeretefuente = $concepto->porcentaje_retefuente;                    
                }else{
                    $retencionfuente = 0;
                    $porcentajeretefuente = 0;
                }                
            }
            else{
                $impuestoiva = round($model->subtotal * $concepto->porcentaje_iva / 100); //calculo iva
                $porcentajeiva = $concepto->porcentaje_iva; 
                $baseaiu = 0;
                if ($concepto->base_retencion == 100){ //calculo retefuente cuando es el 100%
                    $retencionfuente = round($model->subtotal * $concepto->porcentaje_retefuente / 100);
                    if($retencionfuente == 0){
                        $porcentajeretefuente = 0;
                    }else{
                        $porcentajeretefuente = $concepto->porcentaje_retefuente;                    
                    }
                }else{
                    if ($model->subtotal >= $concepto->base_retencion){ //calculo retefuente cuando cumple con la base de retension
                        $retencionfuente = round($model->subtotal * $concepto->porcentaje_retefuente / 100);
                        if($retencionfuente == 0){
                            $porcentajeretefuente = 0;
                        }else{
                            $porcentajeretefuente = $concepto->porcentaje_retefuente;                    
                        }
                    }else{
                        $retencionfuente = 0;
                    }
                }
            }
            
            
        }
        if ($proveedor->tiporegimen == 2){ //simplificado
            $impuestoiva = 0;            
            if ($concepto->base_retencion == 100){
                $retencionfuente = round($model->subtotal * $concepto->porcentaje_retefuente / 100);
                if($retencionfuente == 0){
                    $porcentajeretefuente = 0;
                }else{
                    $porcentajeretefuente = $concepto->porcentaje_retefuente;                    
                }
            }else{
                if ($model->subtotal >= $concepto->base_retencion){
                    $retencionfuente = round($model->subtotal * $concepto->porcentaje_retefuente / 100);
                    if($retencionfuente == 0){
                        $porcentajeretefuente = 0;
                    }else{
                        $porcentajeretefuente = $concepto->porcentaje_retefuente;                    
                    }
                }else{
                    $retencionfuente = 0;
                }
            }
        }
        if ($configuracion->gran_contribuyente == 1 && $configuracion->agente_retenedor == 1) { //calculo para el reteiva
            $retencioniva = round($impuestoiva * $concepto->porcentaje_reteiva / 100);
            $porcentajereteiva = $concepto->porcentaje_reteiva;
        }else{
            if ($configuracion->gran_contribuyente == 0 && $configuracion->agente_retenedor == 1) {
                $retencioniva = round($impuestoiva * $concepto->porcentaje_reteiva / 100);
                $porcentajereteiva = $concepto->porcentaje_reteiva;
            }else{
                $retencioniva = 0;                
            }    
        }        
        $model->porcentajeiva = $porcentajeiva;
        $model->porcentajefuente = $porcentajeretefuente;
        $model->porcentajereteiva = $porcentajereteiva;
        $model->porcentajeaiu = $porcentajebaseaiu;
        $model->base_aiu = $baseaiu;
        $model->impuestoiva = $impuestoiva;
        $model->retencionfuente = $retencionfuente;
        $model->retencioniva = $retencioniva;
        $model->total = $model->subtotal + $impuestoiva - $retencionfuente - $retencioniva;
        $model->saldo = $model->total;
        $model->save(false);
        return ;
    }
    
    public function actionGenerarnro($id)
    {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->autorizado == 1){            
            if ($model->numero == 0){
                $consecutivo = Consecutivo::findOne(5);// 5 compras
                $consecutivo->consecutivo = $consecutivo->consecutivo + 1;
                $model->numero = $consecutivo->consecutivo;
                $model->update();
                $consecutivo->update();                
                $this->redirect(["compra/view",'id' => $id]);
            }else{
                Yii::$app->getSession()->setFlash('error', 'El registro ya fue generado.');
                $this->redirect(["compra/view",'id' => $id]);
            }
        }else{
            Yii::$app->getSession()->setFlash('error', 'El registro debe estar autorizado para poder imprimir la compra.');
            $this->redirect(["compra/view",'id' => $id]);
        }
    }
    
    /*public function actionImprimir($id)
    {
                                
        return $this->render('../formatos/compra', [
            'model' => $this->findModel($id),
            
        ]);
    }*/
}
