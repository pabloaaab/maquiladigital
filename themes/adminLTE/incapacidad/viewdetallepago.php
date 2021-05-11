<?php

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

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Pago de incapacidad';
$this->params['breadcrumbs'][] = ['label' => 'Pago de incapacidad', 'url' => ['indexpagoincapacidad']];
$this->params['breadcrumbs'][] = $model->id_pago;
?>
<div class="incapacidad-viewdetallepago">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['indexpagoincapacidad'], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php if ($model->autorizado == 0){ 
            echo Html::a('<span class="glyphicon glyphicon-ok"></span> Autorizar', ['autorizado', 'id_pago' => $model->id_pago], ['class' => 'btn btn-default btn-sm'])?>  
        <?php }else {
           echo Html::a('<span class="glyphicon glyphicon-remove"></span> Desautorizar', ['autorizado', 'id_pago' => $model->id_pago], ['class' => 'btn btn-default btn-sm']);
           echo Html::a('<span class="glyphicon glyphicon-check"></span> Generar', ['generarconsecutivo', 'id_pago' => $model->id_pago], ['class' => 'btn btn-default btn-sm', 
               'data' => ['confirm' => 'Esta seguro de cerrar este pago de incapacidades?', 'method' => 'post']]);
        }?>  
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Detalle incapacidad
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style='font-size: 85%;'>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Id_Pago') ?>:</th>
                    <td><?= Html::encode($model->id_pago) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Nro_Pago') ?>:</th>
                    <td><?= Html::encode($model->nro_pago) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Eps') ?>:</th>
                    <td><?= Html::encode($model->entidadSalud->entidad) ?></td>  
                </tr>   
                 <tr style='font-size: 85%;'>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'fecha_Pago') ?>:</th>
                    <td><?= Html::encode($model->fecha_pago_entidad) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'fecha_Registro') ?>:</th>
                    <td><?= Html::encode($model->fecha_registro) ?></td>    
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Banco') ?>:</th>
                    <td><?= Html::encode($model->banco->entidad) ?></td>
                </tr>          
                 <tr style='font-size: 85%;'>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Usuario') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Observacion') ?>:</th>
                    <td><?= Html::encode($model->observacion) ?></td>    
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Valor_Pagado') ?>:</th>
                    <td style="align-content: right;"><?= Html::encode(''.number_format($model->valor_pago,0)) ?></td>
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
    <div class="table-responsive">
        <div class="panel panel-success ">
            <div class="panel-heading">
                Registros: <span class="badge"><?= count($detallepago) ?></span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead >
                        <tr style='font-size: 85%;'>
                            <td scope="col" align="center" style='background-color:#B9D5CE;'><b>Id</b></td>                        
                            <td scope="col" align="center" style='background-color:#B9D5CE;'><b>Codigo</b></td>                        
                            <td scope="col" align="center" style='background-color:#B9D5CE;'><b>Numero</b></td>
                            <td scope="col" align="center" style='background-color:#B9D5CE;'><b>Tipo incapacidad</b></td>
                            <th scope="col" align="center" style='background-color:#B9D5CE;'>Abono</th>
                            <th scope="col" align="center" style='background-color:#B9D5CE;'>Vr. adeudado</th>                        
                            <td scope="col" align="center" style='background-color:#B9D5CE;'><b>Saldo</b></td>  
                            <td scope="col" align="center" style='background-color:#B9D5CE;'>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detallepago as $val): ?>
                        <tr style='font-size: 85%;'>
                            <td><?= $val->id ?></td>
                            <td><?= $val->id_incapacidad ?></td>
                            <td><?= $val->numero ?></td>
                            <td><?= $val->codigoIncapacidad->nombre ?></td>
                            <?php if($model->autorizado == 0){?>   
                               <td><input type="text" name="vlrabono[]" value="<?= $val->abono ?>" required></td>
                            <?php }else {?>
                                <td><?= $val->abono ?></td>
                            <?php }?>    
                            <td align="right"><?= ''.number_format($val->vlr_pago_administradora,0)?></td>
                            <td><?= ''.number_format($val->vlr_saldo,0) ?></td>
                             <input type="hidden" name="actualizar_detalle[]" value="<?= $val->id ?>">
                             <?php if($model->autorizado == 0){?>        
                                <td style="width: 25px;">
                                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ', ['eliminardetalle', 'id_pago' => $model->id_pago, 'id_detalle' => $val->id], [
                                                 'class' => '',
                                                 'data' => [
                                                     'confirm' => 'Esta seguro de eliminar el registro?',
                                                     'method' => 'post',
                                                 ],
                                             ])
                                             ?>
                               </td>
                            <?php }else{ ?>
                                      <td></td>
                            <?php } ?>      
                        </tr>
                    <?php endforeach; ?>
                   </tbody>      
                </table>
             <?php if($model->autorizado == 0){?>   
                </div>            
                    <div class="panel-footer text-right">                    
                         <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo detalle', ['incapacidad/nuevodetalleincapacidad', 'id_eps' => $model->id_entidad_salud,'id_pago' =>$model->id_pago], ['class' => 'btn btn-success btn-sm']) ?>                    
                        <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar", ["class" => "btn btn-primary btn-sm",]) ?>
                </div>
             <?php }?>
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