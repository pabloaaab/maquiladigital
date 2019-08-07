<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fichatiempocalificacion */

$this->title = 'Detalle Ficha Tiempo Calificación';
$this->params['breadcrumbs'][] = ['label' => 'Colores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="fichatiempocalificacion-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Ficha Tiempo Calificación
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id') ?>:</th>
                    <td><?= Html::encode($model->id) ?></td>
                    <th><?= Html::activeLabel($model, 'rango1') ?>:</th>
                    <td><?= Html::encode($model->rango1) ?></td>
                    <th><?= Html::activeLabel($model, 'rango2') ?>:</th>
                    <td><?= Html::encode($model->rango2) ?></td>
                    <th><?= Html::activeLabel($model, 'observacion') ?>:</th>
                    <td><?= Html::encode($model->observacion) ?></td>
                </tr>                                                                
            </table>
        </div>
    </div>
    <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'rango1',
            'rango2',
            'observacion',
        ],
    ]) ?>-->

</div>
