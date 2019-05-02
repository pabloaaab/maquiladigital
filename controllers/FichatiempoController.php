<?php

namespace app\controllers;

use Yii;
use app\models\Fichatiempo;
use app\models\Fichatiempodetalle;
use app\models\FichatiempoSearch;
use app\models\Fichatiempocalificacion;
use app\models\FormFiltroConsultaFichatiempo;
use app\models\Parametros;
use app\models\Cliente;
use yii\web\Controller;
use app\models\UsuarioDetalle;
//use alexgx\phpexcel\ExcelDataReader;
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
 * FichatiempoController implements the CRUD actions for Fichatiempo model.
 */
class FichatiempoController extends Controller
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
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',32])->all()){
                $searchModel = new FichatiempoSearch();
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
     * Displays a single Fichatiempo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $fichatiempodetalle = Fichatiempodetalle::find()->where(['=', 'id_ficha_tiempo', $id])->all();
        if (isset($_POST["id_ficha_tiempo_detalle"])) {
            $intIndice = 0;
            foreach ($_POST["id_ficha_tiempo_detalle"] as $intCodigo) {                
                $table = Fichatiempodetalle::findOne($intCodigo);
                $table->idcliente = $_POST["idcliente"][$intIndice];
                $table->dia = $_POST["dia"][$intIndice];
                $table->desde = $_POST["horadesde"][$intIndice];
                $table->hasta = $_POST["horahasta"][$intIndice];
                $table->total_segundos = $_POST["totalsegundos"][$intIndice];
                $table->realizadas = $_POST["realizadas"][$intIndice];                
                $table->save(false);
                $this->Calculos($table);                
                $intIndice++;
            }
            $this->totales($id);
            return $this->redirect(['view', 'id' => $id]);
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'fichatiempodetalle' => $fichatiempodetalle
        ]);
    }

    /**
     * Creates a new Fichatiempo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fichatiempo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fichatiempo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fichatiempo model.
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
            $this->redirect(["fichatiempo/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["fichatiempo/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar la ficha, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar la ficha, tiene registros asociados en otros procesos');
            $this->redirect(["fichatiempo/index"]);
        }
    }
    
    public function actionCerrar($id)
    {        
        $model = $this->findModel($id);
        if ($model->cumplimiento > 0){
            $model->estado = 1;
            $model->save(false);
            return $this->redirect(['view', 'id' => $id]);
        }else{
            Yii::$app->getSession()->setFlash('error', 'No se puede cerrar el registro, no tiene detalles o el cumplimiento no puede ser cero (0)');
            $this->redirect(["fichatiempo/index"]);
        }
        
    }

    /**
     * Finds the Fichatiempo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fichatiempo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fichatiempo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionNuevodetalle($id)
    {              
        $ficha = Fichatiempo::findOne($id);
        $model = new Fichatiempodetalle();
        $model->id_ficha_tiempo = $ficha->id_ficha_tiempo;                
        $model->dia = date('Y-m-d');
        $model->desde = date('12:00:00');
        $model->hasta = date('12:00:00');
        $model->total_segundos = $ficha->total_segundos;
        if  ($model->total_segundos <= 0){
            $model->total_operacion = 0;
        }else{
            $model->total_operacion = round((60 / $model->total_segundos) * 60,2);
        }        
        $model->realizadas = 0;
        $model->cumplimiento = 0;
        $model->observacion = '';        
        $model->save();
        return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionEliminar($id,$iddetalle)
    {                                
        $detalle = Fichatiempodetalle::findOne($iddetalle);
        $detalle->delete();
        $this->redirect(["view",'id' => $id]);        
        $this->Totales($id);
    }
    
    protected function Calculos($table)
    {                
        $totalsegundos = $table->total_segundos;
        if ($totalsegundos == 0){
            $totalsegundos = 1;
        }
        $table->total_operacion = round((60 /$totalsegundos) * 60,2);
        $table->cumplimiento = round(($table->realizadas * 100) / $table->total_operacion,2);
        /*if ($table->cumplimiento < 80){
            $table->observacion = 'No cumple con el perfil de la empresa'; 
        }
        if ($table->cumplimiento > 80 && $table->cumplimiento < 90){
            $table->observacion = 'Cumple con el perfil de la empresa'; 
        }
        if ($table->cumplimiento > 90 && $table->cumplimiento < 100){
            $table->observacion = 'Gana bonificacion de 15000 pesos mensual'; 
        }
        if ($table->cumplimiento > 100){
            $table->observacion = 'Su Salario es 850,000 mil pesos mensuales'; 
        }*/
        $calificacion = Fichatiempocalificacion::find()->all();
        foreach ($calificacion as $val){
            if ($table->cumplimiento > $val->rango1 && $table->cumplimiento <= $val->rango2){
                $table->observacion = $val->observacion;
            }            
        }
        //calculo valor a pagar por producccion
        $parametros = Parametros::findOne(1);        
        $cliente = Cliente::findOne($table->idcliente);
        $minutoconfeccion = $cliente->minuto_confeccion;
        $minutoterminacion = $cliente->minuto_terminacion;
        $valorsegundo = ($minutoconfeccion / 60 * $parametros->porcentaje_empleado) / 100;        
        $table->valor_operacion = round($table->total_segundos * $valorsegundo,0);
        $table->valor_pagar = round($table->realizadas * $table->valor_operacion);
        $table->update();
    }
    
    protected function Totales($id)
    {        
        $detalles = Fichatiempodetalle::find()->where(['=','id_ficha_tiempo',$id])->all();
        $sumacumplimiento = 0;
        $cont = 0;
        foreach ($detalles as $val){
            $sumacumplimiento = $sumacumplimiento + $val->cumplimiento;            
            if ($val === reset($detalles)) { // primer elemento
                $desde = $val->dia;
            }
            if ($val === end($detalles)) {// ultimo elemento
                $hasta = $val->dia;
            }
            $cont++;
        }        
        $table = Fichatiempo::findOne($id);
        if ($cont == 0){
            $cont = 1;
        }
        $table->cumplimiento = round($sumacumplimiento / $cont,2);
        $calificacion = Fichatiempocalificacion::find()->all();
        foreach ($calificacion as $val){
            if ($table->cumplimiento == 0 or $table->cumplimiento == ''){
                $table->observacion = '';
            }else{
                if ($table->cumplimiento > $val->rango1 && $table->cumplimiento <= $val->rango2){
                    $table->observacion = $val->observacion;
                }
            }
                        
        }
        if ($table->cumplimiento == 0 or $table->cumplimiento == ''){
            $table->desde = '';
            $table->hasta = '';
        }else{
            $table->desde = $desde;
            $table->hasta = $hasta;
        }
        
        $table->update();
    }
    
    public function actionGenerarexcel($id) {        
        $ficha = Fichatiempo::findOne($id);
        $model = Fichatiempodetalle::find()->where(['=','id_ficha_tiempo',$id])->all();
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
        $objPHPExcel->getActiveSheet()->mergeCells("a".(1).":l".(1));
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'RESULTADO DE LA PRUEBA TECNICA')
                    ->setCellValue('A2', 'Referencia')
                    ->setCellValue('B2', 'Documento')
                    ->setCellValue('C2', 'Empleado')
                    ->setCellValue('D2', 'Dia')
                    ->setCellValue('E2', 'Hora')
                    ->setCellValue('F2', 'Total Segundos')
                    ->setCellValue('G2', 'Total Operacion')
                    ->setCellValue('H2', 'OP. Realizadas')
                    ->setCellValue('I2', 'Valor Operacion')
                    ->setCellValue('J2', 'Valor a Pagar')
                    ->setCellValue('K2', 'Cumplimiento')
                    ->setCellValue('L2', 'Estado');
        $j = 3;
        
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $j, $ficha->referencia)
                    ->setCellValue('B' . $j, $ficha->empleado->identificacion)
                    ->setCellValue('C' . $j, $ficha->empleado->nombrecorto);    
        $i = 3;
        
        foreach ($model as $val) {
            
            /*$cliente = "";
            if ($costoproducciondiario->idcliente){
                $arCliente = \app\models\Cliente::findOne($costoproducciondiario->idcliente);
                $cliente = $arCliente->nombrecorto;
            }*/            
            
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('D' . $i, $val->dia)
                    ->setCellValue('E' . $i, $val->desde.' - ' .$val->hasta)
                    ->setCellValue('F' . $i, $val->total_segundos)
                    ->setCellValue('G' . $i, $val->total_operacion)
                    ->setCellValue('H' . $i, $val->realizadas)
                    ->setCellValue('I' . $i, $val->valor_operacion)
                    ->setCellValue('J' . $i, $val->valor_pagar)
                    ->setCellValue('K' . $i, $val->cumplimiento)
                    ->setCellValue('L' . $i, $val->observacion);
            $i++;
        }        
        $bold = $i;
        $objPHPExcel->getActiveSheet()->getStyle($bold)->getFont()->setBold(true);        
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('K' . $i, $ficha->cumplimiento)
                    ->setCellValue('L' . $i, $ficha->observacion);

        $objPHPExcel->getActiveSheet()->setTitle('Ficha_Tiempo_detalle');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename="fichatiempodetalle.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0 
        header("Content-Transfer-Encoding: binary ");
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);        
        $objWriter->save('php://output');
        //$objWriter->save($pFilename = 'Descargas');
        exit; 
        
    }
    
    public function actionIndexconsulta() {
        if (Yii::$app->user->identity){
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',43])->all()){
            $form = new FormFiltroConsultaFichatiempo();
            $idempleado = null;
            $desde = null;
            $hasta = null;
            $referencia = null;            
            if ($form->load(Yii::$app->request->get())) {
                if ($form->validate()) {
                    $idempleado = Html::encode($form->idempleado);
                    $desde = Html::encode($form->desde);
                    $hasta = Html::encode($form->hasta);
                    $referencia = Html::encode($form->referencia);                    
                    $table = Fichatiempo::find()
                            ->andFilterWhere(['=', 'id_empleado', $idempleado])
                            ->andFilterWhere(['>=', 'desde', $desde])
                            ->andFilterWhere(['<=', 'desde', $hasta])
                            ->andFilterWhere(['=', 'referencia', $referencia]);
                            
                    $table = $table->orderBy('id_ficha_tiempo desc');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $to = $count->count();
                    $pages = new Pagination([
                        'pageSize' => 20,
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
                $table = Fichatiempo::find()
                        ->orderBy('id_ficha_tiempo desc');
                $tableexcel = $table->all();
                $count = clone $table;
                $pages = new Pagination([
                    'pageSize' => 20,
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
    
    public function actionViewconsulta($id)
    {
        $fichatiempodetalle = Fichatiempodetalle::find()->where(['=', 'id_ficha_tiempo', $id])->all();
                
        return $this->render('view_consulta', [
            'model' => $this->findModel($id),
            'fichatiempodetalle' => $fichatiempodetalle
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);                       
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Id')
                    ->setCellValue('B1', 'Identificacion')
                    ->setCellValue('C1', 'Empleado')
                    ->setCellValue('D1', 'Desde')
                    ->setCellValue('E1', 'Hasta')
                    ->setCellValue('F1', 'Valor Operacion')
                    ->setCellValue('G1', 'Valor a Pagar')
                    ->setCellValue('H1', '% Cumplimiento')
                    ->setCellValue('I1', 'Referencia')                    
                    ->setCellValue('J', 'Total Segundos')
                    ->setCellValue('K1', 'Cerrado')
                    ->setCellValue('L1', 'Observacion');
        $i = 2;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->id_ficha_tiempo)
                    ->setCellValue('B' . $i, $val->empleado->identificacion)
                    ->setCellValue('C' . $i, $val->empleado->nombreEmpleado)
                    ->setCellValue('D' . $i, $val->desde)
                    ->setCellValue('E' . $i, $val->hasta)
                    ->setCellValue('F' . $i, $val->valor_operacion)
                    ->setCellValue('G' . $i, $val->valor_pagar)
                    ->setCellValue('H' . $i, $val->cumplimiento)
                    ->setCellValue('I' . $i, $val->referencia)                    
                    ->setCellValue('J' . $i, $val->total_segundos)
                    ->setCellValue('K' . $i, $val->cerrado)
                    ->setCellValue('L' . $i, $val->observacion);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('fichatiempo');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="fichatiempo.xlsx"');
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
