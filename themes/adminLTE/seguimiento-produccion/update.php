<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientoProduccion */

$this->title = 'Editar Seguimiento Produccion: ' . $model->id_seguimiento_produccion;
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos Produccion', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_seguimiento_produccion, 'url' => ['view', 'id' => $model->id_seguimiento_produccion]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="seguimiento-produccion-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clientes' => $clientes,
        'ordenesproduccion' => $ordenesproduccion,
    ]) ?>

</div>
