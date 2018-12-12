<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproducciontipo */

$this->title = 'Editar Orden produccion tipo: ' . $model->idtipo;
$this->params['breadcrumbs'][] = ['label' => 'Ordenes produccion tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtipo, 'url' => ['view', 'id' => $model->idtipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ordenproducciontipo-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
