<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prendatipo */

$this->title = $model->idprendatipo;
$this->params['breadcrumbs'][] = ['label' => 'Prendatipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prendatipo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idprendatipo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idprendatipo], [
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
            'idprendatipo',
            'prenda',
            'idtalla',
        ],
    ]) ?>

</div>
