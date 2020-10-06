<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Balanceo */

$this->title = 'Nuevo modulo';
$this->params['breadcrumbs'][] = ['label' => 'Balanceos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balanceo-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'orden' => $orden,
    ]) ?>

</div>
