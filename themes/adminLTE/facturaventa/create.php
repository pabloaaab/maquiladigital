<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Facturaventa */

$this->title = 'Nuevo Factura de venta';
$this->params['breadcrumbs'][] = ['label' => 'Facturas de ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facturaventa-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'clientes' => $clientes,
        'ordenesproduccion' => [],

    ]) ?>

</div>
