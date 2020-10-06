<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Balanceo */

$this->title = 'Update Balanceo: ' . $model->id_balanceo;
$this->params['breadcrumbs'][] = ['label' => 'Balanceos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_balanceo, 'url' => ['view', 'id' => $model->id_balanceo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="balanceo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
