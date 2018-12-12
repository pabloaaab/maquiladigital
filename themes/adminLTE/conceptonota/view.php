<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Conceptonota */

$this->title = 'Detalle Concepto Nota';
$this->params['breadcrumbs'][] = ['label' => 'Conceptos Notas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idconceptonota;
?>
<div class="conceptonota-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idconceptonota], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idconceptonota], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idconceptonota], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Concepto nota
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'idconceptonota') ?>:</th>
                    <td><?= Html::encode($model->idconceptonota) ?></td>                    
                    <th><?= Html::activeLabel($model, 'concepto') ?>:</th>
                    <td><?= Html::encode($model->concepto) ?></td>
                    <th><?= Html::activeLabel($model, 'estado') ?>:</th>
                    <td><?= Html::encode($model->estado) ?></td>                    
                </tr>                                
            </table>
        </div>
    </div>    
</div>
