<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagoAdicionalPermanente */

$this->title = 'Descueto x fecha';
$this->params['breadcrumbs'][] = ['label' => 'Descuento x fecha', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-adicional-fecha-createdescuento">
 <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_formdescuento', [
        'model' => $model,
        'fecha_corte' => $fecha_corte,

    ]) ?>

</div>
