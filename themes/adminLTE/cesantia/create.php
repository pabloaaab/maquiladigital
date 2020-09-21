<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cesantia */

$this->title = 'Nuevo Cesantia';
$this->params['breadcrumbs'][] = ['label' => 'Cesantias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cesantia-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
