<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Credito */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Prestamo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credito-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
