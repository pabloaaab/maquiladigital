<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\EstudioEmpleado */

$this->title = 'Estudios ';
$this->params['breadcrumbs'][] = ['label' => 'Estudio Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['index', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="estudio-empleado-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
