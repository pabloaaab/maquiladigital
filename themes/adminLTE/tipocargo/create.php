<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tipocargo */

$this->title = 'Nuevo Tipo Cargo';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Cargos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipocargo-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
