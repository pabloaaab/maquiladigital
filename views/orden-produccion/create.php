<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */

$this->title = 'Nuevo Orden Producción';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Producción', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenproduccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'clientes' => $clientes,
    ]) ?>

</div>
