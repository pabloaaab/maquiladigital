<?php
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\bootstrap\ActiveForm;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use app\models\Balanceo;
use app\models\Ordenproduccion;
$this->title = 'Detalle del reproceso';
$this->params['breadcrumbs'][] = ['label' => 'Reproceso'];
$this->params['breadcrumbs'][] = $id_balanceo;

//vectores
$detalle_orden = app\models\Ordenproducciondetalle::find()->where(['=','idordenproduccion', $id])->all(); 

$balanceo = Balanceo::find()->where(['=','id_balanceo', $id_balanceo])->one();
$orden_produccion = Ordenproduccion::findOne($id); 
?>

<div class="orden-produccion-view">

 <!--<?= Html::encode($this->title) ?>-->
   
    <div class="panel panel-success">
        <div class="panel-heading">
            Modulo
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover" width="100%">
                <tr style ='font-size:95%;'>
                    <th><?= Html::activeLabel($balanceo, 'Nro_Balanceo') ?>:</th>
                    <td><?= Html::encode($balanceo->id_balanceo) ?> - ( <?= Html::encode($id) ?>)</td>
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
    <?php $form = ActiveForm::begin([

    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
  ]); ?>
   <!-- COMIENZA EL TAB-->
   <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#balanceo" aria-controls="balanceo" role="tab" data-toggle="tab">Balanceo <span class="badge"><?= count($balanceo_detalle)?></span> </a></li>
        </ul>
        <div class="tab-content" >
              <div role="tabpanel" class="tab-pane active" id="balanceo">
                <div class="table-responsive">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    
                                    <tr>
                                        <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Operario</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Operaciones</th>
                                        <th scope="col" style='background-color:#B9D5CE; width: 70px;'>Cant.</th>    
                                        <?php 
                                        if (count($detalle_orden)== 2 ){?>
                                          <th scope="col" style='background-color:#B9D5CE; text-align: center;'  colspan="2">Tallas</th>
                                          <th scope="col" style='background-color:#B9D5CE;'>Observación</th>
                                        <?php } ?>
                                           <?php if (count($detalle_orden)== 3 ){?>
                                          <th scope="col" style='background-color:#B9D5CE; text-align: center;'  colspan="3">Tallas</th>
                                          <th scope="col" style='background-color:#B9D5CE;'>Observación</th>
                                        <?php } ?>
                                           <?php if (count($detalle_orden)== 4 ){?>
                                          <th scope="col" style='background-color:#B9D5CE; text-align: center;'  colspan="4">Tallas</th>
                                          <th scope="col" style='background-color:#B9D5CE;'>Observación</th>
                                        <?php } ?>
                                           <?php if (count($detalle_orden)== 5 ){?>
                                          <th scope="col" style='background-color:#B9D5CE; text-align: center;'  colspan="5">Tallas</th>
                                          <th scope="col" style='background-color:#B9D5CE;'>Observación</th>
                                        <?php } ?>
                                           <?php if (count($detalle_orden)== 6 ){?>
                                          <th scope="col" style='background-color:#B9D5CE; text-align: center;'  colspan="6">Tallas</th>
                                          <th scope="col" style='background-color:#B9D5CE;'>Observación</th>
                                        <?php } ?>
                                          <?php if (count($detalle_orden)== 7 ){?>
                                          <th scope="col" style='background-color:#B9D5CE; text-align: center;'  colspan="7">Tallas</th>
                                          <th scope="col" style='background-color:#B9D5CE;'>Observación</th>
                                        <?php } ?> 
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $talla = 'Talla:';
                                    foreach ($balanceo_detalle as $val):?>
                                            <tr style="font-size: 85%;">
                                               <td><?= $val->id_detalle?></td>
                                               <td><?= $val->operario->nombrecompleto ?></td>
                                               <td><?= $val->proceso->proceso ?></td>
                                               <td ><input type="text" style="width: 40px;" name="cantidad[]" value="0" required></td>
                                               <?php foreach ($detalle_orden as $talla):?>
                                                       <td><input type="checkbox"  name="id_talla" value="<?=  $talla->idproductodetalle?>">Talla (<?=  $talla->productodetalle->prendatipo->talla->talla?>)</td>
                                                <?php endforeach;?>   
                                                       <td style="width: 50px;"><input type="text" name="observacion[]" value="" maxlength="27" ></td>       
                                                       <input type="hidden" name="iddetalle[]" value="<?= $val->id_detalle ?>">
                                             </tr>
                                    <?php
                                    endforeach; ?>
                                </tbody>  
                            </table>
                        </div>
                           <?php if($balanceo->estado_modulo == 0){?>
                            <div class="panel-footer text-right">

                                <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Enviar", ["class" => "btn btn-success btn-sm"]) ?>
                            </div>
                        <?php }?>                 
                         
                    </div>
                </div>    
            </div>
        
    </div> 
</div>
<?php $form->end() ?> 

    


