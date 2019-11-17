<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoContrato */

$this->title = 'Editar Tipo Contrato: ' . $model->id_tipo_contrato;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_contrato, 'url' => ['view', 'id' => $model->id_tipo_contrato]];
$this->params['breadcrumbs'][] = 'Editar Tipo Contrato';
?>
<div class="tipo Recibo-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
