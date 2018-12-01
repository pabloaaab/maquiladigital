<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Arl */

$this->title = 'Detalle % Arl';
$this->params['breadcrumbs'][] = ['label' => '% Arl', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_arl;
?>
<div class="arl-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_arl], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_arl], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Tipo Cargo
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_arl') ?>:</th>
                    <td><?= Html::encode($model->id_arl) ?></td>
                    <th><?= Html::activeLabel($model, 'arl') ?>:</th>
                    <td><?= Html::encode($model->arl) ?></td>                    
                </tr>                                               
            </table>
        </div>
    </div>
    
</div>
