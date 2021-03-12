<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenProduccion */

$this->title = 'Editar Entrada: ' . $model->idordenproduccion;
$this->params['breadcrumbs'][] = ['label' => 'Entrada/salida', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_salida, 'url' => ['view', 'id' => $model->id_salida]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="orden-produccion-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_formsalidaentrada', [
        'model' => $model,
		'clientes' => $clientes,
        'orden' => $orden,
    ]) ?>

</div>
