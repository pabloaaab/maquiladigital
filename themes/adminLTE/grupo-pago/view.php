<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoPago */

$this->title = 'Detalle Grupo Pago';
$this->params['breadcrumbs'][] = ['label' => 'Grupos de Pago', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_grupo_pago;
$view = 'grupo_pago';
?>
<div class="grupo-pago-view">
<!--<?= Html::encode($this->title) ?>-->
      <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->id_grupo_pago], ['class' => 'btn btn-primary btn-sm']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_grupo_pago], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_grupo_pago], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Grupo de Pago
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th><?= Html::activeLabel($model, 'id_grupo_pago') ?>:</th>
                    <td><?= Html::encode($model->id_grupo_pago) ?></td>
                    <th><?= Html::activeLabel($model, 'grupo_pago') ?>:</th>
                    <td><?= Html::encode($model->grupo_pago) ?></td>
                    <th><?= Html::activeLabel($model, 'id_periodo_pago') ?>:</th>
                    <td><?= Html::encode($model->periodoPago->nombre_periodo) ?></td>
                    
                </tr>                
                 <tr style="font-size: 85%;">
                    <th><?= Html::activeLabel($model, 'iddepartamento') ?>:</th>
                    <td><?= Html::encode($model->departamento->departamento) ?></td>
                    <th><?= Html::activeLabel($model, 'idmunicipio') ?>:</th>
                    <td><?= Html::encode($model->municipio->municipio) ?></td>
                    <th><?= Html::activeLabel($model, 'id_sucursal') ?>:</th>
                     <td><?= Html::encode($model->sucursalpila->sucursal) ?></td>
                  
                   
                </tr>   
                <tr style="font-size: 85%;">
                    <th><?= Html::activeLabel($model, 'ultimo_pago_prima') ?>:</th>
                    <td><?= Html::encode($model->ultimo_pago_prima) ?></td>
                    <th><?= Html::activeLabel($model, 'ultimo_pago_cesantia') ?>:</th>
                    <td><?= Html::encode($model->ultimo_pago_cesantia) ?></td>
                    <th><?= Html::activeLabel($model, 'limite_devengado') ?>:</th>
                    <td><?= Html::encode('$ ' .number_format($model->limite_devengado,0)) ?></td>
                </tr>  
                <tr style="font-size: 85%;">
                    <th><?= Html::activeLabel($model, 'dias_pago') ?>:</th>
                    <td><?= Html::encode($model->dias_pago) ?></td>
                    <th><?= Html::activeLabel($model, 'fecha_creacion') ?>:</th>
                    <td><?= Html::encode($model->fecha_creacion ) ?></td>
                    <th><?= Html::activeLabel($model, 'activo') ?>:</th>
                    <td><?= Html::encode($model->activo) ?></td>  
                </tr>    
                <tr style="font-size: 85%;">
                    <th><?= Html::activeLabel($model, 'observacion') ?>:</th>
                    <td colspan="5"><?= Html::encode($model->observacion) ?></td>                    
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
    <?php ActiveForm::end(); ?>
</div>