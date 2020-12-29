<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RemisionEntregaPrendas */

$this->title = 'Remision de entrega';
$this->params['breadcrumbs'][] = ['label' => 'Remision Entrega Prendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_remision, 'url' => ['view', 'id' => $model->id_remision]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="remision-entrega-prendas-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
