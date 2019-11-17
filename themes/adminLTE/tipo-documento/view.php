<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tipo-documento */

$this->title = 'Detalle Tipo Documento';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idtipo;
?>
<div class="resolucion-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

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
    <div class="panel panel-success">
        <div class="panel-heading">
            Tipo de documento
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'idtipo') ?>:</th>
                    <td><?= Html::encode($model->idtipo) ?></td>
                    <th><?= Html::activeLabel($model, 'tipo') ?>:</th>
                    <td><?= Html::encode($model->tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'codigo_interfaz') ?>:</th>
                    <td><?= Html::encode($model->codigo_interfaz) ?></td>
                    <th><?= Html::activeLabel($model, 'descripcion') ?>:</th>
                    <td><?= Html::encode($model->descripcion) ?></td>                    
                </tr>                
            </table>
        </div>
    </div>
</div>
