<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Operarios */

$this->title = 'Operarios ' . $model->id_operario;
$this->params['breadcrumbs'][] = ['label' => 'Operarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_operario, 'url' => ['index', 'id' => $model->id_operario]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="operarios-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
