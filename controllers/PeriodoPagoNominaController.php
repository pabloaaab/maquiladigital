<?php

namespace app\controllers;

use app\models\GrupoPago;
use app\models\GrupoPagoSearch;
use app\models\PeriodoPago;
use app\models\PeriodopagoSearch;
use app\models\TipoNomina;
use app\models\PeriodoPagoNomina;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FormFiltroConsultaPeriodoPagoNomina;
use app\models\FormPeriodoNominaEditar;
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
 * OrdenProduccionController implements the CRUD actions for Ordenproduccion model.
 */
class PeriodoPagoNominaController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all Ordenproduccion models.
     * @return mixed
     */
 public function actionEditarperiodo($id_periodo_pago_nomina) {
        $model = new FormPeriodoNominaEditar;
        $periodPago = PeriodoPagoNomina::findOne($id_periodo_pago_nomina);
        
        if ($model->load(Yii::$app->request->post())) {                        
            $periodPago->id_grupo_pago = $model->id_grupo_pago;
            $periodPago->id_periodo_pago = $model->id_periodo_pago;
            $periodPago->id_tipo_nomina = $model->id_tipo_nomina;
            $periodPago->fecha_desde = $model->fecha_desde;
            $periodPago->fecha_hasta = $model->fecha_hasta;
            $periodPago->dias_periodo = $model->dias_periodo;
            $periodPago->save(false);                                      
            return $this->redirect(['programacion-nomina/startnomina']);
        }
 }       
  public function actionIndexconsulta() {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',80])->all()){
                $form = new \app\models\FormFiltroConsultaPeriodoPagoNomina();
                $id_grupo_pago = null;
                $id_periodo_pago = null;
                $id_tipo_nomina = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $id_grupo_pago = Html::encode($form->id_grupo_pago);
                        $id_periodo_pago = Html::encode($form->id_periodo_pago);
                        $id_tipo_nomina = Html::encode($form->id_tipo_nomina);
                        $table = PeriodoPagoNomina::find()
                                ->andFilterWhere(['=', 'id_grupo_pago', $id_grupo_pago])
                                ->andFilterWhere(['=', 'id_periodo_pago', $id_periodo_pago])
                                ->andFilterWhere(['=', 'id_tipo_nomina', $id_tipo_nomina]);
                        $table = $table->orderBy('id_grupo_pago desc');
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
                }else {
                $table = PeriodoPagoNomina::find()
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
                return $this->render('consulta', [
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
                               
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Id')
                    ->setCellValue('B1', 'Cod Producto')
                    ->setCellValue('C1', 'Cliente')
                    ->setCellValue('D1', 'Orden Prod Int')
                    ->setCellValue('E1', 'Orden Prod Ext')
                    ->setCellValue('F1', 'Fecha Llegada')
                    ->setCellValue('G1', 'Fecha Proceso')
                    ->setCellValue('H1', 'Fecha Entrega')
                    ->setCellValue('I1', 'Cantidad')
                    ->setCellValue('J1', 'Tipo')
                    ->setCellValue('K1', 'Total')
                    ->setCellValue('L1', 'Autorizado')
                    ->setCellValue('M1', 'Facturado')
                    ->setCellValue('N1', 'Observacion');
        $i = 2;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->idordenproduccion)
                    ->setCellValue('B' . $i, $val->codigoproducto)
                    ->setCellValue('C' . $i, $val->cliente->nombreClientes)
                    ->setCellValue('D' . $i, $val->ordenproduccion)
                    ->setCellValue('E' . $i, $val->ordenproduccionext)
                    ->setCellValue('F' . $i, $val->fechallegada)
                    ->setCellValue('G' . $i, $val->fechaprocesada)
                    ->setCellValue('H' . $i, $val->fechaentrega)
                    ->setCellValue('I' . $i, $val->cantidad)
                    ->setCellValue('J' . $i, $val->tipo->tipo)
                    ->setCellValue('K' . $i, round($val->totalorden,0))
                    ->setCellValue('L' . $i, $val->autorizar)
                    ->setCellValue('M' . $i, $val->facturar)
                    ->setCellValue('N' . $i, $val->observacion);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('ordenes_produccion');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ordenes_produccion.xlsx"');
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
