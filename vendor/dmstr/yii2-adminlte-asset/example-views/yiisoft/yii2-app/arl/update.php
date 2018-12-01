<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Arl */

$this->title = 'Editar % Arl: ' . $model->id_arl;
$this->params['breadcrumbs'][] = ['label' => '% Arl', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_arl, 'url' => ['view', 'id' => $model->id_arl]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="arl-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
