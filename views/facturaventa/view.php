<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventa */

$this->title = 'Detalle Factura de Venta';
$this->params['breadcrumbs'][] = ['label' => 'Facturas de Venta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nrofactura;
?>
<div class="facturaventa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->nrofactura], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->nrofactura], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->nrofactura], [
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
            'nrofactura',
            'fechainicio',
            'fechavcto',
            'formapago',
            'plazopago',
            'porcentajeiva',
            'porcentajefuente',
            'porcentajereteiva',
            'subtotal',
            'retencionfuente',
            'impuestoiva',
            'retencioniva',
            'totalpagar',
            'valorletras:ntext',
            'idcliente',
            'idordenproduccion',
            'usuariosistema',
        ],
    ]) ?>
	<?=  $this->render('detalle', ['Facturaventadetalle' => $Facturaventadetalle, 'nrofactura' => $model->nrofactura]); ?>
</div>
