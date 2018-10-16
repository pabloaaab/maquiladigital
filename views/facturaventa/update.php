<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventa */

$this->title = 'Editar Factura de Venta: ' . $model->nrofactura;
$this->params['breadcrumbs'][] = ['label' => 'Facturas de Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nrofactura, 'url' => ['view', 'id' => $model->nrofactura]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="facturaventa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
