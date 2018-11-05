<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */

$this->title = 'Update Recibocaja: ' . $model->idrecibo;
$this->params['breadcrumbs'][] = ['label' => 'Recibocajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrecibo, 'url' => ['view', 'id' => $model->idrecibo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="recibocaja-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
