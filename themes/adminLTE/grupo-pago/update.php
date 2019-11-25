<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoPago */

$this->title = 'Editar Grupo de Pago: ' . $model->id_grupo_pago;
$this->params['breadcrumbs'][] = ['label' => 'Grupos de Pago', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_grupo_pago, 'url' => ['view', 'id' => $model->id_grupo_pago]];
$this->params['breadcrumbs'][] = 'Editar Grupo Pago';
?>
<div class="grupo-pago-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
