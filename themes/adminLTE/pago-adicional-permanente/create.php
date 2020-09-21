<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagoAdicionalFecha */

$this->title = 'Adicional x Fecha';
$this->params['breadcrumbs'][] = ['label' => 'Adicional Fechas', 'url' => ['indexfecha']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-adicional-permanente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formfecha', [
        'model' => $model,
    ]) ?>

</div>
