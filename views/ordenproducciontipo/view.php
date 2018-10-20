<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproducciontipo */

$this->title = 'Detalle Orden Producción Tipo';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes Producción Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idtipo;
?>
<div class="ordenproducciontipo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idtipo], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idtipo], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idtipo], [
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
            'idtipo',
            'tipo',
            'activo',
        ],
    ]) ?>

</div>
