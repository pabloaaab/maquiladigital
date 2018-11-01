<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */

$this->title = 'Nuevo Recibo Caja';
$this->params['breadcrumbs'][] = ['label' => 'Recibos Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibocaja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>