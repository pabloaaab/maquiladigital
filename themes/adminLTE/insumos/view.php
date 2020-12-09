<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproducciontipo */

$this->title = 'Detalle insumos';
$this->params['breadcrumbs'][] = ['label' => 'Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_insumos;
?>
<div class="insumos-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->id_insumos], ['class' => 'btn btn-primary btn-sm']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_insumos], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_insumos], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="panel panel-success">
        <div class="panel-heading">
            Orden de Producción tipo
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Id') ?></th>
                    <td><?= Html::encode($model->id_insumos) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Codigo') ?></th>
                    <td><?= Html::encode($model->codigo_insumo) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Descripcion') ?></th>
                    <td><?= Html::encode($model->descripcion) ?></td>
                </tr>
                  <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'id_tipo_medida') ?></th>
                    <td><?= Html::encode($model->tipomedida->medida) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_entrada') ?>:</th>
                    <td><?= Html::encode($model->fecha_entrada) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'precio_unitario') ?>:</th>
                     <td style="text-align: right"><?= Html::encode('$'.number_format($model->precio_unitario,0)) ?></td>
                </tr>       
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'activo') ?></th>
                    <td><?= Html::encode($model->estado) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Usuario') ?>:</th>
                     <td colspan="4"><?= Html::encode($model->usuariosistema) ?></td>
                </tr>           
            </table>
        </div>
    </div>

</div>
