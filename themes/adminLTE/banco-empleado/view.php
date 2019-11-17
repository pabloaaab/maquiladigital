<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\BancoEmpleado */

$this->title = 'Detalle Banco Empleado';
$this->params['breadcrumbs'][] = ['label' => 'Bancos Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_banco_empleado;
?>
<div class="banco-empleado-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->id_banco_empleado], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_banco_empleado], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_banco_empleado], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Banco Empleado
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_banco_empleado') ?>:</th>
                    <td><?= Html::encode($model->id_banco_empleado) ?></td>
                    <th><?= Html::activeLabel($model, 'banco') ?>:</th>
                    <td><?= Html::encode($model->banco) ?></td>
                    <th><?= Html::activeLabel($model, 'codigo_interfaz') ?>:</th>
                    <td><?= Html::encode($model->codigo_interfaz) ?></td>                    
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