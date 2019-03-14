<?php

use inquid\pdf\FPDF;
use app\models\Remision;
use app\models\Remisiondetalle;
use app\models\Ordenproduccion;
use app\models\Ordenproducciondetalle;
use app\models\Producto;
use app\models\Matriculaempresa;
use app\models\Municipio;
use app\models\Departamento;

class PDF extends FPDF {

    function Header() {
        $idremision = $GLOBALS['idremision'];
        $remision = Remision::findOne($idremision);
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
        //ORDEN PRODUCCION
        $this->SetXY(10, 47);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(162, 7, utf8_decode("REMISIÓN DE ENTREGA"), 0, 0, 'l', 0);
        $this->Cell(30, 7, utf8_decode('N°. '.str_pad($remision->numero, 4, "0", STR_PAD_LEFT)), 0, 0, 'l', 0);        
        $this->SetFillColor(200, 200, 200);
        $this->SetXY(10, 59); //FILA 1
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("NIT:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode($remision->ordenproduccion->cliente->cedulanit . '-' . $remision->ordenproduccion->cliente->dv), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("FECHA LLEGADA:"), 0, 0, 'J');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($remision->ordenproduccion->fechallegada), 0, 0, 'J');
        $this->SetXY(10, 64); //FILA 2
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("CLIENTE:"), 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode($remision->ordenproduccion->cliente->nombrecorto), 0, 0, 'J');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("FECHA ENTREGA:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($remision->ordenproduccion->fechaentrega), 0, 0, 'J');
        $this->SetXY(10, 69); //FILA 3
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("TELÉFONO:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode($remision->ordenproduccion->cliente->telefonocliente), 0, 0, 'J');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("ORDEN PRODUCCIÓN:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($remision->ordenproduccion->ordenproduccion), 0, 0, 'J');
        $this->SetXY(10, 74); //FILA 4
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("DIRECCIÓN:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode($remision->ordenproduccion->cliente->direccioncliente), 0, 0, 'J');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("CÓDIGO PRODUCTO:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($remision->ordenproduccion->codigoproducto), 0, 0, 'J');
        $this->SetXY(10, 79); //FILA 5
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("EMAIL:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode($remision->ordenproduccion->cliente->emailcliente), 0, 0, 'J');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("TIPO ORDEN:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($remision->ordenproduccion->tipo->tipo), 0, 0, 'J');
        $this->SetXY(10, 84); //FILA 6
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(24, 5, utf8_decode("CONTACTO:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(100, 5, utf8_decode($remision->ordenproduccion->cliente->contacto), 0, 0, 'J');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(33, 5, utf8_decode("CIUDAD:"), 0, 0, 'c');
        $this->SetFont('Arial', '', 8);
        $this->Cell(40, 5, utf8_decode($remision->ordenproduccion->cliente->municipio->municipio.' - '.$remision->ordenproduccion->cliente->departamento->departamento), 0, 0, 'J');
        //Lineas del encabezado
        $this->Line(10, 92, 10, 190);//x1,y1,x2,y2        
        $this->Line(40, 92, 40, 190);
        $this->Line(66, 92, 66, 190);
        $this->Line(81, 92, 81, 190);
        $this->Line(95, 92, 95, 190);
        $this->Line(109, 92, 109, 190);
        $this->Line(123, 92, 123, 190);
        $this->Line(137, 92, 137, 190);
        $this->Line(151, 92, 151, 190);
        $this->Line(180, 92, 180, 190);
        $this->Line(201, 92, 201, 190);
        $this->Line(10, 190, 201, 190); //linea horizontal inferior x1,y1,x2,y2
        
        //Linea de la entrega
        $this->Line(10, 232, 10, 265); //linea vertical
        $this->Line(201, 232, 201, 265); //linea vertical
        //Detalle factura
        $this->EncabezadoDetalles();
    }

    function EncabezadoDetalles() {
        $this->Ln(7);
        $header = array('COLOR', 'OC', 'TULA', 'XS','S','M','L','XL','ESTADO','UNID X TULA');
        $this->SetFillColor(200, 200, 200);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.2);
        $this->SetFont('', 'B', 8);

        //creamos la cabecera de la tabla.
        $w = array(30, 26, 15, 14, 14, 14, 14, 14, 29, 21);
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
        $this->SetFillColor(200, 200, 200);
        $detalles = Remisiondetalle::find()->where(['=', 'id_remision', $model->id_remision])->all();
        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'b', 10);
        $items = count($detalles);
        $txs = 0; $ts = 0; $tm = 0; $tl = 0; $txl = 0;
        foreach ($detalles as $detalle) {
            $txs = $txs + $detalle->xs;
            $ts = $ts + $detalle->s;
            $tm = $tm + $detalle->m;
            $tl = $tl + $detalle->l;
            $txl = $txl + $detalle->xl;
            if($detalle->oc == 0){
                $oc = 'Colombia';
            }else{
                $oc = 'Exportacion';
            }
            if($detalle->estado == 0){
                $estado = 'Primera';
            }else{
                $estado = 'Segunda';
            }
            $pdf->Cell(30, 4.5, $detalle->color, 1, 0, 'J');
            if ($detalle->oc == 1){
                $pdf->Cell(26, 4.5, $oc, 1, 0, 'J',1);   
            }else{
                $pdf->Cell(26, 4.5, $oc, 1, 0, 'J',0);
            }            
            $pdf->Cell(15, 4.5, $detalle->tula, 1, 0, 'R');
            if ($detalle->oc == 1 || $detalle->estado == 1){
                $pdf->Cell(14, 4.5, $detalle->xs, 1, 0, 'R',1);
                $pdf->Cell(14, 4.5, $detalle->s, 1, 0, 'R',1);
                $pdf->Cell(14, 4.5, $detalle->m, 1, 0, 'R',1);
                $pdf->Cell(14, 4.5, $detalle->l, 1, 0, 'R',1);
                $pdf->Cell(14, 4.5, $detalle->xl, 1, 0, 'R',1);
                $pdf->Cell(29, 4.5, $estado, 1, 0, 'C',1);
            }else{
                $pdf->Cell(14, 4.5, $detalle->xs, 1, 0, 'R');
                $pdf->Cell(14, 4.5, $detalle->s, 1, 0, 'R');
                $pdf->Cell(14, 4.5, $detalle->m, 1, 0, 'R');
                $pdf->Cell(14, 4.5, $detalle->l, 1, 0, 'R');
                $pdf->Cell(14, 4.5, $detalle->xl, 1, 0, 'R');
                $pdf->Cell(29, 4.5, $estado, 1, 0, 'C');
            }                        
            $pdf->Cell(21, 4.5, $detalle->unidades, 1, 0, 'R');
            $pdf->Ln();
            $pdf->SetAutoPageBreak(true, 20);
        }
        $detalleorden = Ordenproducciondetalle::find()->where(['=','idordenproduccion',$model->idordenproduccion])->all();
        $cxs = 0; $cs = 0; $cm = 0; $cl = 0; $cxl = 0; 
        foreach ($detalleorden as $val){
            if($val->productodetalle->prendatipo->talla->talla == 'XS' or $val->productodetalle->prendatipo->talla->talla == 'xs'){
                $cxs = $val->cantidad;
            }
            if($val->productodetalle->prendatipo->talla->talla == 'S' or $val->productodetalle->prendatipo->talla->talla == 's'){
                $cs = $val->cantidad;
            }
            if($val->productodetalle->prendatipo->talla->talla == 'M' or $val->productodetalle->prendatipo->talla->talla == 'm'){
                $cm = $val->cantidad;
            }
            if($val->productodetalle->prendatipo->talla->talla == 'L' or $val->productodetalle->prendatipo->talla->talla == 'l'){
                $cl = $val->cantidad;
            }
            if($val->productodetalle->prendatipo->talla->talla == 'XL' or $val->productodetalle->prendatipo->talla->talla == 'xl'){
                $cxl = $val->cantidad;
            }
        }
        $this->SetFillColor(200, 200, 200);
        $pdf->SetXY(10, 190);
        $this->SetFont('Arial', 'B', 10);
        $pdf->Cell(56, 6, 'CANT CONFECCION', 1, 0, 'J');
        $pdf->Cell(15, 6, '', 1, 0, 'R');
        $pdf->Cell(14, 6, $txs, 1, 0, 'R');
        $pdf->Cell(14, 6, $ts, 1, 0, 'R');
        $pdf->Cell(14, 6, $tm, 1, 0, 'R');
        $pdf->Cell(14, 6, $tl, 1, 0, 'R');
        $pdf->Cell(14, 6, $txl, 1, 0, 'R');
        $pdf->Cell(29, 12, ' T. Despachadas ', 1, 0, 'C');
        $pdf->Cell(21, 12, $model->total_despachadas, 1, 0, 'R');
        $pdf->SetXY(10, 196);
        $this->SetFont('Arial', 'B', 10);
        $pdf->Cell(56, 6, 'CANT CLIENTE', 1, 0, 'J');
        $pdf->Cell(15, 6, '', 1, 0, 'R');
        $pdf->Cell(14, 6, $cxs, 1, 0, 'R');
        $pdf->Cell(14, 6, $cs, 1, 0, 'R');
        $pdf->Cell(14, 6, $cm, 1, 0, 'R');
        $pdf->Cell(14, 6, $cl, 1, 0, 'R');
        $pdf->Cell(14, 6, $cxl, 1, 0, 'R');
        $pdf->SetXY(10, 202);
        $pdf->Cell(191, 6, 'RESUMEN DE LA ENTREGA', 1, 0, 'C',1);
        $pdf->SetXY(10, 208);
        $pdf->Cell(56, 6, 'TOTAL TULAS', 1, 0, 'J');
        $pdf->Cell(15, 6, $model->total_tulas, 1, 0, 'R');
        $pdf->Cell(14, 6, '', 1, 0, 'R');
        $pdf->Cell(56, 6, 'TOTAL COLOMBIA', 1, 0, 'J');
        $pdf->Cell(29, 6, $model->total_colombia, 1, 0, 'R');
        $pdf->Cell(21, 6, '', 1, 0, 'R');
        $pdf->SetXY(10, 214);
        $pdf->Cell(56, 6, 'TOTAL EXPORTACION', 1, 0, 'J');
        $pdf->Cell(15, 6, $model->total_exportacion, 1, 0, 'R');
        $pdf->Cell(14, 6, '', 1, 0, 'R');
        $pdf->Cell(56, 6, 'TOTAL CONFECCION', 1, 0, 'J');
        $pdf->Cell(29, 6, $model->total_confeccion, 1, 0, 'R');
        $pdf->Cell(21, 6, '', 1, 0, 'R');
        $pdf->SetXY(10, 220);
        $pdf->Cell(56, 6, 'TOTAL SEGUNDAS', 1, 0, 'J');
        $pdf->Cell(15, 6, $model->totalsegundas, 1, 0, 'R');
        $pdf->Cell(14, 6, '', 1, 0, 'R');
        $pdf->Cell(56, 6, '', 1, 0, 'J');
        $pdf->Cell(29, 6, '', 1, 0, 'R');
        $pdf->Cell(21, 6, '', 1, 0, 'R');
        $pdf->SetXY(10, 226);
        $pdf->Cell(191, 6, 'DATOS DE ENTREGA DE LA PRODUCCION', 1, 0, 'C',1);
        $pdf->SetXY(10, 245);
        $pdf->Cell(75, 6, '______________________________________', 0, 0, 'C');
        $pdf->SetXY(120, 245);
        $pdf->Cell(75, 6, '______________________________________', 0, 0, 'C');
        $pdf->SetXY(10, 251);
        $pdf->Cell(75, 6, 'AUDITORIA CLIENTE', 0, 0, 'J');
        $pdf->SetXY(120, 251);
        $pdf->Cell(75, 6, 'PERSONAL QUIEN DESPACHA', 0, 0, 'J');
        $pdf->SetXY(120, 256);
        $pdf->Cell(75, 6, 'C.C.:', 0, 0, 'J');
        $pdf->SetXY(10, 265);
        $pdf->Cell(30, 12, 'NOTA:', 1, 0, 'J',1);
        $pdf->Cell(161, 6, 'Favor verificar que las referencias esten completas y en buenas condiciones.', 1, 0, 'J',1);
        $pdf->SetXY(40, 271);
        $pdf->Cell(161, 6, 'Despues de tres(3) dias no se aceptan devoluciones.', 1, 0, 'J',1);
    }

    function Footer() {

        $this->SetFont('Arial', '', 8);
        $this->Text(10, 290, utf8_decode('Nuestra compañía, en favor del medio ambiente.'));
        $this->Text(170, 290, utf8_decode('Página ') . $this->PageNo() . ' de {nb}');
    }

}

global $idremision;
$idremision = $model->id_remision;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Body($pdf, $model);
$pdf->AliasNbPages();
$pdf->SetFont('Times', '', 10);
$pdf->Output("Remision$model->id_remision.pdf", 'D');

exit;
