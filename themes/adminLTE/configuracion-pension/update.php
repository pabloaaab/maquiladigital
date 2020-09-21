<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoPago */

$this->title = 'Editar Configuración: ' . $model->id_pension;
$this->params['breadcrumbs'][] = ['label' => 'Configuración pensión', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pension, 'url' => ['view', 'id' => $model->id_pension]];
$this->params['breadcrumbs'][] = 'Editar Configuración';
?>
<div class="configuracion-pension-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
