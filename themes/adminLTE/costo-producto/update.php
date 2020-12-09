<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CostoProducto */

$this->title = 'Editar costo';
$this->params['breadcrumbs'][] = ['label' => 'Costo Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_producto, 'url' => ['view', 'id' => $model->id_producto]];

?>
<div class="costo-producto-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
