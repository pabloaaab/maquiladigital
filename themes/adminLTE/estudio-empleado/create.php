<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstudioEmpleado */

$this->title = 'Estudios';
$this->params['breadcrumbs'][] = ['label' => 'Estudio Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudio-empleado-create">

   <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
