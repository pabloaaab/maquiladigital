<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prendatipo */

$this->title = 'Create Prendatipo';
$this->params['breadcrumbs'][] = ['label' => 'Prendatipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prendatipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
