<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Referencias */

$this->title = 'Nueva Referencias';
$this->params['breadcrumbs'][] = ['label' => 'Nueva', 'url' => ['index']];
?>
<div class="referencias-create">

      <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'producto' => $producto,
    ]) ?>

</div>
