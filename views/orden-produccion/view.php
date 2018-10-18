<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Ordenproducciondetalle;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */

$this->title = 'Detalle Orden de Producción';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Producción', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idordenproduccion;
?>
<div class="ordenproduccion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idordenproduccion], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idordenproduccion], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idordenproduccion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-success">
        <div class="panel-heading">
            <h5><?= Html::encode($this->title) ?></h5>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'idordenproduccion') ?></th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>
                    <th><?= Html::activeLabel($model, 'Cliente') ?></th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'ordenproduccion') ?></th>
                    <td><?= Html::encode($model->ordenproduccion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechallegada') ?></th>
                    <td><?= Html::encode($model->fechallegada) ?></td>
                    <th><?= Html::activeLabel($model, 'fechallegada') ?></th>
                    <td><?= Html::encode($model->fechaprocesada) ?></td>
                    <th><?= Html::activeLabel($model, 'fechallegada') ?></th>
                    <td><?= Html::encode($model->fechaentrega) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'estado') ?></th>
                    <td><?= Html::encode($model->getEtiquetaEstado()) ?></td>
                    <th><?= Html::activeLabel($model, 'usuariosistema') ?></th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th><?= Html::activeLabel($model, 'totalorden') ?></th>
                    <td><?= Html::encode($model->totalorden) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'observacion') ?></th>
                    <td colspan="5"><?= Html::encode($model->observacion) ?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php $modeldetalle = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $model->idordenproduccion])->all(); ?>
    <?php $model = new Ordenproducciondetalle(); ?>
    <?=  $this->render('detalle', ['modeldetalle' => $modeldetalle, 'id' => $model->idordenproduccion]); ?>

    <!-- Nuevo modal detalle -->

    <div class="modal fade" role="dialog" aria-hidden="true" id="idordenproduccion<?= $model->idordenproduccion ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Nuevo detalle</h4>
                </div>
                <?= Html::beginForm(Url::toRoute("orden-produccion/nuevodetalle"), "POST") ?>
                <div class="modal-body">
                    <?=  $this->render('_formdetalle',['model' => $model, 'idordenproduccion' => $model->idordenproduccion]); ?>

                </div>
                <div class="modal-footer">
                    <?= Html::endForm() ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="panel-footer text-right" >
        <!-- Nuevo boton modal detalle -->
        <a href="#" data-toggle="modal" data-target="#idordenproduccion<?= $model->idordenproduccion ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>
    </div>
</div>
