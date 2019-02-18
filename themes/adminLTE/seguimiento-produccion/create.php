<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientoProduccion */

$this->title = 'Nuevo Seguimiento Produccion';
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos Produccion', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguimiento-produccion-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'clientes' => $clientes,
        'ordenesproduccion' => $ordenesproduccion,
    ]) ?>

</div>
