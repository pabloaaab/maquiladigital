<?php

namespace app\controllers;

use Yii;
use app\models\Remision;
use app\models\Remisiondetalle;
use app\models\Ordenproduccion;
use app\models\Ordenproducciondetalle;
use app\models\Consecutivo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UsuarioDetalle;

/**
 * FichatiempoController implements the CRUD actions for Fichatiempo model.
 */
class RemisionController extends Controller
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
     * Lists all Fichatiempo models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',32])->all()){
            $searchModel = new FichatiempoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['site/sinpermiso']);
        }*/
    }

    /**
     * Displays a single Fichatiempo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRemision($id)
    {
        if (Yii::$app->request->post()) {
            $remision = Remision::find()->where(['=', 'idordenproduccion', $id])->one();
            $count = 0;
            if ($remision){
                $model = $remision;
                $remisiondetalle = Remisiondetalle::find()->where(['=','id_remision',$remision->id_remision])->all();
                $count = count($remisiondetalle);
                $detalleorden = Ordenproducciondetalle::find()->where(['=','idordenproduccion',$id])->all();
                $cxs = 0; $cs = 0; $cm = 0; $cl = 0; $cxl = 0; 
                foreach ($detalleorden as $val){
                    if($val->productodetalle->prendatipo->talla->talla == 'XS' or $val->productodetalle->prendatipo->talla->talla == 'xs'){
                        $cxs = $val->cantidad;
                    }
                    if($val->productodetalle->prendatipo->talla->talla == 'S' or $val->productodetalle->prendatipo->talla->talla == 's'){
                        $cs = $val->cantidad;
                    }
                    if($val->productodetalle->prendatipo->talla->talla == 'M' or $val->productodetalle->prendatipo->talla->talla == 'm'){
                        $cm = $val->cantidad;
                    }
                    if($val->productodetalle->prendatipo->talla->talla == 'L' or $val->productodetalle->prendatipo->talla->talla == 'l'){
                        $cl = $val->cantidad;
                    }
                    if($val->productodetalle->prendatipo->talla->talla == 'XL' or $val->productodetalle->prendatipo->talla->talla == 'xl'){
                        $cxl = $val->cantidad;
                    }
                }
            }else{
                $table = new Remision();
                $table->idordenproduccion = $id;
                $table->total_tulas = 0;
                $table->total_exportacion = 0;
                $table->totalsegundas = 0;
                $table->total_colombia = 0;
                $table->total_confeccion = 0;
                $table->total_despachadas = 0;
                $table->fechacreacion = date('Y-m-d');
                $table->color = $_POST['color'];
                $table->insert();
                $model = Remision::findOne($table->id_remision);
                $remisiondetalle = Remisiondetalle::find()->where(['=','id_remision',$id])->all();
                $count = count($remisiondetalle);
            }
            if (isset($_POST["id_remision_detalle"])) {
                $intIndice = 0;
                foreach ($_POST["id_remision_detalle"] as $intCodigo) {                
                    $table = Remisiondetalle::findOne($intCodigo);
                    $table->color = $_POST["color"][$intIndice];
                    $table->oc = $_POST["oc"][$intIndice];
                    $table->xs = $_POST["xs"][$intIndice];
                    $table->s = $_POST["s"][$intIndice];
                    $table->m = $_POST["m"][$intIndice];
                    $table->l = $_POST["l"][$intIndice];
                    $table->xl = $_POST["xl"][$intIndice];
                    $table->estado = $_POST["estado"][$intIndice];                
                    $table->save(false);
                    $this->Calculos($table);

                    $intIndice++;
                }
                $this->totales($id);
                return $this->redirect(['remision', 'id' => $id]);
            }
            
        }else{
            $remision = Remision::find()->where(['=', 'idordenproduccion', $id])->one();
            $count = 0;
            if ($remision){
                $model = $remision;
                $remisiondetalle = Remisiondetalle::find()->where(['=','id_remision',$remision->id_remision])->all();
                $count = count($remisiondetalle);
            }
            $detalleorden = Ordenproducciondetalle::find()->where(['=','idordenproduccion',$id])->all();
            $cxs = 0; $cs = 0; $cm = 0; $cl = 0; $cxl = 0; 
            foreach ($detalleorden as $val){
                if($val->productodetalle->prendatipo->talla->talla == 'XS' or $val->productodetalle->prendatipo->talla->talla == 'xs'){
                    $cxs = $val->cantidad;
                }
                if($val->productodetalle->prendatipo->talla->talla == 'S' or $val->productodetalle->prendatipo->talla->talla == 's'){
                    $cs = $val->cantidad;
                }
                if($val->productodetalle->prendatipo->talla->talla == 'M' or $val->productodetalle->prendatipo->talla->talla == 'm'){
                    $cm = $val->cantidad;
                }
                if($val->productodetalle->prendatipo->talla->talla == 'L' or $val->productodetalle->prendatipo->talla->talla == 'l'){
                    $cl = $val->cantidad;
                }
                if($val->productodetalle->prendatipo->talla->talla == 'XL' or $val->productodetalle->prendatipo->talla->talla == 'xl'){
                    $cxl = $val->cantidad;
                }
            }
        }    
        
        return $this->render('remision', [
            'model' => $model,
            'remisiondetalle' => $remisiondetalle,
            'idordenproduccion' => $id,
            'count' => $count,
            'cxs' => $cxs,
            'cs' => $cs,
            'cm' => $cm,
            'cl' => $cl,
            'cxl' => $cxl,
        ]);
    }

        
    public function actionNuevodetalle($id,$idordenproduccion)
    {        
        $remision = Remision::findOne($id);
        $model = new Remisiondetalle();
        $model->id_remision = $id;
        $model->tula = 1;
        $model->color = $remision->color;
        $model->insert();
        return $this->redirect(['remision', 'id' => $idordenproduccion]);
    }
    
    public function actionEliminar($id,$iddetalle)
    {                                
        $detalle = Remisiondetalle::findOne($iddetalle);
        $detalle->delete();        
        $this->totales($id);
        $this->redirect(["remision",'id' => $id]);
        /*try {
            $detalle->delete();
            $this->totales($id);
            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
            $this->redirect(["remision",'id' => $id]);
        } catch (IntegrityException $e) {
            $this->redirect(["remision",'id' => $id]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
            $this->redirect(["remision",'id' => $id]);
        }*/
    }
    
    protected function Calculos($table)
    {                
        $table->unidades = $table->xs + $table->s + $table->m + $table->l + $table->xl;                
        $table->update();
    }
    
    protected function Totales($id)
    {        
        $remision = Remision::find()->where(['=','idordenproduccion',$id])->one();
        $detalles = Remisiondetalle::find()->where(['=','id_remision',$remision->id_remision])->all();
        $totaltulas = 0;
        $totalexportacion = 0;
        $totalsegundas = 0;
        $totalcolombia = 0;
        $totalconfeccion = 0;
        $totaldespachadas = 0;
        foreach ($detalles as $val){
            $totaltulas = $totaltulas + $val->tula;
            if ($val->oc == 0){ //colombia
                $totalcolombia = $totalcolombia + $val->unidades;
            }
            if ($val->oc == 1){ //exportacion
                $totalexportacion = $totalexportacion + $val->unidades;
            }
            if ($val->estado == 1){ //segundas
                $totalsegundas = $totalsegundas + $val->unidades;
            }
            $totalconfeccion = $totalconfeccion + $val->unidades;
        }                
        $remision->total_tulas = $totaltulas;
        $remision->total_colombia = $totalcolombia;
        $remision->total_exportacion = $totalexportacion;
        $remision->totalsegundas = $totalsegundas;
        $remision->total_confeccion = $totalconfeccion;
        $remision->total_despachadas = $totalconfeccion;
        $remision->update();
    }
    
    public function actionGenerarnro($id)
    {
        $model = Remision::findOne($id);
        $mensaje = "";
        
        $detalle = Remisiondetalle::find()->where(['=','id_remision',$id])->all();
        $count = count($detalle);
        if ($count > 0) {                    
            if ($model->numero == 0){
                $consecutivo = Consecutivo::findOne(4);// 4 Remision de entrega
                $consecutivo->consecutivo = $consecutivo->consecutivo + 1;
                $model->numero = $consecutivo->consecutivo;
                $model->save(false);
                $consecutivo->update();                                
                //$this->afectarcantidadfacturada($id);//se resta o descuenta las cantidades facturadas en los productos por cliente
                $this->redirect(["remision/remision",'id' => $model->idordenproduccion]);
            }else{
                Yii::$app->getSession()->setFlash('error', 'El registro ya fue generado.');
                $this->redirect(["remision/remision",'id' => $model->idordenproduccion]);
            }
        }else{
            Yii::$app->getSession()->setFlash('error', 'El registro no tiene detalles, no se puede generar numero');
            $this->redirect(["remision/remision",'id' => $model->idordenproduccion]);
        }    
        
    }
    
    public function actionFechamodificar($id){
        
        $remision = Remision::find()->where(['=', 'idordenproduccion', $id])->one();
        $remision->fechacreacion = $_POST['fecha'];
        $remision->save(false);
        $this->redirect(["remision/remision",'id' => $id]);
      
    }

        public function actionImprimir($id) {

        return $this->render('../formatos/remision', [
            'model' => Remision::findOne($id),
        ]);
    }
}
