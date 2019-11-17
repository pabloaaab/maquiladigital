<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sucursal */

$this->title = 'Editar Sucursal: ' . $model->id_sucursal;
$this->params['breadcrumbs'][] = ['label' => 'Sucursales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sucursal, 'url' => ['view', 'id' => $model->id_sucursal]];
$this->params['breadcrumbs'][] = 'Editar Sucursal';
?>
<div class="sucursal-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
