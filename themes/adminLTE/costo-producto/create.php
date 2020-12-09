<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CostoProducto */

$this->title = 'Nuevo Producto';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];

?>
<div class="costo-producto-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
