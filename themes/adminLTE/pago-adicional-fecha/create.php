<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GrupoPago */

$this->title = 'Pago por fecha';
$this->params['breadcrumbs'][] = ['label' => 'Pago x fecha', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
?>
<div class="grupo-pago-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
