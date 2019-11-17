<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CentroCosto */

$this->title = 'Nuevo Centro Costo';
$this->params['breadcrumbs'][] = ['label' => 'Centros De Costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-costo-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
