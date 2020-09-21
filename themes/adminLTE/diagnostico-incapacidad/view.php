<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tipocargo */

$this->title = 'Detalle diagnóstico';
$this->params['breadcrumbs'][] = ['label' => 'Diagnóstico', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->codigo_diagnostico;
?>
<div class="diagnostico-incapacidad-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->id_codigo], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_codigo], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_codigo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Diagnósticos
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_codigo') ?>:</th>
                    <td><?= Html::encode($model->id_codigo) ?></td>
                </tr>   
                <tr>
                    <th><?= Html::activeLabel($model, 'codigo_diagnostico') ?>:</th>
                    <td><?= Html::encode($model->codigo_diagnostico) ?></td>
                </tr>  
                 <tr>
                    <th><?= Html::activeLabel($model, 'diagnostico') ?>:</th>
                    <td><?= Html::encode($model->diagnostico) ?></td>
            </table>
        </div>
    </div>
    
</div>

