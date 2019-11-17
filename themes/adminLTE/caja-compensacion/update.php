<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CajaCompensacion */

$this->title = 'Editar Caja Compensacion: ' . $model->id_caja_compensacion;
$this->params['breadcrumbs'][] = ['label' => 'Cajas de Compensacion', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_caja_compensacion, 'url' => ['view', 'id' => $model->id_caja_compensacion]];
$this->params['breadcrumbs'][] = 'Editar Caja Compensacion';
?>
<div class="caja-compensacion-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
