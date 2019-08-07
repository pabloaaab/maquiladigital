<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Fichatiempocalificacion */

$this->title = 'Nuevo Ficha Tiempo Calificacion';
$this->params['breadcrumbs'][] = ['label' => 'Fichas de Tiempos Calificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichatiempocalificacion-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
