<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Operarios */

$this->title = 'Operarios';
$this->params['breadcrumbs'][] = ['label' => 'Operarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operarios-create">

   <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
