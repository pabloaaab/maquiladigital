<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idfactura], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idfactura], [
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
            'idfactura',
            'nrofactura',
            'fechainicio',
            'fechavcto',
            'fechacreacion',
            'formapago',
            'plazopago',
            'porcentajeiva',
            'porcentajefuente',
            'porcentajereteiva',
            'subtotal',
            'retencionfuente',
            'impuestoiva',
            'retencioniva',
            'saldo',
            'totalpagar',
            'valorletras:ntext',
            'idcliente',
            'idordenproduccion',
            'usuariosistema',
            'idresolucion',
        ],
    ]) ?>

</div>
