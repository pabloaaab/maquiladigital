<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prendatipo */

$this->title = 'Detalle Prenda Tipo';
$this->params['breadcrumbs'][] = ['label' => 'Prenda Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idprendatipo;
?>
<div class="prendatipo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idprendatipo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idprendatipo], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idprendatipo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idprendatipo',
            'prenda',
            [                      // the owner name of the model
                'label' => 'Talla',
                'value' => "{$model->talla->talla} - {$model->talla->sexo}",
            ],
        ],
    ]) ?>

</div>
