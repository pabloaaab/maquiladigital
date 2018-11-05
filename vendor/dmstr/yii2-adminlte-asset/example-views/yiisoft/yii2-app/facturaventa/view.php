<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Ordenproducciondetalle;
use yii\helpers\Url;
use yii\web\Session;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventa */

$this->title = 'Detalle Factura de Venta';
$this->params['breadcrumbs'][] = ['label' => 'Facturas de ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idfactura;
?>
<div class="facturaventa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idfactura], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->estado == 0) { ?>
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idfactura], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idfactura], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Esta seguro de eliminar el registro?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Autorizar', ['estado', 'id' => $model->idfactura], ['class' => 'btn btn-default']); }
        else {
            echo Html::a('<span class="glyphicon glyphicon-remove"></span> Desautorizar', ['estado', 'id' => $model->idfactura], ['class' => 'btn btn-default']);
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
                    <th><?= Html::activeLabel($model, 'idfactura') ?></th>
                    <td><?= Html::encode($model->idfactura) ?></td>
                    <th><?= Html::activeLabel($model, 'Cliente') ?></th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'idordenproduccion') ?></th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'nrofactura') ?></th>
                    <td><?= Html::encode($model->nrofactura) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentajeiva') ?></th>
                    <td><?= Html::encode($model->porcentajeiva) ?></td>
                    <th><?= Html::activeLabel($model, 'impuestoiva') ?></th>
                    <td><?= Html::encode('$ '.number_format($model->impuestoiva)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechainicio') ?></th>
                    <td><?= Html::encode($model->fechainicio) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentajefuente') ?></th>
                    <td><?= Html::encode($model->porcentajefuente) ?></td>
                    <th><?= Html::activeLabel($model, 'retencionfuente') ?></th>
                    <td><?= Html::encode('$ '.number_format($model->retencionfuente)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechavcto') ?></th>
                    <td><?= Html::encode($model->fechavcto) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentajereteiva') ?></th>
                    <td><?= Html::encode($model->porcentajereteiva) ?></td>
                    <th><?= Html::activeLabel($model, 'retencioniva') ?></th>
                    <td><?= Html::encode('$ '.number_format($model->retencioniva)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'plazopago') ?></th>
                    <td><?= Html::encode($model->plazopago) ?></td>
                    <th><?= Html::activeLabel($model, 'usuariosistema') ?></th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th><?= Html::activeLabel($model, 'subtotal') ?></th>
                    <td><?= Html::encode('$ '.number_format($model->subtotal)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'formapago') ?></th>
                    <td><?= Html::encode($model->formapago) ?></td>
                    <th><?= Html::activeLabel($model, 'saldo') ?></th>
                    <td><?= Html::encode($model->saldo) ?></td>
                    <th><?= Html::activeLabel($model, 'totalpagar') ?></th>
                    <td><?= Html::encode('$ '.number_format($model->totalpagar)) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <?=  $this->render('detalle', ['modeldetalles' => $modeldetalles, 'modeldetalle' => $modeldetalle, 'idfactura' => $model->idfactura, 'idordenproduccion' => $model->idordenproduccion, 'estado' => $model->estado]); ?>
</div>
