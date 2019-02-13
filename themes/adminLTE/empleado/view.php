<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */

$this->title = 'Detalle Empleado';
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_empleado;
?>
<div class="empleado-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_empleado], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_empleado], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Banco
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_empleado') ?>:</th>
                    <td><?= Html::encode($model->id_empleado) ?></td>
                    <th><?= Html::activeLabel($model, 'id_empleado_tipo') ?>:</th>
                    <td><?= Html::encode($model->tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'identificacion') ?>:</th>
                    <td><?= Html::encode($model->identificacion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'dv') ?>:</th>
                    <td><?= Html::encode($model->dv) ?></td>
                    <th><?= Html::activeLabel($model, 'nombrecorto') ?>:</th>
                    <td><?= Html::encode($model->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'direccion') ?>:</th>
                    <td><?= Html::encode($model->direccion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechaingreso') ?>:</th>
                    <td><?= Html::encode($model->fechaingreso) ?></td>
                    <th><?= Html::activeLabel($model, 'telefono') ?>:</th>
                    <td><?= Html::encode($model->telefono) ?></td>
                    <th><?= Html::activeLabel($model, 'email') ?>:</th>
                    <td><?= Html::encode($model->email) ?></td>                    
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fecharetiro') ?>:</th>
                    <td><?= Html::encode($model->fecharetiro) ?></td>
                    <th><?= Html::activeLabel($model, 'iddepartamento') ?>:</th>
                    <td><?= Html::encode($model->departamento->departamento) ?></td>
                    <th><?= Html::activeLabel($model, 'idmunicipio') ?>:</th>
                    <td><?= Html::encode($model->municipio->municipio) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'observacion') ?>:</th>
                    <td colspan="3"><?= Html::encode($model->observacion) ?></td>
                    <th><?= Html::activeLabel($model, 'contrato') ?>:</th>
                    <td><?= Html::encode($model->contratado) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_empleado',
            'id_empleado_tipo',
            'identificacion',
            'dv',
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'nombrecorto',
            'direccion',
            'telefono',
            'celular',
            'email:email',
            'iddepartamento',
            'idmunicipio',
            'contrato',
            'observacion:ntext',
            'fechaingreso',
            'fecharetiro',
        ],
    ]) ?>-->

</div>
