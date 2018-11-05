<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */

$this->title = 'Create Recibocaja';
$this->params['breadcrumbs'][] = ['label' => 'Recibocajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibocaja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
