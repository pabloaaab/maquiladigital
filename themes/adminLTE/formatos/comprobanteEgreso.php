<?php

use inquid\pdf\FPDF;
use app\models\ComprobanteEgreso;
use app\models\ComprobanteEgresoDetalle;
use app\models\Compra;
use app\models\Matriculaempresa;
use app\models\Municipio;
use app\models\Departamento;

class PDF extends FPDF {

    function Header() {
        $id_comprobante_egreso = $GLOBALS['id_comprobante_egreso'];
        $comprobanteEgreso = ComprobanteEgreso::findOne($id_comprobante_egreso);
        $config = Matriculaempresa::findOne(1);
        $municipio = Municipio::findOne($config->idmunicipio);
        $departamento = Departamento::findOne($config->iddepartamento);
//Logo
        $this->SetXY(53, 10);
        $this->Image('dist/images/logos/logomaquila.png', 10, 10, 40, 29);
        //Encabezado
        $this->SetFont('Arial', '', 12);
        $this->SetXY(53, 9);
        $this->Cell(150, 7, utf8_decode($config->razonsocialmatricula), 0, 0, 'C', 0);
        $this->SetXY(53, 13.5);
        $this->Cell(150, 7, utf8_decode(" NIT:" .$config->nitmatricula." - ".$config->dv), 0, 0, 'C', 0);
        $this->SetXY(53, 18);
        $this->Cell(150, 7, utf8_decode($config->direccionmatricula. " Teléfono: " .$config->telefonomatricula), 0, 0, 'C', 0);
        $this->SetXY(53, 23);
        $this->Cell(150, 7, utf8_decode($config->municipio->municipio." - ".$config->departamento->departamento), 0, 0, 'C', 0);
        $this->SetXY(53, 28);
        $this->Cell(150, 7, utf8_decode($config->tipoRegimen->regimen), 0, 0, 'C', 0);
        $this->SetXY(53, 32);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(150, 7, utf8_decode("Autorización Numeración de Facturación: Res. Dian N° " .$config->resolucion->nroresolucion), 0, 0, 'C', 0);
        $this->SetXY(53, 36);
        $this->Cell(150, 7, utf8_decode("Fecha: ". date('d-m-Y', strtotime($config->resolucion->fechacreacion)). " Numeración: ". $config->resolucion->desde. " AL ". $config->resolucion->hasta), 0, 0, 'C', 0);
        $this->SetXY(53, 40);
        $this->Cell(150, 7, utf8_decode("Código Actividad: " .$config->resolucion->codigoactividad. " Descripción: ". $config->resolucion->descripcion), 0, 0, 'C', 0);
        $this->SetXY(10, 42);
        $this->Cell(190, 7, utf8_decode("_________________________________________________________________________________________________"), 0, 0, 'C', 0);
        //Recibo caja
        $this->SetXY(10, 47);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(162, 7, utf8_decode("COMPROBANTE DE EGRESO"), 0, 0, 'l', 0);
        $this->Cell(30, 7, utf8_decode('N°. ' . str_pad($comprobanteEgreso->numero, 4, "0", STR_PAD_LEFT)), 0, 0, 'l', 0);
        $this->SetFillColor(200, 200, 200);
        $this->SetXY(10, 59); //FILA 1
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, utf8_decode("NIT:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($comprobanteEgreso->proveedor->cedulanit . '-' . $comprobanteEgreso->proveedor->dv), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, utf8_decode("T. COMPROBANTE:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 7.8);
        $this->SetXY(160, 60);
        //$this->Cell(50, 6, utf8_decode($comprobanteEgreso->comprobanteEgresoTipo->concepto), 0, 0, 'L');
        $this->MultiCell(47, 3.5, utf8_decode($comprobanteEgreso->comprobanteEgresoTipo->concepto), 0, 'L');
        $this->SetXY(10, 64); //FILA 2
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, utf8_decode("PROVEEDOR:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($comprobanteEgreso->proveedor->nombrecorto), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        //$this->Cell(35, 6, utf8_decode("FECHA CREACIÓN:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        //$this->Cell(50, 6, utf8_decode($comprobanteEgreso->fecha_comprobante), 0, 0, 'L');
        $this->SetXY(10, 70); //FILA 3
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, utf8_decode("DIRECCIÓN:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($comprobanteEgreso->proveedor->direccionproveedor), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, utf8_decode("SUBTOTAL:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 6, utf8_decode(number_format($comprobanteEgreso->subtotal,1)), 0, 0, 'L');
        $this->SetXY(10, 76); //FILA 4
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, utf8_decode("CIUDAD:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($comprobanteEgreso->proveedor->municipio->municipio . " - " . $comprobanteEgreso->proveedor->departamento->departamento), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, utf8_decode("IVA:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 6, utf8_decode(number_format($comprobanteEgreso->iva,1)), 0, 0, 'L');
        $this->SetXY(10, 82); //FILA 5
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, utf8_decode("TELÉFONO:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($comprobanteEgreso->proveedor->telefonoproveedor), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, utf8_decode("RETE FUENTE:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 6, utf8_decode(number_format($comprobanteEgreso->retefuente,1)), 0, 0, 'L');
        $this->SetXY(10, 88); //FILA 6
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, utf8_decode("BANCO:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($comprobanteEgreso->banco->entidad), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, utf8_decode("RETE IVA:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(50, 6, utf8_decode(number_format($comprobanteEgreso->reteiva,1)), 0, 0, 'L');
        $this->SetXY(10, 94); //FILA 7
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(25, 6, utf8_decode("PRODUCTO:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($comprobanteEgreso->banco->producto), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, utf8_decode("BASE AIU:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(50, 6, utf8_decode(number_format($comprobanteEgreso->base_aiu,1)), 0, 0, 'L');
        $this->SetXY(10, 100); //FILA 8
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(25, 6, utf8_decode("FECHA PAGO:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($comprobanteEgreso->fecha_comprobante), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, utf8_decode("TOTAL:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(50, 6, utf8_decode(number_format($comprobanteEgreso->valor)), 0, 0, 'L');
        $this->SetXY(10, 106); //FILA 9
        $this->SetFont('Arial', 'B', 10);
        $this->MultiCell(30, 6, utf8_decode('OBSERVACIÓN:'), 0, 'J');
        $this->SetXY(40, 106); 
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(162, 6, utf8_decode($comprobanteEgreso->observacion), 0, 'J');
        //Lineas del encabezado
        $this->Line(10, 118, 10, 275); //x1,y1,x2,y2        
        $this->Line(84, 118, 84, 275); //x1,y1,x2,y2        
        $this->Line(105, 118, 105, 275); //x1,y1,x2,y2
        $this->Line(126, 118, 126, 275); //x1,y1,x2,y2
        $this->Line(147, 118, 147, 275); //x1,y1,x2,y2
        $this->Line(168, 118, 168, 275); //x1,y1,x2,y2
        $this->Line(185, 118, 185, 275); //x1,y1,x2,y2
        $this->Line(202, 118, 202, 275); //x1,y1,x2,y2
        $this->Line(10, 275, 202, 275); //linea horizontal inferior x1,y1,x2,y2
        //Detalle factura
        $this->EncabezadoDetalles();
    }

    function EncabezadoDetalles() {
        $this->Ln(3);
        $header = array('CONCEPTO', utf8_decode('N° FACTURA'), 'VLR ABONO', 'VLR SALDO', 'SUBTOTAL', 'RTE IVA', 'BASE AIU');
        $this->SetFillColor(200, 200, 200);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.2);
        $this->SetFont('', 'B', 9);

        //creamos la cabecera de la tabla.
        $w = array(74, 21, 21, 21, 21, 17, 17);
        for ($i = 0; $i < count($header); $i++)
            if ($i == 0 || $i == 1)
                $this->Cell($w[$i], 5, $header[$i], 1, 0, 'C', 1);
            else
                $this->Cell($w[$i], 5, $header[$i], 1, 0, 'C', 1);

        //Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $this->Ln(5);
    }

    function Body($pdf, $model) {
        $detalles = ComprobanteEgresoDetalle::find()->where(['=', 'id_comprobante_egreso', $model->id_comprobante_egreso])->all();
        $pdf->SetX(10);
        $pdf->SetFont('Arial', '', 9);
        $i = 0;
        foreach ($detalles as $detalle) {
            $i = $i + 1;
            $pdf->SetFont('Arial', '', 7.5);
            if ($model->libre == 0){
                $pdf->Cell(74, 5, $detalle->compra->compraConcepto->concepto, 0, 0, 'L');
            }else{
                $pdf->Cell(74, 5, $model->comprobanteEgresoTipo->concepto, 0, 0, 'L');
            }
            
            $pdf->SetFont('Arial', '', 9);
            if ($model->libre == 0){
                $pdf->Cell(21, 5, $detalle->compra->factura, 0, 0, 'R');
            }else{
                $pdf->Cell(21, 5, 'No Aplica', 0, 0, 'L');
            }            
            $pdf->Cell(21, 5, number_format($detalle->vlr_abono, 1, '.', ','), 0, 0, 'R');
            $pdf->Cell(21, 5, number_format($detalle->vlr_saldo, 1, '.', ','), 0, 0, 'R');
            $pdf->Cell(21, 5, number_format($detalle->subtotal, 1, '.', ','), 0, 0, 'R');
            $pdf->Cell(17, 5, number_format($detalle->reteiva, 1, '.', ','), 0, 0, 'R');
            $pdf->Cell(17, 5, number_format($detalle->base_aiu, 1, '.', ','), 0, 0, 'R');
            $pdf->Ln();
            $pdf->SetAutoPageBreak(true, 20);
        }
    }

    function Footer() {

        $this->SetFont('Arial', '', 8);
        //$this->Text(10, 290, utf8_decode('Nuestra compañía, en favor del medio ambiente.'));
        //$this->Text(170, 290, utf8_decode('Página ') . $this->PageNo() . ' de {nb}');
    }

}

global $id_comprobante_egreso;
$id_comprobante_egreso = $model->id_comprobante_egreso;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Body($pdf, $model);
$pdf->AliasNbPages();
$pdf->SetFont('Times', '', 10);
$pdf->Output("ComprobanteEgreso$model->id_comprobante_egreso.pdf", 'D');

exit;

function zero_fill($valor, $long = 0) {
    return str_pad($valor, $long, '0', STR_PAD_LEFT);
}

function valorEnLetras($x) {
    if ($x < 0) {
        $signo = "menos ";
    } else {
        $signo = "";
    }
    $x = abs($x);
    $C1 = $x;

    $G6 = floor($x / (1000000));  // 7 y mas 

    $E7 = floor($x / (100000));
    $G7 = $E7 - $G6 * 10;   // 6 

    $E8 = floor($x / 1000);
    $G8 = $E8 - $E7 * 100;   // 5 y 4 

    $E9 = floor($x / 100);
    $G9 = $E9 - $E8 * 10;  //  3 

    $E10 = floor($x);
    $G10 = $E10 - $E9 * 100;  // 2 y 1 


    $G11 = round(($x - $E10) * 100);  // Decimales 
////////////////////// 

    $H6 = unidades($G6);

    if ($G7 == 1 AND $G8 == 0) {
        $H7 = "Cien ";
    } else {
        $H7 = decenas($G7);
    }

    $H8 = unidades($G8);

    if ($G9 == 1 AND $G10 == 0) {
        $H9 = "Cien ";
    } else {
        $H9 = decenas($G9);
    }

    $H10 = unidades($G10);

    if ($G11 < 10) {
        $H11 = "" . $G11;
    } else {
        $H11 = $G11;
    }

///////////////////////////// 
    if ($G6 == 0) {
        $I6 = " ";
    } elseif ($G6 == 1) {
        $I6 = "Millón ";
    } else {
        $I6 = "Millones ";
    }

    if ($G8 == 0 AND $G7 == 0) {
        $I8 = " ";
    } else {
        $I8 = "Mil ";
    }

    $I10 = "Pesos ";
    $I11 = "M.L ";

    $C3 = $signo . $H6 . $I6 . $H7 . $H8 . $I8 . $H9 . $H10 . $I10 . $H11 . $I11;

    return $C3; //Retornar el resultado 
}

function unidades($u) {
    if ($u == 0) {
        $ru = " ";
    } elseif ($u == 1) {
        $ru = "Un ";
    } elseif ($u == 2) {
        $ru = "Dos ";
    } elseif ($u == 3) {
        $ru = "Tres ";
    } elseif ($u == 4) {
        $ru = "Cuatro ";
    } elseif ($u == 5) {
        $ru = "Cinco ";
    } elseif ($u == 6) {
        $ru = "Seis ";
    } elseif ($u == 7) {
        $ru = "Siete ";
    } elseif ($u == 8) {
        $ru = "Ocho ";
    } elseif ($u == 9) {
        $ru = "Nueve ";
    } elseif ($u == 10) {
        $ru = "Diez ";
    } elseif ($u == 11) {
        $ru = "Once ";
    } elseif ($u == 12) {
        $ru = "Doce ";
    } elseif ($u == 13) {
        $ru = "Trece ";
    } elseif ($u == 14) {
        $ru = "Catorce ";
    } elseif ($u == 15) {
        $ru = "Quince ";
    } elseif ($u == 16) {
        $ru = "Dieciseis ";
    } elseif ($u == 17) {
        $ru = "Decisiete ";
    } elseif ($u == 18) {
        $ru = "Dieciocho ";
    } elseif ($u == 19) {
        $ru = "Diecinueve ";
    } elseif ($u == 20) {
        $ru = "Veinte ";
    } elseif ($u == 21) {
        $ru = "Veinti un ";
    } elseif ($u == 22) {
        $ru = "Veinti dos ";
    } elseif ($u == 23) {
        $ru = "Veinti tres ";
    } elseif ($u == 24) {
        $ru = "Veinti cuatro ";
    } elseif ($u == 25) {
        $ru = "Veinti cinco ";
    } elseif ($u == 26) {
        $ru = "Veinti seis ";
    } elseif ($u == 27) {
        $ru = "Veinti siente ";
    } elseif ($u == 28) {
        $ru = "Veintio cho ";
    } elseif ($u == 29) {
        $ru = "Veinti nueve ";
    } elseif ($u == 30) {
        $ru = "Treinta ";
    } elseif ($u == 31) {
        $ru = "Treinta y un ";
    } elseif ($u == 32) {
        $ru = "Treinta y dos ";
    } elseif ($u == 33) {
        $ru = "Treinta y tres ";
    } elseif ($u == 34) {
        $ru = "Treinta y cuatro ";
    } elseif ($u == 35) {
        $ru = "Treinta y cinco ";
    } elseif ($u == 36) {
        $ru = "Treinta y seis ";
    } elseif ($u == 37) {
        $ru = "Treinta y siete ";
    } elseif ($u == 38) {
        $ru = "Treinta y ocho ";
    } elseif ($u == 39) {
        $ru = "Treinta y nueve ";
    } elseif ($u == 40) {
        $ru = "Cuarenta ";
    } elseif ($u == 41) {
        $ru = "Cuarenta y un ";
    } elseif ($u == 42) {
        $ru = "Cuarenta y dos ";
    } elseif ($u == 43) {
        $ru = "Cuarenta y tres ";
    } elseif ($u == 44) {
        $ru = "Cuarenta y cuatro ";
    } elseif ($u == 45) {
        $ru = "Cuarenta y cinco ";
    } elseif ($u == 46) {
        $ru = "Cuarenta y seis ";
    } elseif ($u == 47) {
        $ru = "Cuarenta y siete ";
    } elseif ($u == 48) {
        $ru = "Cuarenta y ocho ";
    } elseif ($u == 49) {
        $ru = "Cuarenta y nueve ";
    } elseif ($u == 50) {
        $ru = "Cincuenta ";
    } elseif ($u == 51) {
        $ru = "Cincuenta y un ";
    } elseif ($u == 52) {
        $ru = "Cincuenta y dos ";
    } elseif ($u == 53) {
        $ru = "Cincuenta y tres ";
    } elseif ($u == 54) {
        $ru = "Cincuenta y cuatro ";
    } elseif ($u == 55) {
        $ru = "Cincuenta y cinco ";
    } elseif ($u == 56) {
        $ru = "Cincuenta y seis ";
    } elseif ($u == 57) {
        $ru = "Cincuenta y siete ";
    } elseif ($u == 58) {
        $ru = "Cincuenta y ocho ";
    } elseif ($u == 59) {
        $ru = "Cincuenta y nueve ";
    } elseif ($u == 60) {
        $ru = "Sesenta ";
    } elseif ($u == 61) {
        $ru = "Sesenta y un ";
    } elseif ($u == 62) {
        $ru = "Sesenta y dos ";
    } elseif ($u == 63) {
        $ru = "Sesenta y tres ";
    } elseif ($u == 64) {
        $ru = "Sesenta y cuatro ";
    } elseif ($u == 65) {
        $ru = "Sesenta y cinco ";
    } elseif ($u == 66) {
        $ru = "Sesenta y seis ";
    } elseif ($u == 67) {
        $ru = "Sesenta y siete ";
    } elseif ($u == 68) {
        $ru = "Sesenta y ocho ";
    } elseif ($u == 69) {
        $ru = "Sesenta y nueve ";
    } elseif ($u == 70) {
        $ru = "Setenta ";
    } elseif ($u == 71) {
        $ru = "Setenta y un ";
    } elseif ($u == 72) {
        $ru = "Setenta y dos ";
    } elseif ($u == 73) {
        $ru = "Setenta y tres ";
    } elseif ($u == 74) {
        $ru = "Setenta y cuatro ";
    } elseif ($u == 75) {
        $ru = "Setentaycinco ";
    } elseif ($u == 76) {
        $ru = "Setenta y seis ";
    } elseif ($u == 77) {
        $ru = "Setenta y siete ";
    } elseif ($u == 78) {
        $ru = "Setenta y ocho ";
    } elseif ($u == 79) {
        $ru = "Setenta y nueve ";
    } elseif ($u == 80) {
        $ru = "Ochenta ";
    } elseif ($u == 81) {
        $ru = "Ochenta y un ";
    } elseif ($u == 82) {
        $ru = "Ochenta y dos ";
    } elseif ($u == 83) {
        $ru = "Ochenta y tres ";
    } elseif ($u == 84) {
        $ru = "Ochenta y cuatro ";
    } elseif ($u == 85) {
        $ru = "Ochenta y cinco ";
    } elseif ($u == 86) {
        $ru = "Ochenta y seis ";
    } elseif ($u == 87) {
        $ru = "Ochenta y siete ";
    } elseif ($u == 88) {
        $ru = "Ochenta y ocho ";
    } elseif ($u == 89) {
        $ru = "Ochenta y nueve ";
    } elseif ($u == 90) {
        $ru = "Noventa ";
    } elseif ($u == 91) {
        $ru = "Noventa y un ";
    } elseif ($u == 92) {
        $ru = "Noventa y dos ";
    } elseif ($u == 93) {
        $ru = "Noventa y tres ";
    } elseif ($u == 94) {
        $ru = "Noventa y cuatro ";
    } elseif ($u == 95) {
        $ru = "Noventa y cinco ";
    } elseif ($u == 96) {
        $ru = "Noventa y seis ";
    } elseif ($u == 97) {
        $ru = "Noventaysiete ";
    } elseif ($u == 98) {
        $ru = "Noventa y ocho ";
    } else {
        $ru = "Noventa y nueve ";
    }
    return $ru; //Retornar el resultado 
}

function decenas($d) {
    if ($d == 0) {
        $rd = "";
    } elseif ($d == 1) {
        $rd = "Ciento ";
    } elseif ($d == 2) {
        $rd = "Doscientos ";
    } elseif ($d == 3) {
        $rd = "Trescientos ";
    } elseif ($d == 4) {
        $rd = "Cuatrocientos ";
    } elseif ($d == 5) {
        $rd = "Quinientos ";
    } elseif ($d == 6) {
        $rd = "Seiscientos ";
    } elseif ($d == 7) {
        $rd = "Setecientos ";
    } elseif ($d == 8) {
        $rd = "Ochocientos ";
    } else {
        $rd = "Novecientos ";
    }
    return $rd; //Retornar el resultado 
}
