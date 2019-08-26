<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoEquivalente */

$this->title = 'Create Documento Equivalente';
$this->params['breadcrumbs'][] = ['label' => 'Documento Equivalentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-equivalente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
