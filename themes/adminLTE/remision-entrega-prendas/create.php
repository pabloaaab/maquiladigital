<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RemisionEntregaPrendas */

$this->title = 'Nueva';
$this->params['breadcrumbs'][] = ['label' => 'Remision de Prendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="remision-entrega-prendas-create">

   <!-- <h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
