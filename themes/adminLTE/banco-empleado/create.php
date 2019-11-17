<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BancoEmpleado */

$this->title = 'Nuevo Banco Empleado';
$this->params['breadcrumbs'][] = ['label' => 'Bancos Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banco-empleado-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
