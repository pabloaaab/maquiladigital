<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgresoTipo */

$this->title = 'Detalle Comprobante Egreso Tipo';
$this->params['breadcrumbs'][] = ['label' => 'Comprobante Egresos Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_comprobante_egreso_tipo;
?>
<div class="comprobante-egreso-tipo-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_comprobante_egreso_tipo], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_comprobante_egreso_tipo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Comprobante Egreso Tipo
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_comprobante_egreso_tipo') ?>:</th>
                    <td><?= Html::encode($model->id_comprobante_egreso_tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'concepto') ?>:</th>
                    <td><?= Html::encode($model->concepto) ?></td>
                    <th><?= Html::activeLabel($model, 'activo') ?>:</th>
                    <td><?= Html::encode($model->estado) ?></td>
                </tr>                                                
            </table>
        </div>
    </div>
    

</div>
