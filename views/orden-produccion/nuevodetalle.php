<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ordenproducciondetalle */

$this->title = 'Nuevo Orden Producción detalle';
$this->params['breadcrumbs'][] = ['label' => 'Detalle orden producción', 'url' => ['view','id' => $model->idordenproduccion]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenproduccion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formdetalle', [
        'model' => $model,

    ]) ?>

</div>

