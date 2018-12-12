<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ordenproducciontipo */

$this->title = 'Create Ordenproducciontipo';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de producción tipo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenproducciontipo-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
