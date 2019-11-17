<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CentroCosto */

$this->title = 'Editar Centro Costo: ' . $model->id_centro_costo;
$this->params['breadcrumbs'][] = ['label' => 'Centros de Costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_centro_costo, 'url' => ['view', 'id' => $model->id_centro_costo]];
$this->params['breadcrumbs'][] = 'Editar Centro de Costo';
?>
<div class="centro-costo-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
