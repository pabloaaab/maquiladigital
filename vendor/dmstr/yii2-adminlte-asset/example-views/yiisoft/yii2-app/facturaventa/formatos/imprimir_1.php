<?php

use inquid\pdf\FPDF;
use app\models\Facturaventa;
use app\models\Facturaventadetalle;

class PDF extends FPDF {

    function Header() {
        //Logo
        $this->SetXY(53, 10);
        $this->Image('images/logos/logomaquila.png', 10, 10, 40, 29);
        //Encabezado
        $this->SetFont('Arial', '', 12);
        $this->Cell(150, 7, utf8_decode("MAQUILA DIGITAL SAS NIT: 901.189.320-2"), 0, 0, 'C', 0);
        $this->SetXY(53, 15);
        $this->Cell(150, 7, utf8_decode("CR 86 # 44 - 85 Teléfono: 5017117"), 0, 0, 'C', 0);
        $this->SetXY(53, 20);
        $this->Cell(150, 7, utf8_decode("MEDELLIN - ANTIOQUIA"), 0, 0, 'C', 0);
        $this->SetXY(53, 25);
        $this->Cell(150, 7, utf8_decode("RÉGIMEN COMÚN"), 0, 0, 'C', 0);
        $this->SetXY(53, 30);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(150, 7, utf8_decode("Autorización Numeración de Facturación: Res. Dian No 18762009830025"), 0, 0, 'C', 0);
        $this->SetXY(53, 35);
        $this->Cell(150, 7, utf8_decode("Fecha: 24-08-2018 Numeración: 1 AL 1000."), 0, 0, 'C', 0);
        $this->SetXY(53, 40);
        $this->Cell(150, 7, utf8_decode("Código Actividad: 1410 Descripción: Confección de prendas de vestir."), 0, 0, 'C', 0);
        $this->SetXY(10, 42);
        $this->Cell(190, 7, utf8_decode("_________________________________________________________________________________________________"), 0, 0, 'C', 0);
        //Factura
        $this->SetXY(10, 47);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(162, 7, utf8_decode("FACTURA DE VENTA"), 0, 0, 'l', 0);
        $this->Cell(30, 7, utf8_decode("N°. 0012"), 0, 0, 'l', 0);
        $this->SetFillColor(200, 200, 200);
        $this->SetXY(10, 54);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(23, 5, utf8_decode("NIT:"), 0, 0, 'l', 1);
        $this->Cell(118, 5, utf8_decode("890.920.043-3"), 0, 0, 'l', 1);
        $this->Cell(25, 5, utf8_decode("FECHA EMISION"), 0, 0, 'c', 1);
        $this->Cell(25, 5, utf8_decode("FECHA VENCE"), 0, 0, 'c', 1);
        $this->SetXY(10, 59);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(23, 5, utf8_decode("CLIENTE:"), 0, 0, 'l', 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(118, 5, utf8_decode("TENNIS SAS"), 0, 0, 'l', 1);
        $this->Cell(25, 5, utf8_decode("2018-11-16"), 0, 0, 'c', 1);
        $this->Cell(25, 5, utf8_decode("2018-11-16"), 0, 0, 'c', 1);
        $this->SetXY(10, 64);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(23, 5, utf8_decode("CIUDAD:"), 0, 0, 'l', 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(118, 5, utf8_decode("ENVIGADO – ANTIOQUIA"), 0, 0, 'l', 1);
        $this->Cell(25, 5, utf8_decode(""), 0, 0, 'c', 1);
        $this->Cell(25, 5, utf8_decode(""), 0, 0, 'c', 1);
        $this->SetXY(10, 69);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(23, 5, utf8_decode("DIRECCIÓN:"), 0, 0, 'l', 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(118, 5, utf8_decode("CR 39  SUR   # 26 -09"), 0, 0, 'l', 1);
        $this->Cell(25, 5, utf8_decode(""), 0, 0, 'c', 1);
        $this->Cell(25, 5, utf8_decode(""), 0, 0, 'c', 1);
        $this->SetXY(10, 74);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(23, 5, utf8_decode("TELÉFONO:"), 0, 0, 'l', 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(118, 5, utf8_decode("3390000"), 0, 0, 'l', 1);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(25, 5, utf8_decode("FORMA PAGO:"), 0, 0, 'c', 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(25, 5, utf8_decode("CONTADO"), 0, 0, 'c', 1);                       
        //Lineas del encabezado
        $this->Line(10,85,10,170);
        $this->Line(23,85,23,170);
        $this->Line(118,85,118,170);
        $this->Line(136,85,136,170);
        $this->Line(156,85,156,170);
        $this->Line(176,85,176,170);
        $this->Line(201,85,201,170);
        //Cuadro de la nota
        $this->Line(10,170,156,170);//linea horizontal superior
        $this->Line(10,170,10,178);//linea vertical
        $this->Line(10,178,156,178);//linea horizontal inferior
        //Linea de las observacines
        $this->Line(10,178,10,202);//linea vertical        
        //Detalle factura
        $this->EncabezadoDetalles();
        
        
    }

    function EncabezadoDetalles() {
        $this->Ln(7);
        $header = array('CODIGO', 'PRODUCTO REFERENCIA', 'CANTIDAD', 'VLR UNIT', 'DSCTO', 'TOTAL');
        $this->SetFillColor(200, 200, 200);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.2);
        $this->SetFont('', 'B', 8);

        //creamos la cabecera de la tabla.
        $w = array(13, 95, 18, 20, 20, 25);
        for ($i = 0; $i < count($header); $i++)
            if ($i == 0 || $i == 1)
                $this->Cell($w[$i], 4, $header[$i], 1, 0, 'C', 1);
            else
                $this->Cell($w[$i], 4, $header[$i], 1, 0, 'C', 1);

        //Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $this->Ln(5);
    }

    function Body($pdf,$model) {
        $detalles = Facturaventadetalle::find()->where(['=','idfactura',$model->idfactura])->all();
        $pdf->SetX(10);
        $pdf->SetFont('Arial', '', 8);
        foreach ($detalles as $detalle) {            
            $pdf->Cell(13, 4, $detalle->iddetallefactura, 0, 0, 'L');
            $pdf->Cell(95, 4, $detalle->producto->nombreProducto, 0, 0, 'L');
            $pdf->Cell(18, 4, $detalle->cantidad, 0, 0, 'R');
            $pdf->Cell(20, 4, number_format($detalle->preciounitario, 2, '.', ','), 0, 0, 'R');
            $pdf->Cell(20, 4, number_format(0, 2, '.', ','), 0, 0, 'R');
            $pdf->Cell(25, 4, number_format($detalle->total, 2, '.', ','), 0, 0, 'R');            
            $pdf->Ln();
            $pdf->SetAutoPageBreak(true, 20);
        }
        $this->SetFillColor(200, 200, 200);
        $pdf->SetXY(10, 170);
        $this->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(146, 4, 'Nota:  TREINTA CUARENTA Y CONCOL MIL NOVENCIENTOS CUEAENRAN TREINTA MIL PRESOS XXXX XXXXX XXXX',0,'J');
        $pdf->SetXY(156, 170);
        $pdf->MultiCell(20, 8, 'SUBTOTAL:',1,'C');
        $pdf->SetXY(176, 170);
        $pdf->MultiCell(25, 8, number_format($model->subtotal, 2, '.', ','),1,'R');
        $pdf->SetXY(10, 178);
        $this->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(146, 4, 'Observaciones:',0,'J');
        $pdf->SetXY(156, 178);
        $pdf->MultiCell(20, 8, 'RETE FTE:',1,'C');
        $pdf->SetXY(176, 178);
        $pdf->MultiCell(25, 8, number_format($model->retencionfuente, 2, '.', ','),1,'R');
        $pdf->SetXY(156, 186);
        $pdf->MultiCell(20, 8, 'IVA:',1,'C');
        $pdf->SetXY(176, 186);
        $pdf->MultiCell(25, 8, number_format($model->impuestoiva, 2, '.', ','),1,'R');
        $pdf->SetXY(156, 194);
        $pdf->MultiCell(20, 8, 'RETE IVA:',1,'C');
        $pdf->SetXY(176, 194);
        $pdf->MultiCell(25, 8, number_format($model->retencioniva, 2, '.', ','),1,'R');
        $pdf->SetXY(10, 202);
        $pdf->MultiCell(146, 8, '',1,'J',1);
        $pdf->SetXY(156, 202);
        $pdf->MultiCell(20, 8, 'TOTAL:',1,'C',1);
        $pdf->SetXY(176, 202);
        $pdf->MultiCell(25, 8, number_format($model->totalpagar, 2, '.', ','),1,'R',1);
        $pdf->SetXY(10, 210);//recibido,aceptado        
        $pdf->Cell(64, 8, 'RECIBIDO POR',1,'J',1);        
        $pdf->Cell(64, 8, 'ACEPTADO POR',1,'J',1);
        $pdf->Cell(63, 8, '',1,'J',1);
        $pdf->SetXY(10, 218);//nit,fecha,fecha,firma        
        $pdf->Cell(32, 5, 'NIT/C.C',1,'L');
        $pdf->Cell(32, 5, 'FECHA',0,'L');        
        $pdf->Cell(64, 5, 'FECHA',0,'L');
        $pdf->Cell(63, 5, 'FIRMA DEL EMISOR',0,'L');
        $pdf->SetXY(10, 245);//nit,fecha,fecha,firma  
        $pdf->MultiCell(192, 4, utf8_decode('Según lo establecido en la ley 1231 de julio 17/08, esta factura se entiende irrevocablemente aceptada, y se asimila en todos sus efectos a una letra de cambio según el artículo 774 del código de comercio. Autorizo a la entidad MAQUILA DIGITAL S.A.S o a quien represente la calidad de acreedor, a reportar, procesar, solicitar o divulgar a cualquier entidad que maneje o administre base de datos la información referente a mi comportamiento comercial.'),1,'J');
        $pdf->SetXY(10, 266);//tipo cuenta
        $pdf->Cell(192, 5, 'TIPO DE CUENTA: CUENTA DE AHORROS  - NUMERO DE CUENTA: 50 2217367 - ENTIDAD BANCARIA: BANCO AVVILLAS',1,'C');
    }

    function Footer() {

        $this->SetFont('Arial', '', 8);
        $this->Text(10, 290, utf8_decode('Nuestra compañía, en favor del medio ambiente.'));
        $this->Text(170, 290, utf8_decode('Página ') . $this->PageNo() . ' de {nb}');
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Body($pdf,$model);
$pdf->AliasNbPages();
$pdf->SetFont('Times', '', 10);
$pdf->Output("Factura.pdf", 'D');

exit;
