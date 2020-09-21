<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cesantia */

$this->title = 'Editar Cesantia: ' . $model->id_cesantia;
$this->params['breadcrumbs'][] = ['label' => 'Cesantias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cesantia, 'url' => ['view', 'id' => $model->id_cesantia]];
$this->params['breadcrumbs'][] = 'Editar Cesantia';
?>
<div class="caja-compensacion-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
