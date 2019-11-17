<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */
use yii\helpers\ArrayHelper;

$this->title = 'Editar Contrato: ' . $model->id_contrato;
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_contrato, 'url' => ['view', 'id' => $model->id_contrato]];
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

    <?= $this->render('_formnuevocontratoempleado', [
        'model' => $model,
    ]) ?>

</div>
