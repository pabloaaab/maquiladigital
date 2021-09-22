<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\CantidadPrendaTerminadas;
use app\models\Balanceo;
use app\models\Horario;
use app\models\Ordenproduccion;

$cantidad_prendas= CantidadPrendaTerminadas::find()->where(['=','id_balanceo', $id_balanceo])->all(); 
$unidades= CantidadPrendaTerminadas::find()->where(['=','id_balanceo', $id_balanceo])->groupBy('fecha_entrada')->all(); 
$balanceo = Balanceo::find()->where(['=','id_balanceo', $id_balanceo])->one();
$horario = Horario::findOne(1);
$calculo = 0;
$calculo = round((60/$balanceo->tiempo_balanceo) *($horario->total_horas));
$orden_produccion = Ordenproduccion::findOne($orden->idordenproduccion); 
?>
<?php $form = ActiveForm::begin([

    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
]); ?>
<div class="programacion-nomina-view">

 <!--<h1><?= Html::encode($this->title) ?></h1>-->
   
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">
        <div class="panel panel-success">
            <div class="panel-heading">
               Modulo
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <tr style ='font-size:95%;'>
                        <th><?= Html::activeLabel($balanceo, 'Nro_Balanceo') ?>:</th>
                        <td><?= Html::encode($balanceo->id_balanceo) ?></td>
                        <th><?= Html::activeLabel($balanceo, 'fecha_inicio') ?>:</th>
                        <td><?= Html::encode($balanceo->fecha_inicio) ?></td>
                         <th><?= Html::activeLabel($balanceo, 'fecha_terminacion') ?></th>
                        <td><?= Html::encode($balanceo->fecha_terminacion) ?></td>
                        <th><?= Html::activeLabel($balanceo, 'Minutos_Proveedor') ?>:</th>
                        <td><?= Html::encode($orden_produccion->duracion) ?></td>
                        </tr>   
                    <tr style ='font-size:95%;'>
                           <th><?= Html::activeLabel($balanceo, 'Minutos_Confección') ?>:</th>
                        <td><?= Html::encode($balanceo->total_minutos) ?></td>
                         <th><?= Html::activeLabel($balanceo, 'Minutos_Balanceo') ?>:</th>
                        <td><?= Html::encode($balanceo->tiempo_balanceo) ?></td>
                        <th><?= Html::activeLabel($balanceo, 'Tiempo_Operario') ?>:</th>
                         <td><?= Html::encode($balanceo->tiempo_operario) ?></td>
                        <th><?= Html::activeLabel($balanceo, 'Usuario') ?>:</th>
                        <td colspan="5"><?= Html::encode($balanceo->usuariosistema) ?></td>
                    </tr>   
                </table>
            </div>
        </div>
    </div>
   <!-- COMIENZA EL TAB-->
   <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#listado" aria-controls="listado" role="tab" data-toggle="tab">Listado </a></li>
            <li role="presentation"><a href="#eficiencia" aria-controls="eficiencia" role="tab" data-toggle="tab">Eficiencia <span class="badge"><?= count($unidades)?></span></a></li>
        </ul>
        <div class="tab-content" >
            <div role="tabpanel" class="tab-pane active" id="listado">
                <div class="table-responsive">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr align="center" >
                                        <th scope="col" style='background-color:#B9D5CE;'>Referencia</th>   
                                        <th scope="col" style='background-color:#B9D5CE;'>Nro Unidades</th>  
                                        <th scope="col" style='background-color:#B9D5CE;'>Facturación</th>  
                                        <th scope="col" style='background-color:#B9D5CE;'>Fecha confección</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Fecha/hora Confección</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Usuario</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Observación</th>                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($cantidad_prendas as $val):?>
                                        <tr style ='font-size:100%;'>
                                            <td><?= $val->detalleorden->productodetalle->prendatipo->prenda. ' / '. $val->detalleorden->productodetalle->prendatipo->talla->talla?></td>
                                            <td><?= $val->cantidad_terminada ?></td>  
                                            <td align="right"><?= ''. number_format($val->detalleorden->vlrprecio * $val->cantidad_terminada,0) ?></td>
                                            <td ><?= $val->fecha_entrada ?></td>
                                            <td ><?= $val->fecha_procesada ?></td>
                                            <td ><?= $val->usuariosistema ?></td>
                                            <td ><?= $val->observacion ?></td>
                                        </tr>
                                    <?php endforeach;?>
                               </tbody>
                            </table>
                        </div>    
                   </div> 
                </div>
            </div>
        <!-- TERMINA TAB-->
        <div role="tabpanel" class="tab-pane" id="eficiencia">
                <div class="table-responsive">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" style='background-color:#B9D5CE; width: 15%'>Fecha confección</th>   
                                        <th scope="col" style='background-color:#B9D5CE; width: 15%'>Unidades Confeccionadas</th>
                                        <th scope="col" style='background-color:#B9D5CE; width: 15%'>Nro Operarios </th>
                                        <th scope="col" style='background-color:#B9D5CE; width: 15%'>Unidad x Operario(100%)</th>
                                        <th scope="col" style='background-color:#B9D5CE; width: 15%'>Cantidad x Dia(100%)</th> 
                                        <th scope="col" style='background-color:#B9D5CE; width: 15%'>Cumplimiento</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $fecha_entrada = 0;
                                    $suma = 0;
                                    $total = 0;
                                    $cumplimiento = 0;
                                    $aux1 = 0; $aux2 = 0; $calculo_dia = 0;
                                    $con = 0;
                                     foreach ($unidades as $eficiencia):
                                           $con += 1;
                                           $fecha_entrada = $eficiencia->fecha_entrada;
                                           $total = 0;
                                           $var_1 = CantidadPrendaTerminadas::find()->where(['=','fecha_entrada', $fecha_entrada])->andWhere(['=','id_balanceo', $balanceo->id_balanceo])->all();
                                           foreach ($var_1 as $dato_1):
                                                    $total +=  1;
                                           endforeach;
                                           if($total == 1){
                                             $suma = 0;  
                                             $var_2 = CantidadPrendaTerminadas::find()->where(['=','fecha_entrada', $fecha_entrada])->andWhere(['=','id_balanceo', $balanceo->id_balanceo])->one();
                                             $calculo_dia = round($calculo * $eficiencia->nro_operarios);
                                             $suma =   $eficiencia->cantidad_terminada;
                                             $cumplimiento = round(($suma * 100)/$calculo_dia,2);
                                             $aux1 += $cumplimiento;?>
                                             <tr>
                                                <td ><?= $eficiencia->fecha_entrada ?></td>
                                                <td ><?= $suma ?></td>
                                                <td ><?= $eficiencia->nro_operarios ?></td>
                                                <td align="right"><?= $calculo ?></td>
                                                <td align="right"><?= $calculo_dia ?></td>
                                                <td align="right"><?= $cumplimiento ?>%</td> 
                                             </tr>
                                           <?php 
                                           }else{
                                                    $suma = 0;
                                                    $var_3 = CantidadPrendaTerminadas::find()->where(['=','fecha_entrada', $fecha_entrada])->andWhere(['=','id_balanceo', $balanceo->id_balanceo])->all();
                                                    foreach ($var_3 as $dato):    
                                                    $suma += $dato->cantidad_terminada;
                                                    endforeach;
                                                    $calculo_dia = round($calculo * $eficiencia->nro_operarios);
                                                    $cumplimiento = round(($suma * 100)/$calculo_dia,2);
                                                    $aux2 += $cumplimiento;?>
                                                  <tr>
                                                     <td ><?= $eficiencia->fecha_entrada ?></td>
                                                     <td ><?= $suma ?></td>
                                                      <td ><?= $eficiencia->nro_operarios ?></td>
                                                     <td align="right"><?= $calculo ?></td>
                                                     <td align="right"><?= $calculo_dia ?></td>
                                                     <td align="right"><?= $cumplimiento ?>%</td>
                                                  </tr>
                                           <?php
                                           }
                                    endforeach;
                                    $efectividad = round(($aux1 + $aux2) / $con,2) ;      
                                           
                                    ?>
                                    <td colspan="5"><td style="font-size: 100%;background: #4B6C67; color: #FFFFFF; width: 142px;" align="right"><b>Eficiencia modulo:</b> <?= $efectividad ?>%</td>
                               </tbody>
                            </table>
                        </div>    
                   </div> 
                </div>
            </div>
            <!---TERMINA TAB-->
    </div> 
</div>
<?php $form->end() ?> 

    


