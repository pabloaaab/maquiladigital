<?php

namespace app\controllers;

use app\models\EstudioEmpleado;
use app\models\EstudioEmpleadoSearch;
use app\models\UsuarioDetalle;
use app\models\FormFiltroEstudios;
use app\models\Empleado;
//clases
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Response;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\bootstrap\Modal;

/**
 * EstudioEmpleadoController implements the CRUD actions for EstudioEmpleado model.
 */
class EstudioEmpleadoController extends Controller
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
        if (Yii::$app->user->identity) {
            if (UsuarioDetalle::find()->where(['=', 'codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=', 'id_permiso', 91])->all()) {
                $form = new FormFiltroEstudios();
                $id_empleado = null;
                $id_tipo_estudio = null;
                 $documento = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $id_empleado = Html::encode($form->id_empleado);
                        $documento = Html::encode($form->documento);
                        $id_tipo_estudio = Html::encode($form->id_tipo_estudio);
                        $table = EstudioEmpleado::find()
                                ->andFilterWhere(['=', 'id_empleado', $id_empleado])
                                ->andFilterWhere(['=', 'documento', $documento])
                                ->andFilterWhere(['=', 'id_tipo_estudio', $id_tipo_estudio]);
                        $table = $table->orderBy('id DESC');
                        $tableexcel = $table->all();
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 40,
                            'totalCount' => $count->count()
                        ]);
                        $modelo = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                        if (isset($_POST['excel'])) {
                            $check = isset($_REQUEST['id DESC']);
                            $this->actionExcelconsultaEstudio($tableexcel);
                        }
                    } else {
                        $form->getErrors();
                    }
                } else {
                    $table = EstudioEmpleado::find()
                             ->orderBy('id DESC');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $pages = new Pagination([
                        'pageSize' => 40,
                        'totalCount' => $count->count(),
                    ]);
                    $modelo = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if (isset($_POST['excel'])) {
                        //$table = $table->all();
                        $this->actionExcelconsultaEstudio($tableexcel);
                    }
                }
                $to = $count->count();
                return $this->render('index', [
                            'modelo' => $modelo,
                            'form' => $form,
                            'pagination' => $pages,
                ]);
            } else {
                return $this->redirect(['site/sinpermiso']);
            }
        } else {
            return $this->redirect(['site/login']);
        }
    }
    

    /**
     * Displays a single EstudioEmpleado model.
     * @param integer $id
     * @param string $fecha_inicio
     * @param string $fecha_terminacion
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
     * Creates a new EstudioEmpleado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EstudioEmpleado();        
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $table = new EstudioEmpleado();
                $empleado = Empleado::findOne($model->id_empleado);
                $table->id_empleado = $model->id_empleado;
                $table->documento = $empleado->identificacion;
                $table->idmunicipio = $model->idmunicipio;
                $table->id_tipo_estudio = $model->id_tipo_estudio;
                $table->institucion_educativa = $model->institucion_educativa;
                $table->titulo_obtenido = $model->titulo_obtenido;
                $table->anio_cursado = $model->anio_cursado;
                $table->fecha_inicio = $model->fecha_inicio;
                $table->fecha_terminacion = $model->fecha_terminacion;                
                $table->graduado = $model->graduado;
                $table->fecha_vencimiento = $model->fecha_vencimiento;
                $table->registro = $model->registro;
                $table->validar_vencimiento = $model->validar_vencimiento;
                $table->observacion = $model->observacion;
                $table->usuariosistema = Yii::$app->user->identity->username; 
                $table->insert(); 
                $this->redirect(["estudio-empleado/index"]);
            } else {
                $model->getErrors();
            }                       
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing EstudioEmpleado model.
   
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
      
        $model = new EstudioEmpleado();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {            
            if ($model->validate()) {
                $table = EstudioEmpleado::find()->where(['id' => $id])->one();
                if ($table) {
                    $empleado = Empleado::findOne($model->id_empleado);
                    $table->id_empleado = $model->id_empleado;
                    $table->documento = $empleado->identificacion; 
                    $table->institucion_educativa = $model->institucion_educativa;
                    $table->id_tipo_estudio =  $model->id_tipo_estudio;
                    $table->idmunicipio = $model->idmunicipio;
                    $table->titulo_obtenido = $model->titulo_obtenido;
                    $table->anio_cursado = $model->anio_cursado;
                    $table->fecha_inicio = $model->fecha_inicio;
                    $table->fecha_terminacion = $model->fecha_terminacion;
                    $table->graduado = $model->graduado;
                    $table->fecha_vencimiento =   $model->fecha_vencimiento;
                    $table->registro =  $model->registro;
                    $table->validar_vencimiento =  $model->validar_vencimiento;
                    $table->observacion =  $model->observacion;
                    $table->save(false);
                     return $this->redirect(["estudio-empleado/index"]);

                } 
            } else {
                $model->getErrors();
            }
        }

       if (Yii::$app->request->get("id")) {
            $table = EstudioEmpleado::find()->where(['id' => $id])->one();
            if ($table) {
                $model->id = $table->id    ;
                $model->id_empleado = $table->id_empleado;
                $model->institucion_educativa = $table->institucion_educativa;
                $model->id_tipo_estudio = $table->id_tipo_estudio;
                $model->idmunicipio = $table->idmunicipio;
                $model->titulo_obtenido = $table->titulo_obtenido;
                $model->anio_cursado = $table->anio_cursado;
                $model->fecha_inicio = $table->fecha_inicio;
                $model->fecha_terminacion = $table->fecha_terminacion;
                $model->graduado = $table->graduado;
                $model->fecha_vencimiento = $table->fecha_vencimiento;
                $model->registro = $table->registro;
                $model->validar_vencimiento = $table->validar_vencimiento;
                $model->observacion = $table->observacion;
           
            } else {
                return $this->redirect(["estudio-empleado/index"]);
            }
        } else {
            return $this->redirect(["estudio-empleado/index"]);
        }
        return $this->render("update", ["model" => $model]);
    }

    /**
     * Deletes an existing EstudioEmpleado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $fecha_inicio
     * @param string $fecha_terminacion
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
            $this->redirect(["estudio-empleado/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["estudio-empleado/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene  procesos asociados.!');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene  procesos asociados.!');
            $this->redirect(["estudio-empleado/index"]);
        }
    }
    /**
     * Finds the EstudioEmpleado model based on its primary key value.
     */
   protected function findModel($id)
    {
        if (($model = EstudioEmpleado::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionExcelconsultaEstudio($tableexcel) {                
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
                      
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Id')
                    ->setCellValue('B1', 'Documento')
                    ->setCellValue('C1', 'Empleado')
                    ->setCellValue('D1', 'Tipo estudio')
                    ->setCellValue('E1', 'Institucion')
                    ->setCellValue('F1', 'Titulo obtenido')
                    ->setCellValue('G1', 'Año cursado')                    
                    ->setCellValue('H1', 'Fecha inicio')
                    ->setCellValue('I1', 'Fecha Final')
                    ->setCellValue('J1', 'Graduado')
                    ->setCellValue('K1', 'Registro')
                    ->setCellValue('L1', 'Validar vencimiento')
                    ->setCellValue('M1', 'Usuario')
                    ->setCellValue('N1', 'Observacion');
        $i = 2  ;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                     ->setCellValue('A' . $i, $val->id)
                    ->setCellValue('B' . $i, $val->documento)
                    ->setCellValue('C' . $i, $val->empleado->nombrecorto)
                    ->setCellValue('D' . $i, $val->tipoEstudio->estudio)
                    ->setCellValue('E' . $i, $val->institucion_educativa)
                    ->setCellValue('F' . $i, $val->titulo_obtenido)                    
                    ->setCellValue('G' . $i, $val->anio_cursado)
                    ->setCellValue('H' . $i, $val->fecha_inicio)
                    ->setCellValue('I' . $i, $val->fecha_terminacion)
                    ->setCellValue('J' . $i, $val->graduadoEstudio)
                    ->setCellValue('K' . $i, $val->registro)
                    ->setCellValue('L' . $i, $val->validar)
                    ->setCellValue('M' . $i, $val->usuariosistema)
                    ->setCellValue('N' . $i, $val->observacion);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Estudios');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Estudios.xlsx"');
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
