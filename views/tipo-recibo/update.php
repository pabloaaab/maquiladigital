<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoRecibo */

$this->title = 'Update Tipo Recibo: ' . $model->idtiporecibo;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Recibos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtiporecibo, 'url' => ['view', 'id' => $model->idtiporecibo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-recibo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
