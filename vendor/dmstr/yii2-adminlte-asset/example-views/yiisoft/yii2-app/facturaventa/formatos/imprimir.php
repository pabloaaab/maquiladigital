<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Cliente;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;


?>


<table border="0" width="100%">
    <thead>
        <tr>
            <th width="20%"><img src="images/logomaquila.png" width="131" height="82" alt="logomaquila"/></th>
            <td width="80%" align="center">
            
                <h4>MAQUILA DIGITAL SAS NIT: 901.189.320-2</h4>
            
                <h4>CR 86 # 44 - 85 Teléfono: 5017117</h4>
            
                <h4>MEDELLÍN - ANTIOQUIA</h4>
            
                <h4>REGIMEN COMÚN</h4>
                <p><b>Autorización Numeración de Facturación: Res. Dian No 18762009830025</b></p>
                <p><b>Fecha: 24-08-2018 Numeración: 1 AL 1000.</b></p>  
                <p><b>Código Actividad: 1410 Descripción: Confección de prendas de vestir.</b></p>
            </td>
        </tr>
    </thead>    
</table>
<p>__________________________________________________________________________________________</p>
<table border="0" width="100%">
    <tr>
        <th width="80%"><h3>FACTURA DE VENTA</h3></td>
        <td width="20%" align="right"><h3>N°. 0012</h3></td>
    </tr>
</table>
<table border="0" width="100%">
    <tr bgcolor="silver">
        <th width="13%">NIT:</th>
        <td width="61%">890.920.043-3</td>
        <th width="17%" align="center">FECHA EMISIÓN</th>
        <th width="17%" align="center">FECHA VENCE</th>
    </tr>
    <tr bgcolor="silver">
        <th>CLIENTE:</th>
        <td>TENNIS SAS</td>
        <td align="center">2018-11-16</td>
        <td align="center">2018-11-16</td>
    </tr>
    <tr bgcolor="silver">
        <th>CIUDAD:</th>
        <td>ENVIGADO – ANTIOQUIA</td>
        <td colspan="2"></td>
                
    </tr>
    <tr bgcolor="silver">
        <th>DIRECCIÓN:</th>
        <td>CR 39  SUR   # 26 -09</td>
        <td colspan="2"></td>
        
    </tr>
    <tr bgcolor="silver">
        <th>TELÉFONO:</th>
        <td>3390000</td>
        <th>FORMA PAGO: </th>
        <td align="center">CONTADO</td>
    </tr>
</table>

<table width="100%">
<thead>
<tr style="border: 1px solid black;">
    <th align="center">CÓDIGO</th>
    <th align="center">PRODUCTO REFERENCIA</th>
    <th align="center">CANT</th>
    <th align="center">VLR UNIT</th>
    <th align="center">DSCTO</th>
    <th align="center">TOTAL</th>
</tr>
</thead>
<tbody>
<tr>
<td>2000</td>
<td class=" text-right ">-</td>
<td class=" text-right ">1000</td>
<td class="text-right">25.000.000</td>
<td class="text-right">25.000.000</td>
<td class="text-right">25.000.000</td>
</tr>
<tr>
<td>2000</td>
<td class="text-right">10</td>
<td class="text-right ">1000</td>
<td class="text-right">25.000.000</td>
<td class="text-right">25.000.000</td>
<td class="text-right">25.000.000</td>
</tr>
<tr>
<td>2000</td>
<td class=" text-right ">-</td>
<td class="text-right ">5</td>
<td class="text-right">25.000.000</td>
<td class="text-right">25.000.000</td>
<td class="text-right">25.000.000</td>
</tr>
<tr>
<td>2000</td>
<td class="text-right ">5</td>
<td class="text-right">1000</td>
<td class="text-right">25.000.000</td>
<td class="text-right">25.000.000</td>
<td class="text-right">25.000.000</td>
</tr>
</tbody>
</table>

