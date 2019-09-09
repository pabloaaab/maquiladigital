<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Color */

$this->title = 'Detalle Color';
$this->params['breadcrumbs'][] = ['label' => 'Colores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="color-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Banco
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id') ?>:</th>
                    <td><?= Html::encode($model->id) ?></td>
                    <th><?= Html::activeLabel($model, 'color') ?>:</th>
                    <td><?= Html::encode($model->color) ?></td>                    
                </tr>                                                                
            </table>
        </div>
    </div>
    <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'color',            
        ],
    ]) ?>-->

</div>