<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idordenproduccion',
            'idcliente',
            'fechallegada',
            'fechaprocesada',
            'fechaentrega',
            'totalorden',
            'valorletras:ntext',
            'observacion:ntext',
            'estado',
            'usuariosistema',
        ],
    ]) ?>
	<?=  $this->render('detalle', ['OrdenProduccionDetalle' => $OrdenProduccionDetalle, 'idordenproduccion' => $model->idordenproduccion]); ?>
</div>
