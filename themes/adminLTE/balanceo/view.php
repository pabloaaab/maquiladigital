<?php
//clases
use yii\bootstrap\Progress;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\Session;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\AccessControl;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */

$this->title = 'Detalle modulo';
$this->params['breadcrumbs'][] = ['label' => 'Detalle modulo', 'url' => ['proceso']];
$this->params['breadcrumbs'][] = $model->idordenproduccion;
$operarios = ArrayHelper::map(\app\models\Operarios::find()->where(['=','estado', 1])->orderBy('nombrecompleto ASC')->all(), 'id_operario', 'nombrecompleto');
?>
<div class="ordenproduccionproceso-view">
    <div class="btn-group" role="group" aria-label="...">
        <button type="button" class="btn btn-default btn"> <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'],['class' => 'btn btn-primary btn-xs']) ?></button>
        <?php if($model->estado_modulo == 0){?>
           <button type="button" class="btn btn-default btn"> <?= Html::a('<span class="glyphicon glyphicon-remove"></span> Cerrar modulo', ['cerrarmodulo', 'id' => $model->id_balanceo, 'idordenproduccion' => $idordenproduccion],['class' => 'btn btn-warning btn-xs',
            'data' => ['confirm' => 'Esta seguro de cerrar el modulo Nro: '. $model->modulo. '', 'method' => 'post']]) ?></button>
        <?php }?>
    </div>    
    <div class="panel panel-success">
        <div class="panel-heading">
            Detalle del registro
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Id')?>:</th>
                    <td><?= Html::encode($model->id_balanceo) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Nro_modulo') ?>:</th>
                    <td><?= Html::encode($model->modulo) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Orden_Produccion') ?>:</th>
                    <td><?= Html::encode($model->idordenproduccion)?> - Cliente: <?= Html::encode($model->ordenproduccion->ordenproduccion)?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Operarios') ?>:</th>
                    <td align="right"><?= Html::encode($model->cantidad_empleados) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_inicio') ?>:</th>
                    <td><?= Html::encode($model->fecha_inicio) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_terminación') ?>:</th>
                    <td><?= Html::encode($model->fecha_terminacion) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Cliente') ?>:</th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Abierto') ?>:</th>
                    <td><?= Html::encode($model->estadomodulo) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Total_segundos') ?>:</th>
                    <td><?= Html::encode($model->total_segundos) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Sam_operativo') ?>:</th>
                    <td><?= Html::encode($model->total_minutos) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Tiempo_minutos') ?>:</th>
                    <td><?= Html::encode($model->tiempo_operario) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Tiempo_Segundos') ?>:</th>
                    <td><?= Html::encode($model->tiempo_operario * 60) ?></td>
                    
                </tr>
                  <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Usuario') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Sam_balanceo') ?>:</th>
                    <td><?= Html::encode($model->tiempo_balanceo) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_creación') ?>:</th>
                    <td><?= Html::encode($model->fecha_creacion) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Observaciones') ?>:</th>
                    <td colspan="2"><?= Html::encode($model->observacion) ?></td>
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
    ]);?>
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#flujo" aria-controls="flujo" role="tab" data-toggle="tab">Operaciones <span class="badge"><?= count($flujo_operaciones) ?></span></a></li>
            <li role="presentation"><a href="#balanceo" aria-controls="balanceo" role="tab" data-toggle="tab">Balanceo <span class="badge"><?= count($balanceo_detalle) ?></span></a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="flujo">
                <div class="table-responsive">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <div class="panel panel-success">
                                <table class="table table-bordered table-hover">
                                                        <div class="panel-heading">
                                    
                                </div>
                                    <th><?= Html::dropDownList('id_operario', '', $operarios, ['class' => 'col-sm-4', 'prompt' => 'Seleccione el operario']) ?></th>
                                   
                                </table>  
                            </div>    
                         
                            <table class="table table-bordered table-hover">
                                <thead>
                                     
                                    <tr>
                                         <th scope="col" style='background-color:#B9D5CE;'><input type="checkbox" onclick="marcar(this);"/></th>
                                         <th scope="col" style='background-color:#B9D5CE;'>Operaciones</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Segundos</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Minutos</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Orden</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Proceso</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Maquina</th>
                                                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalsegundos = 0;
                                    $totalminutos = 0;
                                    $sam_balanceo = 0;
                                    foreach ($flujo_operaciones as $val):
                                        $totalminutos += $val->minutos;
                                        $totalsegundos += $val->segundos;
                                        if($val->operacion == 0){
                                           $sam_balanceo += $val->minutos; 
                                        }
                                        ?>
                                         <tr style="font-size: 85%;">
                                             <?php if($val->operacion == 0){?>
                                               <td style="width: 30px;"><input type="checkbox"  name="idproceso[]" value="<?= $val->idproceso ?>"></td>
                                             <?php }else{?>
                                               <td style="width: 30px;"><input type="checkbox" disabled="true" name="idproceso[]" value="<?= $val->idproceso ?>"></td>
                                             <?php }?>  
                                            <td ><?= $val->proceso->proceso ?></td>
                                            <td><?= $val->segundos ?></td>
                                            <td><?= $val->minutos ?></td>
                                             <td><?= $val->orden_aleatorio ?></td>
                                            <?php if($val->operacion == 0){?>
                                                 <td style='background-color:#B9D5CE;'><?= 'BALANCEO' ?></td>
                                              <?php }else{?>
                                                 <td style='background-color:#A5D3E6;'><?= 'PREPARACION' ?></td>
                                            <?php }?>   
                                             <td><?= $val->tipomaquina->descripcion ?></td>
                                           
                                            <input type="hidden" name="id_balanceo[]" value="<?= $model->id_balanceo ?>">
                                            <input type="hidden" name="id_tipo[]" value="<?= $val->id_tipo ?>">
                                            <input type="hidden" name="segundos[]" value="<?= $val->segundos ?>">
                                            <input type="hidden" name="minutos[]" value="<?= $val->minutos ?>">
                                            <input type="hidden" name="totalminutos[]" value="<?= $totalminutos ?>">
                                            <input type="hidden" name="totalsegundos[]" value="<?= $totalsegundos ?>">
                                             <input type="hidden" name="orden_aleatorio[]" value="<?= $val->orden_aleatorio ?>">
                                             
                                        </tr>
                                   <?php endforeach;
                                    $model->tiempo_balanceo = $sam_balanceo;
                                    $model->tiempo_operario = $sam_balanceo/$model->cantidad_empleados;
                                    $model->save(false);
                                   ?>
                                </tbody>  
                                <td colspan="3"></td><td style="font-size: 85%;background: #3B6495; color: #FFFFFF; width: 120px;" ><b>Segundos:</b> <?= $totalsegundos ?> <td style="font-size: 85%;background: #4B6C67; color: #FFFFFF; width: 142px;"><b>Sam_Operativo:</b> <?= $totalminutos ?></td><td style="font-size: 85%;background: #4B6C67; color: #FFFFFF; width: 142px;"><b>Sam_balanceo:</b> <?= $sam_balanceo ?></td><td colspan="1"></td>
                            </table>
                        </div>   
                        <?php
                        if($model->estado_modulo == 0){?>
                            <div class="panel-footer text-right">
                                <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm", 'name' => 'guardar']) ?>
                            </div>
                        <?php }?>
                    </div>
                </div>    
            </div>
                <!--- TERMINA EL TABS-->
            <div role="tabpanel" class="tab-pane" id="balanceo">
                <div class="table-responsive">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    
                                    <tr>
                                        <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                                         <th scope="col" style='background-color:#B9D5CE;'>Operario</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Operacion</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Orden</th>
                                        <th scope="col" style='background-color:#B9D5CE;'><span title="Minutos x operacion">Min.</span></th>
                                        <th scope="col" style='background-color:#B9D5CE;'><span title="Segundos x operacion">Seg.</span></th>
                                        <th scope="col" style='background-color:#B9D5CE;'><span title="Tiempo asignado">T. Asig.</span></th>
                                        <th scope="col" style='background-color:#B9D5CE;'><span title="Tiempo faltante/Sobrante">F/S/</span></th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Maquina</th>
                                        <th scope="col" style='background-color:#B9D5CE;'><span title="Unidades por hora">U. x Hora</span></th>
                                        <th scope="col" style='background-color:#B9D5CE;'><span title="Porcentaje inicial">%</span></th>
                                        <th scope="col" style='background-color:#B9D5CE;'></th>
                                        <th scope="col" style='background-color:#B9D5CE;'></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $total_mi = 0;
                                         foreach ($balanceo_detalle as $val):?>
                                         <tr style="font-size: 85%;">
                                            <td><?= $val->id_detalle?></td>
                                            <td><?= $val->operario->nombrecompleto ?></td>
                                            <td><?= $val->proceso->proceso ?></td>
                                             <td><?= $val->ordenamiento ?></td>
                                            <td><?= $val->minutos ?></td>
                                            <td><?= $val->segundos ?></td>
                                             <td><?= $val->total_minutos ?></td>
                                             <?php if($val->sobrante_faltante >= 0){?>
                                                 <td style="background: #088A85;"><?= $val->sobrante_faltante ?></td>
                                             <?php }else{ ?>
                                                 <td style="background: #F5BCA9;"><?= $val->sobrante_faltante ?></td>
                                             <?php }?>     
                                             <td><?= $val->tipo->descripcion ?></td>
                                             <td><?= ''.number_format( 60 /$val->minutos,2) ?></td>
                                              <td><?= $model->porcentaje ?>%</td>
                                            <?php
                                            if($model->estado_modulo == 0){?>
                                                <td style=' width: 25px;'>
                                                  <a href="<?= Url::toRoute(["balanceo/editaroperacionasignada",'id_detalle'=>$val->id_detalle,'id' => $model->id_balanceo, 'idordenproduccion' => $model->idordenproduccion]) ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                                </td> 
                                                <td style= 'width: 25px;'>
                                                  <?= Html::a('', ['eliminardetalle', 'id_detalle' => $val->id_detalle,'id'=>$model->id_balanceo,'idordenproduccion'=>$model->idordenproduccion], [
                                                      'class' => 'glyphicon glyphicon-trash',
                                                      'data' => [
                                                          'confirm' => 'Esta seguro de eliminar el registro?',
                                                          'method' => 'post',
                                                      ],
                                                  ]) ?>
                                                </td>
                                            <?php }else{ ?>
                                                <td></td>
                                                <td></td>

                                            <?php } ?>    

                                        </tr>
                                   <?php
                                        $total_mi += $val->minutos;
                                   endforeach; ?>
                                </tbody>  
                                <?php if(count($balanceo_detalle)> 0){?>
                                    <td colspan="4"></td><td style="font-size: 85%;background: #3B6495; color: #FFFFFF; width: 135px;"><b>Sam_balanceo:</b> <?= $total_mi?></td><td colspan="4"></td><td style="font-size: 85%;background: #4B6C67; color: #FFFFFF; width: 90px;"><b>Total:</b> <?= ''. number_format((60 / $total_mi) * $model->cantidad_empleados,2) ?></td><td colspan="3"></td>
                                    <?php 
                                     if($total_mi > $model->total_minutos){
                                        Yii::$app->getSession()->setFlash('warning', 'Importante: El tiempo asignado en el listado de operaciones ('. $total_mi .'), es mayor que el tiempo inicial asignado ('. $model->total_minutos .') ');
                                     } 
                                 }?>    
                            </table>
                        </div>
                                            
                            <div class="panel-footer text-right">
                                <?= Html::a('<span class="glyphicon glyphicon-exportar"></span> Excel', ['excelbalanceo', 'id_balanceo' => $model->id_balanceo, 'idordenproduccion'=>$model->idordenproduccion], ['class' => 'btn btn-primary btn-sm']);?>
           
                            </div>
                         
                    </div>
                </div>    
            </div>
       </div>  
    </div>   
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>
