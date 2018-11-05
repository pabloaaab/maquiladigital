<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */

$this->title = 'Detalle Recibo de Caja';
$this->params['breadcrumbs'][] = ['label' => 'Recibos de Caja', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idrecibo;
?>
<div class="recibocaja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idrecibo], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->estado == 0) { ?>
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idrecibo], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idrecibo], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Esta seguro de eliminar el registro?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Autorizar', ['estado', 'id' => $model->idrecibo], ['class' => 'btn btn-default']); }
        else {
            echo Html::a('<span class="glyphicon glyphicon-remove"></span> Desautorizar', ['estado', 'id' => $model->idrecibo], ['class' => 'btn btn-default']);
        }
        ?>
    </p>

    <div class="panel panel-success">
        <div class="panel-heading">
            <h5><?= Html::encode($this->title) ?></h5>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'idrecibo') ?>:</th>
                    <td><?= Html::encode($model->idrecibo) ?></td>
                    <th><?= Html::activeLabel($model, 'Cliente') ?>:</th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'idtiporecibo') ?>:</th>
                    <td><?= Html::encode($model->tiporecibo->concepto) ?></td>
                </tr>

                <tr>
                    <th><?= Html::activeLabel($model, 'fecharecibo') ?>:</th>
                    <td><?= Html::encode($model->fecharecibo) ?></td>
                    <th><?= Html::activeLabel($model, 'Municipio') ?>:</th>
                    <td><?= Html::encode($model->municipio->municipioCompleto) ?></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechapago') ?>:</th>
                    <td><?= Html::encode($model->fechapago) ?></td>
                    <th><?= Html::activeLabel($model, 'usuariosistema') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th><?= Html::activeLabel($model, 'valorpagado') ?>:</th>
                    <td align="right"><?= Html::encode('$ '.number_format($model->valorpagado)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'observacion') ?>:</th>
                    <td colspan="5"><?= Html::encode($model->observacion) ?></td>

                </tr>
            </table>
        </div>
    </div>

    <?=  $this->render('detalle', ['modeldetalles' => $modeldetalles, 'modeldetalle' => $modeldetalle, 'idrecibo' => $model->idrecibo, 'idcliente' => $model->idcliente,'estado' => $model->estado]); ?>
</div>
