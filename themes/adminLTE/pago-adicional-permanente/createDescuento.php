<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagoAdicionalPermanente */

$this->title = 'Descuento Permanente';
$this->params['breadcrumbs'][] = ['label' => 'Descuentos Permanentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-adicional-permanente-createdescuento">
 <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_formdescuento', [
        'model' => $model,

    ]) ?>

</div>
