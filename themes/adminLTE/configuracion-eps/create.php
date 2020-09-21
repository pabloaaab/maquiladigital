<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GrupoPago */

$this->title = 'Nuevo Configuración';
$this->params['breadcrumbs'][] = ['label' => 'Configuracion eps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuracion-eps-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
