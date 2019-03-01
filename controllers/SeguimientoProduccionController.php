<?php

namespace app\controllers;

use Yii;
use app\models\SeguimientoProduccion;
use app\models\SeguimientoProduccionDetalle;
use app\models\SeguimientoProduccionDetalle2;
use app\models\SeguimientoProduccionSearch;
use app\models\FormGenerarSeguimientoProduccion;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UsuarioDetalle;
use app\models\Cliente;
use app\models\Ordenproduccion;
use yii\helpers\ArrayHelper;
use Codeception\Lib\HelperModule;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * SeguimientoProduccionController implements the CRUD actions for SeguimientoProduccion model.
 */
class SeguimientoProduccionController extends Controller
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
     * Lists all SeguimientoProduccion models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',33])->all()){
            $searchModel = new SeguimientoProduccionSearch();
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
     * Displays a single SeguimientoProduccion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $form = new FormGenerarSeguimientoProduccion();
        $operarias = null;
        $horastrabajar = null;
        $minutos = null;   
        $reales = null;
        $descanso = null;
        $sistema = null;
        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
                if(isset($_POST['guardardetalle'])){
                    $this->actionGuardar(1, $id);
                    $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',1])->all();
                    $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                }
                else{
                    if(isset($_GET['calcular'])){
                        $operarias = Html::encode($form->operarias);
                        $horastrabajar = Html::encode($form->horastrabajar);
                        $minutos = Html::encode($form->minutos);
                        $reales = Html::encode($form->reales);
                        $descanso = Html::encode($form->descanso);
                        if ($minutos){
                            if($operarias > 0 && $horastrabajar > 0 && $minutos > 0 ){
                                $ordenproduccion = Ordenproduccion::findOne($model->idordenproduccion);
                                if ($ordenproduccion->cantidad > 0){                                                                            
                                        $horaInicio = new \DateTime($model->hora_inicio);
                                        $horaTermino = new \DateTime(date('H:i:s'));                                
                                        $interval = $horaInicio->diff($horaTermino);
                                        $interval2 = $interval->format('%h');                                        
                                        $interval3 = $interval->format('%i');
                                        $interval4 = $interval2.'.'.$interval3;
                                        $interval4 = ($interval4 * 3600) - ($descanso * 60);
                                        $interval4 = $interval4 / 3600;                                        
                                        $cantidad_por_hora = round(60 / $minutos,2);                                        
                                        $cantidad_total_por_hora = round($cantidad_por_hora * $horastrabajar,2);                                        
                                        $total_unidades_por_dia = round($operarias * $cantidad_total_por_hora,2);
                                        $total_unidades_por_hora = round($total_unidades_por_dia / $horastrabajar,2);                                        
                                        $prendas_sistema = round($total_unidades_por_hora * ($interval4),1);                                        
                                        $form->sistema = $prendas_sistema;
                                        $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',1])->all();
                                        $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();                                    
                                }else{
                                    Yii::$app->getSession()->setFlash('error', 'La cantidad de la orden de produccion debe ser mayor a cero');
                                    $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                                    $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                                    $form->sistema = '';
                                    }    
                            }else{
                                Yii::$app->getSession()->setFlash('error', 'La cantidad de operarias y/o horas a trabajar y/o minutos y/o prendas reales, no pueden ser 0 (cero)');                                                
                                $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                                $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                                $form->sistema = '';
                                }                    
                        }else{
                            Yii::$app->getSession()->setFlash('error', 'No se tiene el valor de la orden de producción para generar el informe');
                            $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                            $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                            $form->sistema = '';
                            }
                        $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                        $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                    }else{
                    $operarias = Html::encode($form->operarias);
                    $horastrabajar = Html::encode($form->horastrabajar);
                    $minutos = $form->minutos;
                    $reales = Html::encode($form->reales);
                    $descanso = Html::encode($form->descanso);
                    if ($minutos){
                        if($operarias > 0 && $horastrabajar > 0 && $minutos > 0 ){
                            $ordenproduccion = Ordenproduccion::findOne($model->idordenproduccion);
                            if ($ordenproduccion->cantidad > 0){
                                /*if($ordenproduccion->segundosficha > 0){*/
                                    $seguimientodetalletemporal = SeguimientoProduccionDetalle2::findOne(1);
                                    $seguimientodetalletemporal->minutos = $minutos;
                                    //$calculohora = date('H:i:s') - $model->hora_inicio;
                                    $horaInicio = new \DateTime($model->hora_inicio);
                                    $horaTermino = new \DateTime(date('H:i:s'));                                
                                    $interval = $horaInicio->diff($horaTermino);
                                                                        
                                    $interval2 = $interval->format('%h');
                                    //$interval3 = $interval->format('%s');
                                    $interval3 = $interval->format('%i');
                                    $interval4 = $interval2.'.'.$interval3;
                                    $interval4 = ($interval4 * 3600) - ($descanso * 60);
                                    $interval4 = $interval4 / 3600;
                                    $seguimientodetalletemporal->fecha_inicio = $model->fecha_inicio_produccion;
                                    $seguimientodetalletemporal->hora_inicio = $model->hora_inicio;
                                    $seguimientodetalletemporal->hora_consulta = date('H:i:s');
                                    $seguimientodetalletemporal->cantidad_por_hora = round(60 / $seguimientodetalletemporal->minutos,2);
                                    $seguimientodetalletemporal->horas_a_trabajar = $horastrabajar;
                                    $seguimientodetalletemporal->cantidad_total_por_hora = round($seguimientodetalletemporal->cantidad_por_hora * $seguimientodetalletemporal->horas_a_trabajar,2);
                                    $seguimientodetalletemporal->operarias = $operarias;
                                    $seguimientodetalletemporal->total_unidades_por_dia = round($operarias * $seguimientodetalletemporal->cantidad_total_por_hora,2);
                                    $seguimientodetalletemporal->total_unidades_por_hora = round($seguimientodetalletemporal->total_unidades_por_dia / $seguimientodetalletemporal->horas_a_trabajar,2);
                                    $seguimientodetalletemporal->prendas_reales = $reales;
                                    $seguimientodetalletemporal->prendas_sistema = round($seguimientodetalletemporal->total_unidades_por_hora * ($interval4),1);
                                    $seguimientodetalletemporal->porcentaje_produccion = round((100 * $reales) / $seguimientodetalletemporal->prendas_sistema,2);
                                    $seguimientodetalletemporal->save(false);
                                    $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',1])->all();
                                    $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                                    $seguimiento = SeguimientoProduccion::findOne($id);
                                    $seguimiento->minutos = $minutos;
                                    $seguimiento->operarias = $operarias;
                                    $seguimiento->horas_a_trabajar = $horastrabajar;
                                    $seguimiento->prendas_reales = $reales;
                                    $seguimiento->descanso = $descanso;
                                    $seguimiento->save(false);
                                    $form->sistema = $seguimientodetalletemporal->prendas_sistema;

                                /*}else{
                                    Yii::$app->getSession()->setFlash('error', 'La orden de produccion no tiene procesos generados en la ficha de operaciones');                                                        
                                    $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                                    $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                                    }*/ 
                            }else{
                                Yii::$app->getSession()->setFlash('error', 'La cantidad de la orden de produccion debe ser mayor a cero');
                                $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                                $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                                $form->sistema = '';
                                }    
                        }else{
                            Yii::$app->getSession()->setFlash('error', 'La cantidad de operarias y/o horas a trabajar y/o minutos y/o prendas reales, no pueden ser 0 (cero)');                                                
                            $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                            $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                            $form->sistema = '';
                            }                    
                    }else{
                        Yii::$app->getSession()->setFlash('error', 'No se tiene el valor de la orden de producción para generar el informe');
                        $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                        $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                        $form->sistema = '';
                        }
                } 
            }
                
                }else {
                $form->getErrors();
                }                
        }else{
            $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
            $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
            $form->sistema = '';
        }
        return $this->render('view', [
            'model' => $model,
            'form' => $form,
            'seguimientodetalletemporal' => $table,
            'seguimientodetalle' => $table2,
        ]);
    }

    /**
     * Creates a new SeguimientoProduccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SeguimientoProduccion();
        $clientes = Cliente::find()->all();
        $ordenesproduccion = Ordenproduccion::find()->Where(['=', 'autorizado', 1])->andWhere(['=', 'facturado', 0])->orderBy('idordenproduccion desc')->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_seguimiento_produccion]);
        }

        return $this->render('create', [
            'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreclientes"),
            'ordenesproduccion' => ArrayHelper::map($ordenesproduccion, "idordenproduccion", "idordenproduccion"),
        ]);
    }

    /**
     * Updates an existing SeguimientoProduccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $clientes = Cliente::find()->all();
        $ordenesproduccion = Ordenproduccion::find()->Where(['=', 'idordenproduccion', $model->idordenproduccion])->all();
        $ordenesproduccion = ArrayHelper::map($ordenesproduccion, "idordenproduccion", "ordenProduccion");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_seguimiento_produccion]);
        }

        return $this->render('update', [
            'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombrecorto"),
            'ordenesproduccion' => $ordenesproduccion,
        ]);
    }

    /**
     * Deletes an existing SeguimientoProduccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        /*$this->findModel($id)->delete();

        return $this->redirect(['index']);*/
        
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
            return $this->redirect(['index']);
        } catch (IntegrityException $e) {
            return $this->redirect(['index']);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
            return $this->redirect(['index']);
        }
    }
    
    public function actionGuardar($id,$idseguimiento)
    {        
        $seguimientodetalletemporal = SeguimientoProduccionDetalle2::findOne($id);        
        $seguimientodetalle = new SeguimientoProduccionDetalle();
        $seguimientodetalle->id_seguimiento_produccion = $idseguimiento;
        $seguimientodetalle->fecha_inicio = $seguimientodetalletemporal->fecha_inicio;
        $seguimientodetalle->minutos = $seguimientodetalletemporal->minutos;
        $seguimientodetalle->hora_inicio = $seguimientodetalletemporal->hora_inicio;
        $seguimientodetalle->hora_consulta = $seguimientodetalletemporal->hora_consulta;
        $seguimientodetalle->cantidad_por_hora = $seguimientodetalletemporal->cantidad_por_hora;
        $seguimientodetalle->horas_a_trabajar = $seguimientodetalletemporal->horas_a_trabajar;
        $seguimientodetalle->cantidad_total_por_hora = $seguimientodetalletemporal->cantidad_total_por_hora;
        $seguimientodetalle->operarias = $seguimientodetalletemporal->operarias;
        $seguimientodetalle->total_unidades_por_dia = $seguimientodetalletemporal->total_unidades_por_dia;
        $seguimientodetalle->total_unidades_por_hora = $seguimientodetalletemporal->total_unidades_por_hora;
        $seguimientodetalle->prendas_reales = $seguimientodetalletemporal->prendas_reales;
        $seguimientodetalle->prendas_sistema = $seguimientodetalletemporal->prendas_sistema;
        $seguimientodetalle->porcentaje_produccion = $seguimientodetalletemporal->porcentaje_produccion;
        $seguimientodetalle->insert();
        //return $this->redirect(['view', 'id' => $idseguimiento]);
        return ;
    }
    
    public function actionEliminardetalle($id,$idseguimiento)
    {
        $seguimientodetalle = SeguimientoProduccionDetalle::findOne($id);
        $seguimientodetalle->delete();

        return $this->redirect(['view', 'id' => $idseguimiento]);
    }

    /**
     * Finds the SeguimientoProduccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SeguimientoProduccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeguimientoProduccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionExcel($id) {
        $seguimientodetalles = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
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
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Codigo')
                    ->setCellValue('B1', 'Id Seguimiento')
                    ->setCellValue('C1', '¨Fecha Inicio')
                    ->setCellValue('D1', 'Hora Inicio')
                    ->setCellValue('E1', 'Hora Consulta')
                    ->setCellValue('F1', 'Minutos')
                    ->setCellValue('G1', 'Horas a Trabajar')
                    ->setCellValue('H1', 'Cantidad por Hora')
                    ->setCellValue('I1', 'Cantidad Total por Hora')
                    ->setCellValue('J1', 'Operarias')
                    ->setCellValue('K1', 'Total Unidades por Dia')
                    ->setCellValue('L1', 'Total Unidades por Hora')
                    ->setCellValue('M1', 'Prendas Sistema')  
                    ->setCellValue('N1', 'Prendas Reales')
                    ->setCellValue('O1', '% Produccion');

        $i = 2;
        
        foreach ($seguimientodetalles as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->id_seguimiento_produccion_detalle)
                    ->setCellValue('B' . $i, $val->id_seguimiento_produccion)
                    ->setCellValue('C' . $i, $val->fecha_inicio)
                    ->setCellValue('D' . $i, $val->hora_inicio)
                    ->setCellValue('E' . $i, $val->hora_consulta)
                    ->setCellValue('F' . $i, $val->minutos)
                    ->setCellValue('G' . $i, $val->horas_a_trabajar)
                    ->setCellValue('H' . $i, $val->cantidad_por_hora)
                    ->setCellValue('I' . $i, $val->cantidad_total_por_hora)
                    ->setCellValue('J' . $i, $val->operarias)
                    ->setCellValue('K' . $i, $val->total_unidades_por_dia)
                    ->setCellValue('L' . $i, $val->total_unidades_por_hora)
                    ->setCellValue('M' . $i, $val->prendas_sistema)
                    ->setCellValue('N' . $i, $val->prendas_reales)
                    ->setCellValue('O' . $i, $val->porcentaje_produccion);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Costo_produccion_diaria');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Costo_produccion_diaria.xlsx"');
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
