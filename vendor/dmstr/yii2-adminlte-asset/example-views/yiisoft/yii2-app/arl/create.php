<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Arl */

$this->title = 'Nuevo % Arl';
$this->params['breadcrumbs'][] = ['label' => '% Arl', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arl-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
