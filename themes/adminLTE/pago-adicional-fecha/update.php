<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagoAdicionalFecha */

$this->title = 'Adicional por fecha';
$this->params['breadcrumbs'][] = ['label' => 'Adicional por fecha', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pago_fecha, 'url' => ['view', 'id' => $model->id_pago_fecha]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="pago-adicional-fecha-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'fecha_corte' => $fecha_corte,
    ]) ?>

</div>
