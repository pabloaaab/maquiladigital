<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Talla */

$this->title = 'Editar Talla: ' . $model->idtalla;
$this->params['breadcrumbs'][] = ['label' => 'Tallas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtalla, 'url' => ['view', 'id' => $model->idtalla]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="talla-editar">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
