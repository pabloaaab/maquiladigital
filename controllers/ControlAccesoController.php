<?php

namespace app\controllers;

use Yii;
use app\models\Arl;
use app\models\ArlSearch;
use yii\web\Controller;
use app\models\RegistroPersonal;
use app\models\ControlAcceso;
use app\models\ControlAccesoDetalle;
use app\models\FormValidarControlAcceso;
use app\models\FormAccesoSinDatos;
use app\models\FormAccesoConDatos;
use app\models\FormAcceso;
use app\models\FormFiltroControlAcceso;
use app\models\Empleado;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UsuarioDetalle;
use yii\helpers\Html;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use yii\data\Pagination;

/**
 * ArlController implements the CRUD actions for Arl model.
 */
class ControlAccesoController extends Controller
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
    
    public function actionIndex() {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',94])->all()){
                $form = new FormFiltroControlAcceso;
                $documento = null;
                $tipo_personal = null;
                $fecha = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $documento = Html::encode($form->documento);
                        $tipo_personal = Html::encode($form->tipo_personal);
                        $fecha = Html::encode($form->fecha);
                        $table = ControlAcceso::find()
                                ->andFilterWhere(['like', 'documento', $documento])
                                ->andFilterWhere(['like', 'tipo_personal', $tipo_personal])
                                ->andFilterWhere(['like', 'fecha_creacion', $fecha])
                                ->orderBy('fecha_creacion desc');
                        $tableexcel = $table->all();
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 30,
                            'totalCount' => $count->count()
                        ]);
                        $model = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                        if(isset($_POST['excel'])){
                            //$table = $table->all();
                            $this->actionExcel($tableexcel);
                        }
                    } else {
                        $form->getErrors();
                    }
                } else {
                    $table = ControlAcceso::find()
                            ->orderBy('fecha_creacion desc');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $pages = new Pagination([
                        'pageSize' => 30,
                        'totalCount' => $count->count(),
                    ]);
                    $model = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if(isset($_POST['excel'])){
                        //$table = $table->all();
                        $this->actionExcel($tableexcel);
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
     * Displays a single Facturaventa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modeldetalles = ControlAccesoDetalle::find()->Where(['=', 'id_control_acceso', $id])->all();
        $model = ControlAcceso::findOne($id);
        return $this->render('view', [
            'table' => $model,            
            'modeldetalles' => $modeldetalles,            
        ]);
    }

    public function actionValidar() {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',93])->all()){
                $form = new FormValidarControlAcceso();            
                $cedula = null;
                $tipo_personal = null;
                $sintomascovid = null;
                $msg = "";
                $tipomsg = "";
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {                    
                        $cedula = Html::encode($form->cedula);
                        $tipo_personal = Html::encode($form->tipo_personal);                                        
                        $table = RegistroPersonal::find()->where(['=', 'documento', $cedula])->one();                    
                        if ($table){
                            $control = ControlAcceso::find()->where(['=','documento',$cedula])->andWhere(['like','fecha_ingreso',date('Y-m-d')])->andWhere(['fecha_salida' => null])->one();
                            if ($control){                            
                                $this->redirect(["control-acceso/formularioaccesocondatos", 'id' => $control->id]);// entrada con datos, se registra salida                                                        
                            }else{
                                $this->redirect(["control-acceso/formularioacceso", 'id' => $cedula, 'tipo_personal' => $tipo_personal]); // entrada con datos
                            }                        
                        }else{
                            if ($tipo_personal == 'Visitante'){
                                $this->redirect(["control-acceso/formularioaccesosindatos", 'id' => $cedula, 'tipo_personal' => $tipo_personal]); // entrada sin datos
                            }else{
                                $empleado = Empleado::find()->where(['=', 'identificacion', $cedula])->andWhere(['=','contrato',1])->one();
                                if ($empleado){
                                    $this->redirect(["control-acceso/formularioaccesosindatosempleado", 'id' => $cedula, 'tipo_personal' => $tipo_personal]); // entrada sin datos
                                }else{
                                    $tipo_personal = "Visitante";
                                    $this->redirect(["control-acceso/formularioaccesosindatos", 'id' => $cedula, 'tipo_personal' => $tipo_personal]); // entrada sin datos
                                }
                            }                        
                        }                                                                            
                    } else {
                        $form->getErrors();
                    }            
                }         
                return $this->render('validar', [                    
                        'form' => $form,
                        'tipomsg' => $tipomsg,
                        'msg' => $msg,
                ]);
            }else{
                return $this->redirect(['site/sinpermiso']);
            }    
        } else {
            return $this->redirect(["site/login"]);
        }
    }
    
    public function actionFormularioaccesocondatos($id) {                
        if (!Yii::$app->user->isGuest) {
            $model = new FormAccesoConDatos;
            $msg = "";
            $tipomsg = "";
            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->load(Yii::$app->request->post()))
            {
                if($model->validate())
                {                
                    $table2 = ControlAcceso::findOne($id); 
                    $table = RegistroPersonal::find()->where(['=','documento',$table2->documento])->one();                  
                    
                    $table->id_tipo_documento = $model->id_tipo_documento;
                    $table->nombrecompleto = $model->nombrecompleto;
                    $table->telefono = $model->telefono;
                    $table->celular = $model->celular;                    
                    $table->idmunicipio = $model->idmunicipio;                                        
                    if ($table->save(false)){                        
                        
                        $table2->fecha_salida = date('Y-m-d H:i:s');
                        $table2->temperatura_final = $model->temperatura_final;
                        
                        $table2->observacion = $model->observacion;
                        $table2->tiene_sintomas = $model->tiene_sintomas;
                        if ($table2->save(false)){
                            if ($table2->save(false)){
                                if ($model->sintomascovid){
                                    foreach ($model->sintomascovid as $value) {
                                    $table3 = new ControlAccesoDetalle();
                                    $table3->id_control_acceso = $table2->id;
                                    $table3->id_sintoma_covid = $value;
                                    $table3->acceso = "Salida";
                                    $table3->save(false);
                                }
                                    $msg = "Registrado en el sistema!";
                                    $this->redirect(["control-acceso/validar", 'msg' => $msg, 'tipomsg' => $tipomsg]);
                                }else{
                                    $msg = "Registrado en el sistema!";
                                    $this->redirect(["control-acceso/validar", 'msg' => $msg, 'tipomsg' => $tipomsg]);
                                }                                
                            }                            
                        }                        
                    }                    
                }
                else
                {
                    $model->getErrors();
                }
            }
            
            if (Yii::$app->request->get("id")) {
                
                $cont = ControlAcceso::findOne($id);
                $table = RegistroPersonal::find()->where(['=','documento',$cont->documento])->one();
                $model->id_tipo_documento = $table->id_tipo_documento;
                $model->documento = $table->documento;
                $model->telefono = $table->telefono;
                $model->celular = $table->celular;
                $model->nombrecompleto = $table->nombrecompleto;
                $model->idmunicipio = $table->idmunicipio;
                $model->tiene_sintomas = $cont->tiene_sintomas;
                $model->observacion = $cont->observacion;
            }
            return $this->render("formularioaccesocondatos", ["model" => $model, 'id' => $id]);
        } else {
            return $this->redirect(["site/login"]);
        }
    }
    
    public function actionFormularioaccesosindatos($id,$tipo_personal) {                
        if (!Yii::$app->user->isGuest) {
            $model = new FormAccesoSinDatos;
            $msg = "";
            $tipomsg = "";
            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->load(Yii::$app->request->post()))
            {
                if($model->validate())
                {                
                    $table = new RegistroPersonal();                    
                    $table->documento = $id;
                    $table->id_tipo_documento = $model->id_tipo_documento;
                    $table->nombrecompleto = $model->nombrecompleto;
                    $table->telefono = $model->telefono;
                    $table->celular = $model->celular;                    
                    $table->idmunicipio = $model->idmunicipio;                                        
                    if ($table->insert(false)){
                        $table2 = new ControlAcceso();
                        $table2->id_registro_personal = $table->id;
                        $table2->fecha_ingreso = date('Y-m-d H:i:s');
                        $table2->temperatura_inicial = $model->temperatura_inicial;
                        $table2->documento = $id;
                        $table2->tipo_personal = $tipo_personal;
                        $table2->observacion = $model->observacion;
                        $table2->tiene_sintomas = $model->tiene_sintomas;
                        if ($table2->save(false)){
                            if ($model->sintomascovid){
                                foreach ($model->sintomascovid as $value) {
                                $table3 = new ControlAccesoDetalle();
                                $table3->id_control_acceso = $table2->id;
                                $table3->id_sintoma_covid = $value;
                                $table3->acceso = "Entrada";
                                $table3->save(false);
                            }
                                $msg = "Registrado en el sistema!";
                                $this->redirect(["control-acceso/validar", 'msg' => $msg, 'tipomsg' => $tipomsg]);
                            }else{
                                $msg = "Registrado en el sistema!";
                                $this->redirect(["control-acceso/validar", 'msg' => $msg, 'tipomsg' => $tipomsg]);
                            }                            
                        }                        
                    }                    
                }
                else
                {
                    $model->getErrors();
                }
            }
            return $this->render("formularioaccesosindatos", ["model" => $model, 'id' => $id, 'tipo_personal' => $tipo_personal]);
        } else {
            return $this->redirect(["site/login"]);
        }
    }
    
    public function actionFormularioacceso($id,$tipo_personal) {                
        if (!Yii::$app->user->isGuest) {
            $model = new FormAcceso;
            $msg = "";
            $tipomsg = "";
            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->load(Yii::$app->request->post()))
            {
                if($model->validate())
                {                                    
                    $table = RegistroPersonal::find()->where(['=','documento',$id])->one();                  
                    
                    $table->id_tipo_documento = $model->id_tipo_documento;
                    $table->nombrecompleto = $model->nombrecompleto;
                    $table->telefono = $model->telefono;
                    $table->celular = $model->celular;                    
                    $table->idmunicipio = $model->idmunicipio;                                        
                    if ($table->save(false)){
                        $table2 = new ControlAcceso();
                        $table2->id_registro_personal = $table->id;
                        $table2->fecha_ingreso = date('Y-m-d H:i:s');
                        $table2->temperatura_inicial = $model->temperatura_inicial;
                        $table2->documento = $id;
                        $table2->tipo_personal = $tipo_personal;
                        $table2->observacion = $model->observacion;
                        $table2->tiene_sintomas = $model->tiene_sintomas;
                        if ($table2->save(false)){
                            if ($model->sintomascovid){
                                foreach ($model->sintomascovid as $value) {
                                $table3 = new ControlAccesoDetalle();
                                $table3->id_control_acceso = $table2->id;
                                $table3->id_sintoma_covid = $value;
                                $table3->acceso = "Entrada";
                                $table3->save(false);
                            }
                                $msg = "Registrado en el sistema!";
                                $this->redirect(["control-acceso/validar", 'msg' => $msg, 'tipomsg' => $tipomsg]);
                            }else{
                                $msg = "Registrado en el sistema!";
                                $this->redirect(["control-acceso/validar", 'msg' => $msg, 'tipomsg' => $tipomsg]);
                            }
                            
                        }                        
                    }                    
                }
                else
                {
                    $model->getErrors();
                }
            }
            
            if (Yii::$app->request->get("id")) {
                                
                $table = RegistroPersonal::find()->where(['=','documento',$id])->one();
                $model->id_tipo_documento = $table->id_tipo_documento;
                $model->documento = $table->documento;
                $model->telefono = $table->telefono;
                $model->celular = $table->celular;
                $model->nombrecompleto = $table->nombrecompleto;
                $model->idmunicipio = $table->idmunicipio;                
            }
            return $this->render("formularioacceso", ["model" => $model, 'id' => $id, 'tipo_personal' => $tipo_personal]);
        } else {
            return $this->redirect(["site/login"]);
        }
    }
        
    public function actionFormularioaccesosindatosempleado($id,$tipo_personal) {                
        if (!Yii::$app->user->isGuest) {
            $model = new FormAccesoSinDatos;
            $msg = "";
            $tipomsg = "";
            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->load(Yii::$app->request->post()))
            {
                if($model->validate())
                {                                    
                    $table = new RegistroPersonal();                    
                    $table->documento = $id;
                    $table->id_tipo_documento = $model->id_tipo_documento;
                    $table->nombrecompleto = $model->nombrecompleto;
                    $table->telefono = $model->telefono;
                    $table->celular = $model->celular;                    
                    $table->idmunicipio = $model->idmunicipio;                                        
                    if ($table->insert(false)){
                        $table2 = new ControlAcceso();
                        $table2->id_registro_personal = $table->id;
                        $table2->fecha_ingreso = date('Y-m-d H:i:s');
                        $table2->temperatura_inicial = $model->temperatura_inicial;
                        $table2->documento = $id;
                        $table2->tipo_personal = $tipo_personal;
                        $table2->observacion = $model->observacion;
                        $table2->tiene_sintomas = $model->tiene_sintomas;
                        if ($table2->save(false)){
                            if ($model->sintomascovid){
                                foreach ($model->sintomascovid as $value) {
                                $table3 = new ControlAccesoDetalle();
                                $table3->id_control_acceso = $table2->id;
                                $table3->id_sintoma_covid = $value;
                                $table3->acceso = "Entrada";
                                $table3->save(false);
                            }
                                $msg = "Registrado en el sistema!";
                                $this->redirect(["control-acceso/validar", 'msg' => $msg, 'tipomsg' => $tipomsg]);
                            }else{
                                $msg = "Registrado en el sistema!";
                                $this->redirect(["control-acceso/validar", 'msg' => $msg, 'tipomsg' => $tipomsg]);
                            }                            
                        }                        
                    }                    
                }
                else
                {
                    $model->getErrors();
                }
            }
            if (Yii::$app->request->get("id")) {
                                
                $table = Empleado::find()->where(['=','identificacion',$id])->one();
                $model->id_tipo_documento = $table->id_tipo_documento;
                $model->documento = $table->identificacion;
                $model->telefono = $table->telefono;
                $model->celular = $table->celular;
                $model->nombrecompleto = $table->nombrecorto;
                $model->idmunicipio = $table->idmunicipio;                
            }
            return $this->render("formularioaccesosindatosempleado", ["model" => $model, 'id' => $id, 'tipo_personal' => $tipo_personal]);
        } else {
            return $this->redirect(["site/login"]);
        }
    }
    
    public function actionExcel($tableexcel) {                
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        
                               
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Documento')
                    ->setCellValue('B1', 'Nombre')                    
                    ->setCellValue('C1', 'Fecha Ingreso')
                    ->setCellValue('D1', 'Fecha Salida')
                    ->setCellValue('E1', 'Temperatura Inicial')
                    ->setCellValue('F1', 'Temperatura Final')
                    ->setCellValue('G1', 'Tipo Personal')
                    ->setCellValue('H1', 'Tiene Sintomas')
                    ->setCellValue('I1', 'Observación')
                    ->setCellValue('J1', 'Sintoma 1')
                    ->setCellValue('K1', 'Sintoma 2')
                    ->setCellValue('L1', 'Sintoma 3')
                    ->setCellValue('M1', 'Sintoma 4')
                    ->setCellValue('N1', 'Sintoma 5')
                    ->setCellValue('O1', 'Sintoma 6')
                    ->setCellValue('P1', 'Sintoma 7')
                    ->setCellValue('Q1', 'Sintoma 8')
                    ->setCellValue('R1', 'Sintoma 9')
                    ->setCellValue('S1', 'Sintoma 10');
        $i = 2;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->documento)
                    ->setCellValue('B' . $i, $val->registroPersonal->nombrecompleto)
                    ->setCellValue('C' . $i, $val->fecha_ingreso)
                    ->setCellValue('D' . $i, $val->fecha_salida)
                    ->setCellValue('E' . $i, $val->temperatura_inicial)
                    ->setCellValue('F' . $i, $val->temperatura_final)
                    ->setCellValue('G' . $i, $val->tipo_personal)
                    ->setCellValue('H' . $i, $val->tieneSintomas)
                    ->setCellValue('I' . $i, $val->observacion);
            $i++;            
        }
        
        $k = 2;
        foreach ($tableexcel as $val) {            
            $l = 1;                        
            $sintomasdetalle = ControlAccesoDetalle::find()->where(['=','id_control_acceso',$val->id])->all();
            foreach ($sintomasdetalle as $val) {
                if ($l == 1){
                    $letra = "J";
                }
                if ($l == 2){
                    $letra = "K";
                }
                if ($l == 3){
                    $letra = "L";
                }
                if ($l == 4){
                    $letra = "M";
                }
                if ($l == 5){
                    $letra = "N";
                }
                if ($l == 6){
                    $letra = "O";
                }
                if ($l == 7){
                    $letra = "P";
                }
                if ($l == 8){
                    $letra = "Q";
                }
                if ($l == 9){
                    $letra = "R";
                }
                if ($l == 10){
                    $letra = "S";
                }                
                $objPHPExcel->setActiveSheetIndex(0)                    
                    ->setCellValue($letra . $k, $val->idSintomaCov->sintoma.' ('.$val->acceso.')');                
                $l++;
            }
            $k++;
        }
        

        $objPHPExcel->getActiveSheet()->setTitle('Control_Acceso_Codiv');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Control_Acceso_Codiv.xlsx"');
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
