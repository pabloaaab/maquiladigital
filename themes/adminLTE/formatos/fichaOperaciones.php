<?php

use inquid\pdf\FPDF;
use app\models\Ordenproduccion;
use app\models\Ordenproducciondetalle;
use app\models\Producto;
use app\models\Matriculaempresa;
use app\models\Municipio;
use app\models\Departamento;

class PDF extends FPDF {

    function Header() {
        $idordenproduccion = $GLOBALS['idordenproduccion'];
        $ordenproduccion = Ordenproduccion::findOne($idordenproduccion);
        $config = Matriculaempresa::findOne(901189320);
        $municipio = Municipio::findOne($config->idmunicipio);
        $departamento = Departamento::findOne($config->iddepartamento);        
        //Logo
        $this->SetXY(53, 10);
        $this->Image('dist/images/logos/logomaquila.png', 10, 10, 40, 29);
        //Encabezado
        $this->SetFont('Arial', '', 12);
        $this->Cell(150, 7, utf8_decode($config->razonsocialmatricula. "NIT:" .$config->nitmatricula." - ".$config->dv), 0, 0, 'C', 0);
        $this->SetXY(53, 15);
        $this->Cell(150, 7, utf8_decode($config->direccionmatricula. "Teléfono:" .$config->telefonomatricula), 0, 0, 'C', 0);
        $this->SetXY(53, 20);
        $this->Cell(150, 7, utf8_decode($config->municipio->municipio." - ".$config->departamento->departamento), 0, 0, 'C', 0);
        $this->SetXY(53, 25);
        $this->Cell(150, 7, utf8_decode($config->tipoRegimen->regimen), 0, 0, 'C', 0);
        $this->SetXY(53, 30);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(150, 7, utf8_decode("Autorización Numeración de Facturación: Res. Dian N° " .$config->resolucion->nroresolucion), 0, 0, 'C', 0);
        $this->SetXY(53, 35);
        $this->Cell(150, 7, utf8_decode("Fecha: ". date('d-m-Y', strtotime($config->resolucion->fechacreacion)). " Numeración: ". $config->resolucion->desde. " AL ". $config->resolucion->hasta), 0, 0, 'C', 0);
        $this->SetXY(53, 40);
        $this->Cell(150, 7, utf8_decode("Código Actividad: " .$config->resolucion->codigoactividad. " Descripción: ". $config->resolucion->descripcion), 0, 0, 'C', 0);
        $this->SetXY(10, 42);
        $this->Cell(190, 7, utf8_decode("_________________________________________________________________________________________________"), 0, 0, 'C', 0);
        //ORDEN PRODUCCION
        $this->SetXY(10, 47);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(162, 7, utf8_decode("FICHA DE OPERACIONES"), 0, 0, 'l', 0);        
        $this->SetFillColor(200, 200, 200);
        $this->SetXY(10, 59); //FILA 1
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("NIT:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode($ordenproduccion->cliente->nitmatricula . '-' . $ordenproduccion->cliente->dv), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("FECHA LLEGADA:"), 0, 0, 'J');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($ordenproduccion->fechallegada), 0, 0, 'J');
        $this->SetXY(10, 64); //FILA 2
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("CLIENTE:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode($ordenproduccion->cliente->nombrecorto), 0, 0, 'J');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("FECHA ENTREGA:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($ordenproduccion->fechaentrega), 0, 0, 'J');
        $this->SetXY(10, 69); //FILA 3
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("CODIGO PROD:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode($ordenproduccion->codigoproducto), 0, 0, 'J');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("ORDEN PRODUCCIÓN:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($ordenproduccion->ordenproduccion), 0, 0, 'J');
        $this->SetXY(10, 74); //FILA 4
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("PRODUCTO:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode(''), 0, 0, 'J');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("TIPO ORDEN:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($ordenproduccion->tipo->tipo), 0, 0, 'J');        
        //Lineas del encabezado
        $this->Line(10, 86, 10, 140);//x1,y1,x2,y2        
        $this->Line(130, 86, 130, 140);
        $this->Line(151, 86, 151, 140);
        $this->Line(176, 86, 176, 140);
        $this->Line(201, 86, 201, 140);
        $this->Line(10, 140, 201, 140); //linea horizontal inferior x1,y1,x2,y2
        
        //Linea de las observacines
        $this->Line(10, 148, 10, 164); //linea vertical
        $this->Line(10, 164, 151, 164); //linea horizontal inferior x1,y1,x2,y2
        //Detalle factura
        $this->EncabezadoDetalles();
    }

    function EncabezadoDetalles() {
        $this->Ln(7);
        $header = array('ID','PROCESO', utf8_decode('DURACIÓN(SEG)'), utf8_decode('PONDERACIÓN(SEG)'), utf8_decode('TOTAL(SEG)'));
        $this->SetFillColor(200, 200, 200);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.2);
        $this->SetFont('', 'B', 8);

        //creamos la cabecera de la tabla.
        $w = array(10,  110, 21, 25, 25);
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
        $detalles = Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $model->idordenproduccion])->all();
        $pdf->SetX(10);
        $pdf->SetFont('Arial', '', 9);
        $items = count($detalles);
        foreach ($detalles as $detalle) {
            $pdf->Cell(120, 5, $detalle->productodetalle->prendatipo->prenda.' '.$detalle->productodetalle->prendatipo->talla->talla.' - '.$detalle->codigoproducto, 0, 0, 'J');          
            $pdf->Cell(21, 5, $detalle->cantidad, 0, 0, 'R');
            $pdf->Cell(25, 4, number_format($detalle->vlrprecio, 2, '.', ','), 0, 0, 'R');
            $pdf->Cell(25, 4, number_format($detalle->subtotal, 2, '.', ','), 0, 0, 'R');
            $pdf->Ln();
            $pdf->SetAutoPageBreak(true, 20);
        }
        $this->SetFillColor(200, 200, 200);
        $pdf->SetXY(10, 140);
        $this->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(71, 8, 'ITEMS: '.$items, 1, 'J');
        $pdf->SetXY(81, 140);
        $pdf->MultiCell(70, 8, 'CANTIDAD: '.$model->cantidad, 1, 'J');
        $pdf->SetXY(151, 140);
        $pdf->MultiCell(25, 8, 'SUBTOTAL:', 1, 'L');
        $pdf->SetXY(176, 140);
        $pdf->MultiCell(25, 8, number_format($model->totalorden, 0, '.', ','), 1, 'R');
        $pdf->SetXY(10, 149);
        $this->SetFont('Arial', 'B', 10);
        $pdf->MultiCell(29, 6, 'Observaciones:', 0, 'J');
        $pdf->SetXY(38, 150);
        $this->SetFont('Arial', '', 8);
        $pdf->MultiCell(112, 4, utf8_decode($model->observacion), 0, 'J');
        $pdf->SetXY(151, 148);
        $this->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(25, 16, 'TOTAL:', 1, 'L');
        $pdf->SetXY(176, 148);
        $pdf->MultiCell(25, 16, number_format($model->totalorden, 0, '.', ','), 1, 'R');
        
        
        
        
    }

    function Footer() {

        $this->SetFont('Arial', '', 8);
        $this->Text(10, 290, utf8_decode('Nuestra compañía, en favor del medio ambiente.'));
        $this->Text(170, 290, utf8_decode('Página ') . $this->PageNo() . ' de {nb}');
    }

}

global $idordenproduccion;
$idordenproduccion = $model->idordenproduccion;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Body($pdf, $model);
$pdf->AliasNbPages();
$pdf->SetFont('Times', '', 10);
$pdf->Output("FichaOperaciones$model->idordenproduccion.pdf", 'D');

exit;
