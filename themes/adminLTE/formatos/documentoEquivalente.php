<?php

use inquid\pdf\FPDF;
use app\models\DocumentoEquivalente;
use app\models\Municipio;
use app\models\Departamento;
use app\models\Matriculaempresa;

class PDF extends FPDF {

    function Header() {
        $id = $GLOBALS['id'];
        $documentoEquivalente = DocumentoEquivalente::findOne($id);
        $config = Matriculaempresa::findOne(1);        
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
        //Documento
        $this->SetXY(10, 47);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(162, 7, utf8_decode("DOCUMENTO EQUIVALENTE"), 0, 0, 'l', 0);
        $this->Cell(30, 7, utf8_decode('N°. ' . str_pad($documentoEquivalente->consecutivo, 4, "0", STR_PAD_LEFT)), 0, 0, 'l', 0);
        $this->SetFillColor(200, 200, 200);
        $this->SetXY(10, 59); //FILA 1
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(45, 6, utf8_decode("IDENTIFICACIÓN:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($documentoEquivalente->identificacion), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 6, utf8_decode("FECHA:"), 0, 0, 'L');        
        $this->Cell(20, 6, utf8_decode($documentoEquivalente->fecha), 0, 0, 'L');
        $this->SetXY(10, 64); //FILA 2
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(45, 6, utf8_decode("NOMBRES / APELLIDOS:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 10);        
        $this->Cell(90, 6, utf8_decode($documentoEquivalente->nombre_completo), 0, 0, 'L');                
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 6, utf8_decode("CIUDAD:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(50, 6, utf8_decode($documentoEquivalente->municipio->municipio.' - '.$documentoEquivalente->departamento->departamento), 0, 0, 'L');        
        $this->SetXY(10, 73); //FILA 3
        $this->SetFillColor(200, 200, 200);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.2);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(193, 6, utf8_decode("Documento equivalente a factura (Art. 3 Dec. 522 de 2003)"), 1, 0, 'C',1);
        //Detalle factura
        $this->EncabezadoDetalles();
    }

    function EncabezadoDetalles() {
        $this->Ln(6.2);
        $header = array(utf8_decode('DESCRIPCIÓN'), 'VALOR', 'SUBTOTAL', 'RETE FUENTE');
        $this->SetFillColor(200, 200, 200);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.2);
        $this->SetFont('', 'B', 9);

        //creamos la cabecera de la tabla.
        $w = array(125, 22, 22, 24);
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
        $pdf->SetX(10);
        $pdf->SetFont('Arial', '', 8);                    
        $pdf->Cell(125, 6, $model->descripcion, 1, 0, 'J');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(22, 6, number_format($model->valor, 0, '.', ','), 1, 0, 'R');
        $pdf->Cell(22, 6, number_format($model->subtotal, 0, '.', ','), 1, 0, 'R');
        $pdf->Cell(24, 6, number_format($model->retencion_fuente, 0, '.', ','), 1, 0, 'R');
        $pdf->Ln(30);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(125, 6, '_________________________________________', 0, 0, 'J');
        $pdf->Ln(5);
        $pdf->Cell(125, 6, 'Firma Autorizada', 0, 0, 'J');
        
    }

    function Footer() {

        $this->SetFont('Arial', '', 8);
        //$this->Text(10, 290, utf8_decode('Nuestra compañía, en favor del medio ambiente.'));
        //$this->Text(170, 290, utf8_decode('Página ') . $this->PageNo() . ' de {nb}');
    }

}

global $id;
$id = $model->consecutivo;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Body($pdf, $model);
$pdf->AliasNbPages();
$pdf->SetFont('Times', '', 10);
$pdf->Output("DocumentoEquivalente$model->consecutivo.pdf", 'D');

exit;

