<?php

use inquid\pdf\FPDF;
use app\models\Fichatiempo;
use app\models\Fichatiempodetalle;

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
        $objPHPExcel->getActiveSheet()->mergeCells("a".(1).":j".(1));
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
                    ->setCellValue('I2', 'Cumplimiento')
                    ->setCellValue('J2', 'Estado');
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
                    ->setCellValue('I' . $i, $val->cumplimiento)
                    ->setCellValue('J' . $i, $val->observacion);
            $i++;
        }        
        $bold = $i;
        $objPHPExcel->getActiveSheet()->getStyle($bold)->getFont()->setBold(true);        
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('I' . $i, $ficha->cumplimiento)
                    ->setCellValue('J' . $i, $ficha->observacion);

        $objPHPExcel->getActiveSheet()->setTitle('Ficha_Tiempo');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename="fichatiempo.xlsx"');
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
        //$objWriter->save('php://output');
        $objWriter->save($pFilename = 'Descargas');
        exit; 

return;