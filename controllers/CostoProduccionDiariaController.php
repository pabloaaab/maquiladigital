<?php

namespace app\controllers;

use app\models\Ordenproduccion;
use app\models\Ordenproducciontipo;
use app\models\CostoProduccionDiaria;
use app\models\FormGenerarCostoProduccionDiaria;
use Codeception\Lib\HelperModule;
use yii;
use yii\base\Model;
use yii\web\Controller;
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
use moonland\phpexcel\Excel;
use app\models\UsuarioDetalle;

class CostoProduccionDiariaController extends Controller {

    public function actionCostodiario() {
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',20])->all()){
            $ordenesproduccion = Ordenproduccion::find()->Where(['=', 'autorizado', 1])->andWhere(['=', 'facturado', 0])->all();
            $form = new FormGenerarCostoProduccionDiaria;
            $operarias = null;
            $horaslaboradas = null;
            $minutoshora = null;
            $idordenproduccion = null;
            if ($form->load(Yii::$app->request->get())) {
                if ($form->validate()) {
                    $operarias = Html::encode($form->operarias);
                    $horaslaboradas = Html::encode($form->horaslaboradas);
                    $minutoshora = Html::encode($form->minutoshora);
                    $idordenproduccion = Html::encode($form->idordenproduccion);
                    if ($idordenproduccion){
                        if($operarias > 0 && $horaslaboradas > 0){
                            $ordenproduccion = Ordenproduccion::findOne($idordenproduccion);
                            if ($ordenproduccion->cantidad > 0){
                                if($ordenproduccion->segundosficha > 0){
                                    $costolaboralhora = \app\models\CostoLaboralHora::findOne(1);                        
                                    $costodiario = CostoProduccionDiaria::findOne(1);
                                    $costodiario->idcliente = $ordenproduccion->idcliente;
                                    $costodiario->idordenproduccion = $ordenproduccion->idordenproduccion;
                                    $costodiario->cantidad = $ordenproduccion->cantidad;
                                    $costodiario->ordenproduccion = $ordenproduccion->ordenproduccion;
                                    $costodiario->ordenproduccionext = $ordenproduccion->ordenproduccionext;
                                    $costodiario->idtipo = $ordenproduccion->idtipo;
                                    $costodiario->cantidad_x_hora = round($minutoshora / ($ordenproduccion->segundosficha / 60),2);
                                    $costodiario->cantidad_diaria = round(($costodiario->cantidad_x_hora * $horaslaboradas) * $operarias,2);
                                    $costodiario->tiempo_entrega_dias = round($costodiario->cantidad / $costodiario->cantidad_diaria,2);
                                    $costodiario->nro_horas = round($horaslaboradas * $costodiario->tiempo_entrega_dias,2);
                                    $costodiario->dias_entrega = round($costodiario->nro_horas / $horaslaboradas);
                                    $costodiario->costo_muestra_operaria = round($ordenproduccion->segundosficha / 60 * $costolaboralhora->valor_minuto,0);
                                    $costodiario->costo_x_hora = round($costodiario->costo_muestra_operaria * $costodiario->cantidad_x_hora,0);
                                    $costodiario->update();
                                    $table = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',1])->all();                        
                                    $model = $table;
                                }else{
                                    Yii::$app->getSession()->setFlash('error', 'La orden de produccion no tiene procesos generados en la ficha de operaciones');                        
                                    $model = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all();
                                }                            
                            } else{
                                   Yii::$app->getSession()->setFlash('error', 'La cantidad de la orden de produccion debe ser mayor a cero');                        
                                   $model = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all(); 
                            }

                        }else{
                            Yii::$app->getSession()->setFlash('error', 'La cantidad de operarias y/o horas laboradas, no pueden ser 0 (cero)');                        
                            $model = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all();
                        }

                    }else{
                        Yii::$app->getSession()->setFlash('error', 'No se tiene el valor de la orden de producción para generar el informe');
                        $model = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all();
                    }                
                } else {
                    $form->getErrors();
                }
            } else {
                $table = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all();            
                $model = $table;            
            }        
            return $this->render('costodiario', [
                        'model' => $model,
                        'form' => $form,
                        //'pagination' => $pages,
                        'ordenesproduccion' => ArrayHelper::map($ordenesproduccion, "idordenproduccion", "ordenProduccion"),
            ]);
        }else{
            return $this->redirect(['site/sinpermiso']);
        }
    }
    
    public function actionExcel($id) {
        $costoproducciondiario = CostoProduccionDiaria::find()->all();
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
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Cliente')
                    ->setCellValue('B1', 'Orden Producción')
                    ->setCellValue('C1', 'Cantidad por Hora')
                    ->setCellValue('D1', 'Cantidad Diaria')
                    ->setCellValue('E1', 'Tiempo Entrega Días')
                    ->setCellValue('F1', 'Nro Horas')
                    ->setCellValue('G1', 'Días Entrega')
                    ->setCellValue('H1', 'Costo Muestra Operaría')
                    ->setCellValue('I1', 'Costo por Hora');

        $i = 2;
        
        foreach ($costoproducciondiario as $costoproducciondiario) {
            
            $cliente = "";
            if ($costoproducciondiario->idcliente){
                $arCliente = \app\models\Cliente::findOne($costoproducciondiario->idcliente);
                $cliente = $arCliente->nombrecorto;
            }
            
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $cliente)
                    ->setCellValue('B' . $i, $costoproducciondiario->ordenproduccion)
                    ->setCellValue('C' . $i, $costoproducciondiario->cantidad_x_hora)
                    ->setCellValue('D' . $i, $costoproducciondiario->cantidad_diaria)
                    ->setCellValue('E' . $i, $costoproducciondiario->tiempo_entrega_dias)
                    ->setCellValue('F' . $i, $costoproducciondiario->nro_horas)
                    ->setCellValue('G' . $i, $costoproducciondiario->dias_entrega)
                    ->setCellValue('H' . $i, $costoproducciondiario->costo_muestra_operaria)
                    ->setCellValue('I' . $i, $costoproducciondiario->costo_x_hora);
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
