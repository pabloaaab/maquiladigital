<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\ConfiguracionEps */

$this->title = 'Detalle configuración';
$this->params['breadcrumbs'][] = ['label' => 'Configuración pensión', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_eps;
?>
<div class="configuracion-eps-view">
<!--<?= Html::encode($this->title) ?>-->
     <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' =>$model->id_eps], ['class' => 'btn btn-primary btn-sm']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_eps], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_eps], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Configuración eps
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th><?= Html::activeLabel($model, 'id_eps') ?>:</th>
                    <td><?= Html::encode($model->id_eps) ?></td>
                    <th><?= Html::activeLabel($model, 'codigo_salario') ?>:</th>
                    <td><?= Html::encode($model->conceptoSalarios->nombre_concepto) ?></td>
                </tr>                
                 <tr style="font-size: 85%;">
                    <th><?= Html::activeLabel($model, 'concepto_eps') ?>:</th>
                    <td><?= Html::encode($model->concepto_eps) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentaje_empleado_eps') ?>:</th>
                    <td><?= Html::encode($model->porcentaje_empleado_eps) ?></td>
                </tr>   
                <tr style="font-size: 85%;">
                    <th><?= Html::activeLabel($model, 'porcentaje_empleador_eps') ?>:</th>
                    <td colspan="5"><?= Html::encode($model->porcentaje_empleador_eps) ?></td>
        
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