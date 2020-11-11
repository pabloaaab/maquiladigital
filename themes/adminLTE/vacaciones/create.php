<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacaciones */

$this->title = 'Vacaciones';
$this->params['breadcrumbs'][] = ['label' => 'Vacaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacaciones-create">

   <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
