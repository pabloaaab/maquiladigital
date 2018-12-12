<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Detalle Producto';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idproducto;
?>
<div class="producto-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idproducto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idproducto], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idproducto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Producto
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'idproducto') ?>:</th>
                    <td><?= Html::encode($model->idproducto) ?></td>
                    <th><?= Html::activeLabel($model, 'producto') ?>:</th>
                    <td><?= Html::encode($model->prendatipo->prenda).'-'.Html::encode($model->prendatipo->talla->talla).'-'.Html::encode($model->prendatipo->talla->sexo) ?></td>
                    <th><?= Html::activeLabel($model, 'codigoproducto') ?>:</th>
                    <td><?= Html::encode($model->codigoproducto) ?></td>                    
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechaproceso') ?>:</th>
                    <td><?= Html::encode($model->fechaproceso) ?></td>
                    <th><?= Html::activeLabel($model, 'cantidad') ?>:</th>
                    <td><?= Html::encode($model->cantidad) ?></td>
                    <th><?= Html::activeLabel($model, 'stock') ?>:</th>
                    <td><?= Html::encode($model->stock) ?></td>
                </tr>
                <tr>                    
                    <th><?= Html::activeLabel($model, 'idtipo') ?>:</th>
                    <td><?= Html::encode($model->ordenproducciontipo->tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'idcliente') ?>:</th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'costoconfeccion') ?>:</th>
                    <td align="right"><?= Html::encode('$ '.number_format($model->costoconfeccion,0)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'idprendatipo') ?>:</th>
                    <td><?= Html::encode($model->prendatipo->prenda) ?></td>
                    <th><?= Html::activeLabel($model, 'usuariosistema') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th><?= Html::activeLabel($model, 'vlrventa') ?>:</th>
                    <td align="right"><?= Html::encode('$ '.number_format($model->vlrventa,0)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'observacion') ?>:</th>
                    <td colspan="5"><?= Html::encode($model->observacion) ?></td>
                </tr>
            </table>
        </div>
    </div>    
</div>
