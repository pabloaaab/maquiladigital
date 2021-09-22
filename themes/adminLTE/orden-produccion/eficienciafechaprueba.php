<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\CantidadPrendaTerminadas;
use app\models\Balanceo;
use app\models\Horario;
use app\models\Ordenproduccion;

$cantidad_prendas = CantidadPrendaTerminadas::find()->where(['=', 'id_balanceo', $id_balanceo])->all();
$balanceo = Balanceo::find()->where(['=', 'id_balanceo', $id_balanceo])->one();
$orden_produccion = Ordenproduccion::findOne($idordenproduccion);

?>
<div class="orden-produccion-view">

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
                <table class="table table-bordered table-hover">
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
   
    <div class="table-responsive">
        <div class="panel panel-success ">
            <div class="panel-heading">
                Registros: <span class="badge"><?= count($cantidad_prendas) ?></span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
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
                            <tr style ='font-size:90%;'>
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


    


