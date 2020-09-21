<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Periodopago */

$this->title = 'Detalle periodo';
$this->params['breadcrumbs'][] = ['label' => 'Periodo de pago', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_periodo_pago;

?>
<div class="periodo_pago-view">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->id_periodo_pago], ['class' => 'btn btn-primary btn-sm']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_periodo_pago], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_periodo_pago], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-success">
        <div class="panel-heading">
            Periodo de Pago
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th><?= Html::activeLabel($model, 'Id_periodo_pago') ?>:</th>
                    <td><?= Html::encode($model->id_periodo_pago) ?></td>
                    <th><?= Html::activeLabel($model, 'Nombre_periodo') ?>:</th>
                    <td><?= Html::encode($model->nombre_periodo) ?></td>
                    <th><?= Html::activeLabel($model, 'Dias') ?>:</th>
                    <td><?= Html::encode($model->dias) ?></td> 
                    <th><?= Html::activeLabel($model, 'Limite_horas') ?>:</th>
                    <td><?= Html::encode($model->limite_horas) ?></td>
                    <th><?= Html::activeLabel($model, 'Continuar') ?>:</th>
                    <td><?= Html::encode($model->continua) ?></td>
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
