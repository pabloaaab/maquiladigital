<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Referencias */

$this->title = 'Editar Referencia';
$this->params['breadcrumbs'][] = ['label' => 'Editar', 'url' => ['index']];

?>
<div class="referencias-update">

   <!-- <h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_formeditar', [
        'model' => $model,
        'producto' => $producto,
    ]) ?>

</div>
