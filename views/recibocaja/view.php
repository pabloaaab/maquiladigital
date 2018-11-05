<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */

$this->title = $model->idrecibo;
$this->params['breadcrumbs'][] = ['label' => 'Recibocajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibocaja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idrecibo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idrecibo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idrecibo',
            'fecharecibo',
            'fechapago',
            'idtiporecibo',
            'idmunicipio',
            'valorpagado',
            'valorletras:ntext',
            'idcliente',
            'observacion:ntext',
            'usuariosistema',
        ],
    ]) ?>

</div>
