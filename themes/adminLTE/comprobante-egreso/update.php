<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso */

$this->title = 'Update Comprobante Egreso: ' . $model->id_comprobante_egreso;
$this->params['breadcrumbs'][] = ['label' => 'Comprobante Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_comprobante_egreso, 'url' => ['view', 'id' => $model->id_comprobante_egreso]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comprobante-egreso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
