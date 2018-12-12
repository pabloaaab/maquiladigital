<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Talla */

$this->title = 'Detalle Talla';
$this->params['breadcrumbs'][] = ['label' => 'Tallas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idtalla;
?>
<div class="talla-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idtalla], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idtalla], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Talla
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'idtalla') ?>:</th>
                    <td><?= Html::encode($model->idtalla) ?></td>                    
                    <th><?= Html::activeLabel($model, 'talla') ?>:</th>
                    <td><?= Html::encode($model->talla) ?></td>
                    <th><?= Html::activeLabel($model, 'sexo') ?>:</th>
                    <td><?= Html::encode($model->sexo) ?></td>                    
                </tr>                                
            </table>
        </div>
    </div>    
</div>
