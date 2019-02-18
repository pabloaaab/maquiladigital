<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientoProduccion */

$this->title = 'Detalle Seguimiento Produccion';
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos Produccion', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_seguimiento_produccion;
?>
<div class="seguimiento-produccion-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_seguimiento_produccion], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_seguimiento_produccion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Seguimiento Producción
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_seguimiento_produccion') ?>:</th>
                    <td><?= Html::encode($model->id_seguimiento_produccion) ?></td>
                    <th><?= Html::activeLabel($model, 'fecha_inicio_produccion') ?>:</th>
                    <td><?= Html::encode($model->fecha_inicio_produccion.' - '.$model->hora_inicio) ?></td>                    
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'idcliente') ?>:</th>
                    <td><?= Html::encode($model->idcliente) ?></td>
                    <th><?= Html::activeLabel($model, 'idordenproduccion') ?>:</th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>                   
                </tr>                                               
            </table>
        </div>
    </div>
    <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idbanco',
            'nitbanco',
            'entidad',
            'direccionbanco',
            'telefonobanco',
            'producto',
            'numerocuenta',
            'nitmatricula',
            'activo',
        ],
    ]) ?>-->

</div>
