<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Configuracionpension */

$this->title = 'Nueva configuración';
$this->params['breadcrumbs'][] = ['label' => 'Configuración pensión', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuracion-pension-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
