<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoEquivalente */

$this->title = 'Update Documento Equivalente: ' . $model->consecutivo;
$this->params['breadcrumbs'][] = ['label' => 'Documento Equivalentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consecutivo, 'url' => ['view', 'id' => $model->consecutivo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="documento-equivalente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
