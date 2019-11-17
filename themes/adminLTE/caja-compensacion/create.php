<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CajaCompensacion */

$this->title = 'Nuevo Caja Compensacion';
$this->params['breadcrumbs'][] = ['label' => 'Cajas de Compensacion', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-documento-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
