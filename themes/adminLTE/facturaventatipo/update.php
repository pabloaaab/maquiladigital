<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventatipo */

$this->title = 'Editar Factura Venta Tipo: ' . $model->id_factura_venta_tipo;
$this->params['breadcrumbs'][] = ['label' => 'Facturas Venta Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_factura_venta_tipo, 'url' => ['view', 'id' => $model->id_factura_venta_tipo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="facturaventatipo-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
