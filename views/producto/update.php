<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Editar Producto: ' . $model->idproducto;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idproducto, 'url' => ['view', 'id' => $model->idproducto]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="producto-editar">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clientes' => $clientes,
        'prendas' => $prendas,
    ]) ?>

</div>
