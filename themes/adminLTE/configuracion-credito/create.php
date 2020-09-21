<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ConfiguracionCredito */

$this->title = 'Nuevo Credito';
$this->params['breadcrumbs'][] = ['label' => 'Configuracion Creditos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuracion-credito-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
