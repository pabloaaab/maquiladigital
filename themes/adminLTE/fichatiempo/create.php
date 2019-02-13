<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fichatiempo */

$this->title = 'Nuevo Ficha Tiempo';
$this->params['breadcrumbs'][] = ['label' => 'Fichas tiempos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichatiempo-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
