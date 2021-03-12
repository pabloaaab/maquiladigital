<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */

$this->title = 'Salida/Entrada';
$this->params['breadcrumbs'][] = ['label' => 'Orden produccion', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenproduccion-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_formsalidaentrada', [
        'model' => $model,
	'clientes' => $clientes,
        'orden' => $orden,
    ]) ?>

</div>
