<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prendatipo */

$this->title = 'Update Prendatipo: ' . $model->idprendatipo;
$this->params['breadcrumbs'][] = ['label' => 'Prendatipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idprendatipo, 'url' => ['view', 'id' => $model->idprendatipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prendatipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
