<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesoProduccion */

$this->title = 'Editar Proceso Producción';
$this->params['breadcrumbs'][] = ['label' => 'Procesos Producción', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idproceso, 'url' => ['view', 'id' => $model->idproceso]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="proceso-produccion-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
