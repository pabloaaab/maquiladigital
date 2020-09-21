<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Periodopago */

$this->title = 'Nuevo Periodo';
$this->params['breadcrumbs'][] = ['label' => 'Periodo de pago', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="periodo-pago-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
