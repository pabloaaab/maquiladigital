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
        $balanceo_detalle = BalanceoDetalle::find()->where(['=', 'id_balanceo', $id])->orderBy('id_operario asc')->all();
        if (isset($_POST["guardar"])) {
            if (isset($_POST["idproceso"])) {
                $intIndice = 0;
                foreach ($_POST["idproceso"] as $intCodigo) {
                    if ($_POST["id_operario"][$intIndice] > 0) {
                        $table = new BalanceoDetalle();
                        $table->id_proceso = $intCodigo;
                        echo $table->id_balanceo = $id;
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
                return $this->redirect(["balanceo/view",
                      'id'=> $id,
                      'idordenproduccion' => $idordenproduccion,
                      'balanceo_detalle' => $balanceo_detalle,
                    ]); 
            }
       }else{    
                
        return $this->render('view', [
             'model' => $this->findModel($id),
             'flujo_operaciones' => $flujo_operaciones,
            'balanceo_detalle' => $balanceo_detalle,
         ]);
       } 
    }
 // codigo que actualiza los minutos y segundos de los operarios
    
 protected function ActualizarSegundos($id)
    { 
     $vector_balanceo = Balanceo::findOne($id);
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
            $act->sobrante_faltante = ''.number_format($vector_balanceo->tiempo_operario - $total_m, 2);
            $act->save();
        endforeach;
    endforeach;

    }

    public function actionCreate($idordenproduccion)
    {
        $model = new Balanceo();
        $orden = Ordenproduccion::findOne($idordenproduccion);
        $total_minutos = 0;
        $total_minutos = ''.number_format($orden->segundosficha/60 ,2);
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
                    $table->total_minutos = $total_minutos;
                    $table->total_segundos = $orden->segundosficha;
                    $table->tiempo_operario = ''.number_format($table->total_minutos /$table->cantidad_empleados,2); 
                    $table->observacion = $model->observacion;
                    $table->porcentaje = 100;
                    $table->usuariosistema = Yii::$app->user->identity->username;
                    $table->save(false);
                    $this->actionActualizarfechaterminacion($idordenproduccion);
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
    //suproceso para validar la fecha de terminacion
    protected function actionActualizarfechaterminacion($idordenproduccion)
    {
        $minutos = 0; $cantidad = 0; $totales = 0; $total_dias = 0;
        $unidades = 0;
        $horario = \app\models\Horario::findOne(1);
        $orden = Ordenproduccion::findOne($idordenproduccion);
        $balaceo = Balanceo::find()->where(['=','idordenproduccion', $idordenproduccion])->all();
        $minutos = $orden->segundosficha / 60;
        $unidades = (60/$minutos);
        foreach ($balaceo as $val):
            $cantidad += $val->cantidad_empleados;
        endforeach;
        $totales = round(($unidades * $cantidad) * $horario->total_horas);
        $total_dias = round($orden->cantidad / $totales);
        $fecha = date($val->fecha_inicio);
        $date_dato = strtotime('+'.($total_dias).' day', strtotime($fecha)-1);
        $date_dato = date('Y-m-d', $date_dato);
        $val->fecha_terminacion = $date_dato;
        $val->save(false);
        $orden->fechaentrega = $date_dato;
        $orden->save(false);
    }
    
   public function actionUpdate($id, $idordenproduccion)
    {
       $model = new Balanceo();
        $orden = Ordenproduccion::findOne($idordenproduccion);
       if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
      
        if ($model->load(Yii::$app->request->post())) {            
                $balanceo_detalle = BalanceoDetalle::find()->where(['=','id_balanceo', $id])->one();
                if($balanceo_detalle){
                    Yii::$app->getSession()->setFlash('error', 'Error al modificar: este modulo no se puede modificar la informacion porque presenta proceso de operaciones de prendas, favor consulte con el administrador.!'); 
                }else{
                     $table = balanceo::find()->where(['id_balanceo'=>$id])->one();
                    if ($table){
                        $table->fecha_inicio = $model->fecha_inicio;
                        $table->cantidad_empleados = $model->cantidad_empleados;
                        $table->modulo = $model->modulo;
                        $table->observacion = $model->observacion;
                        $table->total_segundos = $orden->segundosficha;
                        $table->total_minutos = ''.number_format($table->total_segundos /60,2);
                        $table->tiempo_operario = ''.number_format($table->total_minutos / $table->cantidad_empleados ,2);
                        $table->save(false);
                        $this->actionActualizarfechaterminacion($idordenproduccion);
                        return $this->redirect(["balanceo/index"]);  
                    }
                }
        }
        if (Yii::$app->request->get("id")) {
            $table = balanceo::find()->where(['id_balanceo' => $id])->one();
            if ($table) {     

               $model->fecha_inicio = $table->fecha_inicio;
               $model->cantidad_empleados = $table->cantidad_empleados;
               $model->modulo = $table->modulo;
               $model->observacion = $table->observacion;
           }else{
                return $this->redirect(['index']);
           }
        } else {
                return $this->redirect(['index']);    
        }
        return $this->render('update', [
            'model' => $model,
            'id'=>$id, 
            'orden' => $orden,
        ]);
    }

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
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el modulo Nro: ' . $balanceo->modulo . ', tiene registros asociados en otros procesos');
                } catch (\Exception $e) {

                    $this->redirect(["balanceo/index"]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar el modulo Nro:  ' . $balanceo->modulo . ', tiene registros asociados en otros procesos');
                }
            } else {
                // echo "Ha ocurrido un error al eliminar el registros, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("balanceo/index") . "'>";
            }
        } else {
            return $this->redirect(["balanceo/index"]);
        }
    }
   
   public function actionEliminardetalle($id_detalle, $id, $idordenproduccion) {
        if (Yii::$app->request->post()) {
            $balanceo_detalle = BalanceoDetalle::findOne($id_detalle);
            if ((int) $id_detalle) {
                try {
                    BalanceoDetalle::deleteAll("id_detalle=:id_detalle", [":id_detalle" => $id_detalle]);
                    Yii::$app->getSession()->setFlash('success', 'Registro Eliminado con exito.');
                    $this->redirect(["balanceo/view",'id'=>$id, 'idordenproduccion'=>$idordenproduccion]);
                } catch (IntegrityException $e) {
                    $this->redirect(["balanceo/view",'id'=>$id, 'idordenproduccion'=>$idordenproduccion]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar al eliminar el registro.!');
                } catch (\Exception $e) {

                    $this->redirect(["balanceo/view",'id'=>$id, 'idordenproduccion'=>$idordenproduccion]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar al eliminar el registro.!');
                }
            } else {
                // echo "Ha ocurrido un error al eliminar el registros, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute(["balanceo/view", 'id'=>$id, 'idordenproduccion'=>$idordenproduccion]) . "'>";
            }
        } else {
            return $this->redirect(["balanceo/view",'id'=>$id, 'idordenproduccion'=>$idordenproduccion]);
        }
    }
    
    public function actionEditaroperacionasignada($id_detalle, $id, $idordenproduccion) {
       
        $model = new BalanceoDetalle;
        $balanceo = Balanceo::findOne($id);   
        
        $tabla_detalle = BalanceoDetalle::findOne($id_detalle);
       if ($model->load(Yii::$app->request->post())) {                        
            $tabla_detalle->id_tipo = $model->id_tipo;
            $tabla_detalle->id_operario = $model->id_operario;
            $tabla_detalle->segundos = $model->segundos;
            $tabla_detalle->minutos = $model->minutos;    
            $tabla_detalle->save(false);     
            $this->ActualizarSegundos($id);
            $this->actionActualizarSobranteRestante($id);
            
            return $this->redirect(['balanceo/view','id' => $id, 'idordenproduccion' => $idordenproduccion]);
        }
        if (Yii::$app->request->get("id_detalle")) {
            $table = BalanceoDetalle::find()->where(['id_detalle' => $id_detalle])->one();
            if ($table) {
                $model->id_tipo = $table->id_tipo;
                $model->id_operario= $table->id_operario;
                $model->segundos = $table->segundos;
                $model->minutos = $table->minutos;
                      
            }    
        }
        return $this->render('_formeditardetallebalanceo', [
            'model' => $model,
            'balanceo' => $balanceo,
            'idordenproduccion' => $idordenproduccion,
           ]);         
    } 

    protected function actionActualizarSobranteRestante($id) 
    {
        $total = 0;
        $balanceo = Balanceo::findOne($id);
        $tabla_detalle = BalanceoDetalle::findAll($id);
        foreach ($tabla_detalle as $dato):
            $total =  $balanceo->tiempo_operario - $dato->total_minutos;
            $dato->save();
        endforeach;
    }
    
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
    
     public function actionExcelbalanceo($id_balanceo, $idordenproduccion) {
        $orden = Ordenproduccion::findOne($idordenproduccion);         
        $balanceo = balanceo::find()->where(['=','id_balanceo', $id_balanceo])->one(); 
        $detalle = BalanceoDetalle::find()->where(['=','id_balanceo', $balanceo->id_balanceo])->orderBy('id_operario ASC')->all();
        
       // $ordendetalleproceso = Ordenproducciondetalleproceso::find()->where(['=','iddetalleorden',$iddetalleorden])->all();
        $items = count($detalle);
        $totalprenda = 0;
        $totalminutos = 0;  
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
                               
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('D1', 'DETALE DEL MODULO')
                    ->setCellValue('B2', 'NIT:')
                    ->setCellValue('C2', $orden->cliente->cedulanit . '-' . $orden->cliente->dv)
                    ->setCellValue('D2', 'FECHA LLEGADA:')
                    ->setCellValue('E2', $orden->fechallegada)
                    ->setCellValue('B3', 'CLIENTE:')
                    ->setCellValue('C3', $orden->cliente->nombrecorto)
                    ->setCellValue('D3', 'FECHA ENTREGA:')
                    ->setCellValue('E3', $orden->fechaentrega)
                    ->setCellValue('B4', 'COD PRODUCTO:')
                    ->setCellValue('C4', $orden->codigoproducto)
                    ->setCellValue('D4', 'ORDEN PRODUCCION:')
                    ->setCellValue('E4', $orden->idordenproduccion)
                    ->setCellValue('F4', 'TIPO ORDEN:')
                    ->setCellValue('G4', $orden->tipo->tipo)
                    ->setCellValue('A7', 'Id')
                    ->setCellValue('B7', 'Proceso')
                    ->setCellValue('C7', 'Maquina')
                    ->setCellValue('D7', 'Operario)')
                    ->setCellValue('E7', 'S.Operacion')
                    ->setCellValue('F7', 'M_Operacion')
                    ->setCellValue('G7', 'T. Seg.')
                    ->setCellValue('H7', 'T. Mit.')
                    ->setCellValue('I7', 'S/F')
                    ->setCellValue('J7', 'U. X HORA');
        $i = 10;
        
        foreach ($detalle as $val) {
            $totalprenda += ((60/$val->minutos)/60)*$balanceo->cantidad_empleados;                      
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->id_detalle)
                    ->setCellValue('B' . $i, $val->proceso->proceso)
                    ->setCellValue('C' . $i, $val->tipo->descripcion)
                    ->setCellValue('D' . $i, $val->operario->nombrecompleto)                    
                    ->setCellValue('E' . $i, $val->segundos)                    
                    ->setCellValue('F' . $i, $val->minutos)
                    ->setCellValue('G' . $i, $val->total_segundos)
                    ->setCellValue('H' . $i, $val->total_minutos)
                    ->setCellValue('I' . $i, $val->sobrante_faltante)
                    ->setCellValue('J' . $i, ''. number_format(60 / $val->minutos,2));
            $i++;
        }
        $j = $i + 1;
        $objPHPExcel->getActiveSheet()->getStyle($j)->getFont()->setBold(true);
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('C' . $j, 'Items: '.$items)
                ->setCellValue('D' . $j, 'Total Minutos: '. $balanceo->total_minutos)
                ->setCellValue('E' . $j, 'Un. x Hora: '. ''. number_format($totalprenda),2);
        
        $objPHPExcel->getActiveSheet()->setTitle('Balanceo modular');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Balanceo_modular.xlsx"');
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
