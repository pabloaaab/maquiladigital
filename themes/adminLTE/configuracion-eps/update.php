<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ConfiguracionEps */

$this->title = 'Editar Configuración: ' . $model->id_eps;
$this->params['breadcrumbs'][] = ['label' => 'Configuración eps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_eps, 'url' => ['view', 'id' => $model->id_eps]];
$this->params['breadcrumbs'][] = 'Editar Configuración';
?>
<div class="configuracion-eps-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
