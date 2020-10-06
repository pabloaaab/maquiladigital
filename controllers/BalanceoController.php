<?php

namespace app\controllers;
//modelos
use app\models\Ordenproduccion;
use app\models\Balanceo;
use app\models\BalanceoDetalle;
use app\models\BalanceoSearch;
use app\models\UsuarioDetalle;
use app\models\FormFiltroModulos;
use app\models\FlujoOperaciones;
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

/**
 * BalanceoController implements the CRUD actions for Balanceo model.
 */
class BalanceoController extends Controller
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
     * Lists all Balanceo models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->identity){
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',99])->all()){
            $form = new FormFiltroModulos();
            $idcliente = null;
            $fecha_inicio = null;
            $idordenproduccion = null;
            if ($form->load(Yii::$app->request->get())) {
                if ($form->validate()) {
                    $idcliente = Html::encode($form->idcliente);
                    $fecha_inicio = Html::encode($form->fecha_inicio);
                    $idordenproduccion = Html::encode($form->idordenproduccion);
                    $table = Balanceo::find()
                            ->andFilterWhere(['=', 'idcliente', $idcliente])
                            ->andFilterWhere(['>=', 'fecha_inicio', $fecha_inicio])
                            ->andFilterWhere(['=', 'idordenproduccion', $idordenproduccion]);
                    $table = $table->orderBy('id_balanceo desc');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $to = $count->count();
                    $pages = new Pagination([
                        'pageSize' => 50,
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
                $table = Balanceo::find()
                        ->orderBy('id_balanceo desc');
                $tableexcel = $table->all();
                $count = clone $table;
                $pages = new Pagination([
                    'pageSize' => 50,
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
            return $this->render('index', [
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

    /**
     * Displays a single Balanceo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $idordenproduccion)
    {
        $flujo_operaciones = FlujoOperaciones::find()->where(['=', 'idordenproduccion', $idordenproduccion])->orderBy('orden_aleatorio asc')->all();
        if (isset($_POST["guardar"])) {
            if (isset($_POST["idproceso"])) {
                $intIndice = 0;
                foreach ($_POST["idproceso"] as $intCodigo) {
                    if ($_POST["id_operario"][$intIndice] > 0) {
                        $table = new BalanceoDetalle();
                        $table->id_proceso = $intCodigo;
                        $table->id_balanceo = $_POST["id_balanceo"][$intIndice];
                        $table->id_tipo = $_POST["id_tipo"][$intIndice];
                        $table->id_operario = $_POST["id_operario"][$intIndice];
                        $table->segundos = $_POST["segundos"][$intIndice];
                        $table->minutos = $_POST["minutos"][$intIndice];
                        $table->total_minutos = $_POST["minutos"][$intIndice];
                        $table->total_segundos = $_POST["segundos"][$intIndice];
                        $table->usuariosistema = Yii::$app->user->identity->username;
                        $table->insert();
                    }
                    $intIndice++;
                }
                $this->ActualizarSegundos($id);
                return $this->redirect(["balanceo/view", 'id'=> $id, 'idordenproduccion' => $idordenproduccion]); 
            }
       }    
        
       return $this->render('view', [
            'model' => $this->findModel($id),
            'flujo_operaciones' => $flujo_operaciones,
        ]);
    }
 // codigo que actualiza los minutos y segundos de los operarios
    
 protected function ActualizarSegundos($id)
    { 
     //$balanceo = BalanceoDetalle::find()->where(['']);
     $total_s = 0;
     $balanceo = BalanceoDetalle::find()
                            ->select([new Expression('SUM(segundos) as total_segundos'), 'id_operario'])                            
                            ->groupBy('id_operario')
                            ->all();
    foreach ($balanceo as $dato) :
        $total_s = $dato->total_segundos;
        $balanceo2 = BalanceoDetalle::find()->where(['=','id_operario', $dato->id_operario])->all();
        foreach ($balanceo2 as $act):
            $act->total_segundos = $total_s;
            $act->save();
        endforeach;
    endforeach;
    $total_m = 0;
     $balanceo = BalanceoDetalle::find()
                            ->select([new Expression('SUM(minutos) as total_minutos'), 'id_operario'])                            
                            ->groupBy('id_operario')
                            ->all();
    foreach ($balanceo as $dato) :
        $total_m = $dato->total_minutos;
        $balanceo2 = BalanceoDetalle::find()->where(['=','id_operario', $dato->id_operario])->all();
        foreach ($balanceo2 as $act):
            $act->total_minutos = $total_m;
            $act->save();
        endforeach;
    endforeach;

    }
    
    /**
     * Creates a new Balanceo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idordenproduccion)
    {
        $model = new Balanceo();
        $orden = Ordenproduccion::findOne($idordenproduccion);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {           
            if ($model->validate()) {
                $balanceo = Balanceo::find()->where(['=','idordenproduccion', $idordenproduccion])->andWhere(['=','modulo', $model->modulo])->one();
                if($balanceo){
                    Yii::$app->getSession()->setFlash('error', 'Error en el modulo, ya existe este numero de modulo para esta OP');
                }else{
                    $orden = Ordenproduccion::findOne($idordenproduccion);
                    $table = new Balanceo();
                    $table->idordenproduccion = $idordenproduccion;
                    $table->idcliente = $orden->idcliente;
                    $table->cantidad_empleados = $model->cantidad_empleados;
                    $table->fecha_inicio = $model->fecha_inicio;
                    $table->cantidad_empleados = $model->cantidad_empleados;
                    $table->modulo = $model->modulo;
                    $table->observacion = $model->observacion;
                    $table->usuariosistema = Yii::$app->user->identity->username;
                    $table->save(false);
                     return $this->redirect(["balanceo/index"]); 
                }     
            }else{
                $model->getErrors();
            }
        }    

        return $this->render('create', [
            'model' => $model,
            'orden' => $orden,
        ]);
    }
    
    /**
     * Updates an existing Balanceo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_balanceo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Balanceo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   public function actionEliminar($id) {
        if (Yii::$app->request->post()) {
            $balanceo = Balanceo::findOne($id);
            if ((int) $id) {
                try {
                    Balanceo::deleteAll("id_balanceo=:id_balanceo", [":id_balanceo" => $id]);
                    Yii::$app->getSession()->setFlash('success', 'Registro Eliminado con exito.');
                    $this->redirect(["balanceo/index"]);
                } catch (IntegrityException $e) {
                    $this->redirect(["balanceo/index"]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el modulo Nro: ' . $balanceo->id_balanceo . ', tiene registros asociados en otros procesos');
                } catch (\Exception $e) {

                    $this->redirect(["balanceo/index"]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el modulo Nro:  ' . $balanceo->id_balanceo . ', tiene registros asociados en otros procesos');
                }
            } else {
                // echo "Ha ocurrido un error al eliminar el registros, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("balanceo/index") . "'>";
            }
        } else {
            return $this->redirect(["balanceo/index"]);
        }
    }

    /**
     * Finds the Balanceo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Balanceo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Balanceo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
                              
        $objPHPExcel->setActiveSheetIndex(0)
                     ->setCellValue('A1', 'ID')
                    ->setCellValue('B1', 'NRO MODULO')
                    ->setCellValue('C1', 'ORDEN PRODUCCION')
                    ->setCellValue('D1', 'OPERARIOS')
                    ->setCellValue('E1', 'FECHA INICIO')
                    ->setCellValue('F1', 'FECHA TERMINACION')
                    ->setCellValue('G1', 'CLIENTE')                    
                    ->setCellValue('H1', 'ESTADO MODULO')
                    ->setCellValue('I1', 'OBSERVACION')
                    ->setCellValue('J1', 'FECHA CREACION')
                    ->setCellValue('K1', 'USUARIO');
                   
        $i = 2  ;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->id_balanceo)
                    ->setCellValue('B' . $i, $val->modulo)
                    ->setCellValue('C' . $i, $val->idordenproduccion)
                    ->setCellValue('D' . $i, $val->cantidad_empleados)
                    ->setCellValue('E' . $i, $val->fecha_inicio)
                    ->setCellValue('F' . $i, $val->fecha_terminacion)
                    ->setCellValue('G' . $i, $val->cliente->nombrecorto)                    
                    ->setCellValue('H' . $i, $val->estadomodulo)
                    ->setCellValue('I' . $i, $val->observacion)
                    ->setCellValue('J' . $i, $val->fecha_creacion)
                    ->setCellValue('K' . $i, $val->usuariosistema);
                   
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Modulos');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Modulos.xlsx"');
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
