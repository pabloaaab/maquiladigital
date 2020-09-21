<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Periodopago */

$this->title = 'Editar Periodo: ' . $model->id_periodo_pago;
$this->params['breadcrumbs'][] = ['label' => 'Periodo de pago', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_periodo_pago, 'url' => ['index', 'id' => $model->id_periodo_pago]];
$this->params['breadcrumbs'][] = 'Editar periodo';
?>
<div class="periodo-pago-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
