<?php

namespace app\controllers;

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
use app\models\FormFiltroContabilizar;
use yii\web\UploadedFile;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use app\models\UsuarioDetalle;
use app\models\Contabilidad;

class ContabilizarController extends Controller {        
    
    public function actionContabilizar() {
        if (Yii::$app->user->identity){
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',50])->all()){
            $form = new FormFiltroContabilizar;
            $proceso = null;
            $fechadesde = null;
            $fechahasta = null;
            if ($form->load(Yii::$app->request->get())) {
                if ($form->validate()) {
                    
                    $proceso = Html::encode($form->proceso);
                    $fechadesde = Html::encode($form->desde);
                    $fechahasta = Html::encode($form->hasta);
                    $table = Contabilidad::find()
                            ->andFilterWhere(['like', 'proceso', $proceso])
                            ->andFilterWhere(['>=', 'fecha', $fechadesde])
                            ->andFilterWhere(['<=', 'fecha', $fechahasta])
                            ->orderBy('fecha asc');
                    $excel = $table->all();
                    $count = clone $table;
                    $to = $count->count();
                    $pages = new Pagination([
                        'pageSize' => 10,
                        'totalCount' => $count->count()
                    ]);
                    $model = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if(isset($_POST['excel'])){
                        //$table = $table->all();
                        $this->actionExcel($excel);
                    }
                } else {
                    $form->getErrors();
                }
            } else {
                $table = Contabilidad::find()
                        ->orderBy('fecha asc');
                $excel = $table->all();
                $count = clone $table;
                $pages = new Pagination([
                    'pageSize' => 10,
                    'totalCount' => $count->count(),
                ]);
                $model = $table
                        ->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
                if(isset($_POST['excel'])){
                    //$table = $table->all();
                    $this->actionExcel($excel);
                }
            }
            $to = $count->count();
            return $this->render('contabilizar', [
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
    
    public function actionExcel($excel) {                
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);        
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Id')
                    ->setCellValue('B1', 'Tipo')
                    ->setCellValue('C1', 'Fecha')
                    ->setCellValue('D1', 'Cedula/Nit')
                    ->setCellValue('E1', 'Dv')
                    ->setCellValue('F1', 'Razon Social')
                    ->setCellValue('G1', 'Nombres')
                    ->setCellValue('H1', 'Apellidos')
                    ->setCellValue('I1', 'Nombre Completo')
                    ->setCellValue('J1', 'Departamento')
                    ->setCellValue('K1', 'Municipio')
                    ->setCellValue('L1', 'Direccion')
                    ->setCellValue('M1', 'Telefono')  
                    ->setCellValue('N1', 'celular')
                    ->setCellValue('O1', 'Email')
                    ->setCellValue('P1', 'Contacto')
                    ->setCellValue('Q1', 'Telefono Cont')
                    ->setCellValue('R1', 'Celular Cont')                    
                    ->setCellValue('S1', 'Forma Pago')
                    ->setCellValue('T1', 'Plazo Pago')
                    ->setCellValue('U1', 'Tipo Regimen')
                    ->setCellValue('V1', 'Autoretenedor')
                    ->setCellValue('W1', 'Retencion Iva')
                    ->setCellValue('X1', 'Retencion Fuente')
                    ->setCellValue('Y1', 'Observacion');                    
        $i = 2;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->idcliente)
                    ->setCellValue('B' . $i, $val->tipo->tipo)
                    ->setCellValue('C' . $i, $val->fechaingreso)
                    ->setCellValue('D' . $i, $val->cedulanit)
                    ->setCellValue('E' . $i, $val->dv)
                    ->setCellValue('F' . $i, $val->razonsocial)
                    ->setCellValue('G' . $i, $val->nombrecliente)
                    ->setCellValue('H' . $i, $val->apellidocliente)
                    ->setCellValue('I' . $i, $val->nombrecorto)
                    ->setCellValue('J' . $i, $val->departamento->departamento)
                    ->setCellValue('K' . $i, $val->municipio->municipio)
                    ->setCellValue('L' . $i, $val->direccioncliente)
                    ->setCellValue('M' . $i, $val->telefonocliente)
                    ->setCellValue('N' . $i, $val->celularcliente)
                    ->setCellValue('O' . $i, $val->emailcliente)
                    ->setCellValue('P' . $i, $val->contacto)
                    ->setCellValue('Q' . $i, $val->telefonocontacto)
                    ->setCellValue('R' . $i, $val->celularcontacto)
                    ->setCellValue('S' . $i, $val->formapago)
                    ->setCellValue('T' . $i, $val->plazopago)
                    ->setCellValue('U' . $i, $val->regimen)
                    ->setCellValue('V' . $i, $val->autoretener)
                    ->setCellValue('W' . $i, $val->retenerfuente)
                    ->setCellValue('X' . $i, $val->reteneriva)
                    ->setCellValue('Y' . $i, $val->observacion);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('cliente');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="cliente.xlsx"');
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
