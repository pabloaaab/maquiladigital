<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SintomasCovid */

$this->title = 'Editar Sintoma: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sintoma', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="sintoma-covid-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
