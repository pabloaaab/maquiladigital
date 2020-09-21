<?php

namespace app\controllers;


use app\models\Incapacidad;
use app\models\IncapacidadSearch;
use app\models\GrupoPago;
use app\models\GrupoPagoSearch;
use app\models\ConfiguracionIncapacidad;
use app\models\ConfiguracionIncapacidadSearch;
use app\models\SeguimientoIncapacidad;
use app\models\Empleado;
use app\models\Contrato;
use app\models\DiagnosticoIncapacidad;
use app\models\DiagnosticoIncapacidadSearch;
use app\models\FormFiltroIncapacidad;
use app\models\FormIncapacidadSeguimiento;
use app\models\FormIncapacidadSeguimientoEditar;
use app\models\UsuarioDetalle;
use app\models\EntidadSalud;
use app\models\FormIncapacidad;
// aplicacion de yii
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
/**
 * IncapacidadController implements the CRUD actions for Incapacidad model.
 */
class IncapacidadController extends Controller
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
     * Lists all Incapacidad models.
     * @return mixed
     */
   public function actionIndex() {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',81])->all()){
                $form = new FormFiltroIncapacidad();
                $id_empleado = null;
                $numero_incapacidad = null;
                $id_grupo_pago = null;
                $codigo_incapacidad = null; 
                $fecha_inicio = null;
                $fecha_final = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {                        
                        $id_empleado = Html::encode($form->id_empleado);
                        $numero_incapacidad = Html::encode($form->numero_incapacidad);
                        $id_grupo_pago = Html::encode($form->id_grupo_pago);
                        $codigo_incapacidad = Html::encode($form->codigo_incapacidad);
                        $fecha_inicio  = Html::encode($form->fecha_inicio);
                        $fecha_final = Html::encode($form->fecha_final);
                        $table = Incapacidad::find()
                                ->andFilterWhere(['=', 'id_grupo_pago', $id_grupo_pago])
                                ->andFilterWhere(['=', 'codigo_incapacidad ', $codigo_incapacidad])
                                ->andFilterWhere(['=', 'id_empleado', $id_empleado])                                                                                              
                                ->andFilterWhere(['=', 'numero_incapacidad', $numero_incapacidad])
                                ->andFilterWhere(['>=', 'fecha_inicio', $fecha_inicio])
                                ->andFilterWhere(['<=', 'fecha_final', $fecha_final]);

                        $table = $table->orderBy('id_grupo_pago ASC');
                        $tableexcel = $table->all();
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 80,
                            'totalCount' => $count->count()
                        ]);
                        $model = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                            if(isset($_POST['excel'])){                            
                                $check = isset($_REQUEST['id_grupo_pago']);
                                $this->actionExcelconsulta($tableexcel);
                            }
                } else {
                        $form->getErrors();
                }                    
            } else {
                $table = Incapacidad::find()
                        ->orderBy('id_grupo_pago desc');
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
   
   public function actionNuevo() {   
        $model = new FormIncapacidad();        
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
         $empleado = Empleado::find()->all();    
        if ($model->load(Yii::$app->request->post())) {           
            if ($model->validate()) {
                $empleado = Empleado::find()->where(['=', 'id_empleado', 'id_empleado'])->one();
                $id_empleado = $model->id_empleado;
                //inicio de grabado
                if($empleado){
                    $table = new Incapacidad();
                    $table->codigo_incapacidad = $model->codigo_incapacidad;
                    $table->id_empleado = $model->id_empleado;
                    $table->identificacion = $empleado->identificacion;
                    $table->id_contrato = 14;
                    $table->id_grupo_pago = 3;
                    $table->id_codigo = $model->id_codigo;
                    $table->codigo_diagnostico = H25;
                    $table->numero_incapacidad = $model->numero_incapacidad;
                    $table->nombre_medico = $model->nombre_medico;
                    $table->fecha_inicio = $model->fecha_inicio;
                    $table->fecha_final = $model->fecha_final;
                    $table->fecha_documento_fisico = $model->fecha_documento_fisico;
                    $table->fecha_aplicacion = $model->fecha_aplicacion;
                    $table->transcripcion = $model->transcripcion;
                    $table->cobrar_administradora = $model->cobrar_administradora;
                    $table->aplicar_adicional = $model->aplicar_adicional;
                    $table->dias_incapacidad = 1;
                    $table->salario_mes_anterior = 877803;
                    $table->salario = 877803;
                    $table->vlr_liquidado = 877803;
                    $table->porcentaje_pago = 66.67;
                    $table->dias_cobro_eps = 1;
                    $table->vlr_cobro_administradora = 29500;
                    $table->pagar_empleado = $model->pagar_empleado;
                    $table->vlr_saldo_administradora= 29500;
                    $table->id_entidad_salud = 1;
                    $table->prorroga = $model->prorroga;
                    $table->fecha_inicio_empresa = $model->fecha_inicio;
                    $table->fecha_final_empresa = $model->fecha_final;
                    $table->fecha_inicio_administradora = $model->fecha_inicio;
                    $table->fecha_final_administradora = $model->fecha_final;
                    $table->dias_administradora = 1;
                    $table->dias_empresa = 1;
                    $table->dias_acumulados = 0;
                    $table->vlr_hora = 3500;
                    $table->usuariosistema = Yii::$app->user->identity->username;    
                    $table->observacion = $model->observacion;
                    $table->save(false); 
                    return $this->redirect(["incapacidad/index"]);
                } else {
                    Yii::$app->getSession()->setFlash('error', 'No existe el documento del empleado.');
                }
            } else {
                $model->getErrors();
            }
        }
            return $this->render('form', [
                 'model' => $model,
             ]);
    }

    /**
     * Displays a single Incapacidad model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   public function actionView($id)
    {
       $seguimiento = SeguimientoIncapacidad::find()->where(['=','id_incapacidad',$id])->all();
       $registros = count($seguimiento);
        if(Yii::$app->request->post())
        {
            $intIndice = 0;
            if (isset($_POST["seleccion"])) {
                foreach ($_POST["seleccion"] as $intCodigo)
                {
                   $incapacidaddetalle = Incapacidad::findOne($intCodigo);                    
                    if(Incapacidad::deleteAll("id_incapacidad=:id_incapacidad", [":id_incapacidad" => $intCodigo]))
                    {                        
                    } 
                }
                 return $this->redirect(['incapacidad/view', 'id' => $id]);
            }
        }
        return $this->render('view', [
             'model' => $this->findModel($id),
            'seguimiento' => $seguimiento, 
             'registros' => $registros,
        ]);
    }
  // crear nuevo seguimiento a la incapacidad
    public function actionNuevoseguimiento($id_incapacidad)
    {
        $model = new FormIncapacidadSeguimiento();
        $incapacidades = Incapacidad::find()->all();         
        if ($model->load(Yii::$app->request->post())) {
            $incapacidad = Incapacidad::find()->where(['=','id_incapacidad',$model->id_incapacidad])->one();
            if (!$incapacidad){
                $table = new SeguimientoIncapacidad;
                $table->id_incapacidad = $id_incapacidad;
                $table->nota = $model->nota;
                $table->usuariosistema = Yii::$app->user->identity->username;   
                $table->save(false);
                $this->redirect(["incapacidad/view", 'id' => $id_incapacidad]);
            }else{                
                Yii::$app->getSession()->setFlash('error', 'El Número de la incapacidad no existe!');
            }
        }
        return $this->render('_formnuevoseguimiento', [
            'model' => $model,
          // '$incapacidades' => ArrayHelper::map($incapacidades, "id_incapacidad", ""),
            'id' => $id_incapacidad
        ]);
    }
    
  //editar el segumiento a la incapacidad
    public function actionEditarseguimiento($id_seguimiento) {
       
        $model = new FormIncapacidadSeguimientoEditar;
        $incapacidad = Incapacidad::find()->all();        
        $seguimiento = SeguimientoIncapacidad::findOne($id_seguimiento);
       if ($model->load(Yii::$app->request->post())) {                        
            $seguimiento->nota = $model->nota;
            $seguimiento->save(false);                                      
            return $this->redirect(['incapacidad/view','id' => $seguimiento->id_incapacidad]);
        }
        if (Yii::$app->request->get("id_seguimiento")) {
            $table = SeguimientoIncapacidad::find()->where(['id_seguimiento' => $id_seguimiento])->one();
            if ($table) {
                $model->nota = $table->nota;
            }    
        }
        return $this->render('_formeditarseguimiento', [
            'model' => $model,
            'seguimiento' => $seguimiento,
            //'cuentas' => ArrayHelper::map($cuentas, "codigo_cuenta", "cuentanombre"),
        ]);         
    } 
    
    
   public function actionEditar($id) {
            $model = new FormIncapacidad();        
            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->load(Yii::$app->request->post())) {            
                    if ($model->validate()) {
                        $table = Incapacidad::find()->where(['id_incapacidad' => $id])->one();
                        if ($table) {
                            $table->id_grupo_pago = $model->id_grupo_pago;
                            $table->id_periodo_pago = $model->id_periodo_pago;
                            $table->id_tipo_nomina = $model->id_tipo_nomina;
                            $table->fecha_desde = $model->fecha_desde;
                            $table->fecha_hasta = $model->fecha_hasta;
                            $table->fecha_real_corte = $table->fecha_hasta;                    
                            $table->dias_periodo = $model->dias_periodo;                    
                            if ($table->save(false)) {                        
                                $this->redirect(["incapacidad/index"]);
                            } else {                        
                            }
                        } else {
                            $msg = "El registro seleccionado no ha sido encontrado";
                            $tipomsg = "danger";
                        }
                    } else {
                        $model->getErrors();
                    }
           }
          return $this->render("form", ["model" => $model]); 
           
     }    

   public function actionEliminar($id) {
        if (Yii::$app->request->post()) {
            $incapacidad = Incapacidad::findOne($id);
            if ((int) $id) {
                try {
                    Incapacidad::deleteAll("id_incapacidad=:id_incapacidad", [":id_incapacidad" => $id]);
                    Yii::$app->getSession()->setFlash('success', 'Registro Eliminado con exito.');
                    $this->redirect(["incapacidad/index"]);
                } catch (IntegrityException $e) {
                    $this->redirect(["incapacidad/index"]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar la incapacidad Nro: ' . $incapacidad->numero_incapacidad . ', tiene registros asociados en otros procesos');
                } catch (\Exception $e) {

                    $this->redirect(["incapacidad/index"]);
                    Yii::$app->getSession()->setFlash('error', 'Error al eliminar la incapacidad Nro:  ' . $incapacidad->numero_incapacidad . ', tiene registros asociados en otros procesos');
                }
            } else {
                // echo "Ha ocurrido un error al eliminar el registros, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("incapacidad/index") . "'>";
            }
        } else {
            return $this->redirect(["incapacidad/index"]);
        }
    }
     
    protected function findModel($id)
    {
        if (($model = Incapacidad::findOne($id)) !== null) {
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
                    ->setCellValue('A1', 'Documento')
                    ->setCellValue('B1', 'Empleado')
                    ->setCellValue('C1', 'Grupo pago')
                    ->setCellValue('D1', 'Tipo incapacidad')
                    ->setCellValue('E1', 'Numero incapacidad')
                    ->setCellValue('F1', 'Cod. Diagnostico')                    
                    ->setCellValue('G1', 'Nombre medico')
                    ->setCellValue('H1', 'F. Inicio')
                    ->setCellValue('I1', 'F. Final')
                    ->setCellValue('J1', 'F. Proceso')
                    ->setCellValue('K1', 'Dias incapacidad');
                   
        $i = 2  ;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->identificacion)
                    ->setCellValue('B' . $i, $val->empleado->nombrecorto)
                    ->setCellValue('C' . $i, $val->grupoPago->grupo_pago)
                    ->setCellValue('D' . $i, $val->codigoIncapacidad->nombre)
                    ->setCellValue('E' . $i, $val->numero_incapacidad)                    
                    ->setCellValue('F' . $i, $val->codigo_diagnostico)
                    ->setCellValue('G' . $i, $val->nombre_medico)
                    ->setCellValue('H' . $i, $val->fecha_inicio)
                    ->setCellValue('I' . $i, $val->fecha_final)
                    ->setCellValue('J' . $i, $val->fecha_creacion)
                    ->setCellValue('K' . $i, $val->dias_incapacidad);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Incapacidades');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="grupos_de_pago.xlsx"');
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
