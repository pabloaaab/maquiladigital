<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */
use yii\helpers\ArrayHelper;

$this->title = 'Editar Empleado: ' . $model->id_empleado;
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_empleado, 'url' => ['view', 'id' => $model->id_empleado]];
$this->params['breadcrumbs'][] = 'Editar';
?>

<!--<h1>Editar Cliente</h1>-->
<?php if ($tipomsg == "danger") { ?>
    <h3 class="alert-danger"><?= $msg ?></h3>
<?php } else{ ?>
    <h3 class="alert-success"><?= $msg ?></h3>
<?php } ?>
    
<div class="empleado-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
