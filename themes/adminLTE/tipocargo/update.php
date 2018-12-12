<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipocargo */

$this->title = 'Editar Tipo Cargo: ' . $model->id_tipo_cargo;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_cargo, 'url' => ['view', 'id' => $model->id_tipo_cargo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="tipocargo-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
