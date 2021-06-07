<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\vredito */
$this->title = 'Editar credito Nro: '.$model->id_credito;
$this->params['breadcrumbs'][] = ['label' => 'Prestamos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_credito, 'url' => ['view', 'id' => $model->id_credito]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="licencia-update">

   <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model, 
    ]) ?>

</div>