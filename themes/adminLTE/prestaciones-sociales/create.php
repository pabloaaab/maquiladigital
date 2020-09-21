<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagoAdicionalPermanente */

$this->title = 'Adicion';
$this->params['breadcrumbs'][] = ['label' => 'Adición', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pago-adicional-permanente-adicional">
 <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?= $this->render('_adicion', [
        'model' => $model,
        'id' => $id,
        'tipo_adicion' => $tipo_adicion,
    ]) ?>

</div>
