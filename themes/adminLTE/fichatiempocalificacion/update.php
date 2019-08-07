<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fichatiempocalificacion */
use yii\helpers\ArrayHelper;

$this->title = 'Editar Ficha Tiempo Calificación: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Colores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="fichatiempocalificacion-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
