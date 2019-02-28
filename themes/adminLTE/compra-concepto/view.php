<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CompraConcepto */

$this->title = 'Detalle CompraConcepto';
$this->params['breadcrumbs'][] = ['label' => 'Conceptos Compra', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_compra_concepto;
?>
<div class="CompraConcepto-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_compra_concepto], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_compra_concepto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
           Concepto Compra
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_compra_concepto') ?>:</th>
                    <td><?= Html::encode($model->id_compra_concepto) ?></td>
                    <th><?= Html::activeLabel($model, 'concepto') ?>:</th>
                    <td><?= Html::encode($model->concepto) ?></td>
                    <th><?= Html::activeLabel($model, 'id_compra_tipo') ?>:</th>
                    <td><?= Html::encode($model->compraTipo->tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'base_retencion') ?>:</th>
                    <td><?= Html::encode($model->base_retencion) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentaje_iva') ?>:</th>
                    <td><?= Html::encode($model->porcentaje_iva) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentaje_retefuente') ?>:</th>
                    <td><?= Html::encode($model->porcentaje_retefuente) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentaje_reteiva') ?>:</th>
                    <td><?= Html::encode($model->porcentaje_reteiva) ?></td>
                    <th><?= Html::activeLabel($model, 'base_aiu') ?>:</th>
                    <td><?= Html::encode($model->base_aiu) ?></td>                    
                </tr>                                                
            </table>
        </div>
    </div>
    

</div>

