<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SintomaCovid */

$this->title = 'Nuevo Sintoma';
$this->params['breadcrumbs'][] = ['label' => 'Sintoma', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arl-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
