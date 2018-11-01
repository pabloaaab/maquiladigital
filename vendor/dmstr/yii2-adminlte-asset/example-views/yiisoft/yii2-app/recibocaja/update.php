<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */

$this->title = 'Editar Recibo Caja: ' . $model->idrecibo;
$this->params['breadcrumbs'][] = ['label' => 'Recibos Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idrecibo, 'url' => ['view', 'id' => $model->idrecibo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="banco-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>