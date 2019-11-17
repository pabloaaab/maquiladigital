<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BancoEmpleado */

$this->title = 'Editar Banco Empleado: ' . $model->id_banco_empleado;
$this->params['breadcrumbs'][] = ['label' => 'Bancos Empleado', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_banco_empleado, 'url' => ['view', 'id' => $model->id_banco_empleado]];
$this->params['breadcrumbs'][] = 'Editar Banco Empleado';
?>
<div class="banco-empleado-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
