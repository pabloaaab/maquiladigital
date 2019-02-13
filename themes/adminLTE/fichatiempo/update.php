<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fichatiempo */

$this->title = 'Editar Ficha Tiempo: ' . $model->id_ficha_tiempo;
$this->params['breadcrumbs'][] = ['label' => 'Fichas Tiempos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_ficha_tiempo, 'url' => ['view', 'id' => $model->id_ficha_tiempo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="fichatiempo-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
