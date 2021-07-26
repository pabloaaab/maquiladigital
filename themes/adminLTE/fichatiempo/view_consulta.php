<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\db\ActiveQuery;
/* @var $this yii\web\View */
/* @var $model app\models\Fichatiempo */

$this->title = 'Detalle Ficha Tiempo';
$this->params['breadcrumbs'][] = ['label' => 'Fichas Tiempos', 'url' => ['indexconsulta']];
$this->params['breadcrumbs'][] = $model->id_ficha_tiempo;
?>
<div class="Fichatiempo-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['indexconsulta'], ['class' => 'btn btn-primary btn-sm']) ?>		
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Ficha Tiempo
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_ficha_tiempo') ?>:</th>
                    <td><?= Html::encode($model->id_ficha_tiempo) ?></td>
                    <th><?= Html::activeLabel($model, 'id_operario') ?>:</th>
                    <td><?= Html::encode($model->operario->nombrecompleto) ?></td>
                    <th><?= Html::activeLabel($model, 'cumplimiento') ?>:</th>
                    <td><?= Html::encode($model->cumplimiento) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'referencia') ?>:</th>
                    <td><?= Html::encode($model->referencia) ?></td>
                    <th><?= Html::activeLabel($model, 'desde') ?>:</th>
                    <td><?= Html::encode($model->desde) ?></td>
                    <th><?= Html::activeLabel($model, 'hasta') ?>:</th>
                    <td><?= Html::encode($model->hasta) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'observacion') ?>:</th>
                    <td colspan="3"><?= Html::encode($model->observacion) ?></td>
                    <th><?= Html::activeLabel($model, 'total_segundos') ?>:</th>
                    <td ><?= Html::encode($model->total_segundos) ?></td>
                </tr>                                                
            </table>
        </div>
    </div>

    <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_ficha_tiempo',
            'id_operario',
            'cumplimiento',
            'observacion:ntext',
        ],
    ]) ?>-->

</div>
<?php
$form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
                'options' => []
            ],
        ]);
?>
<div class="panel panel-success ">
    <div class="panel-heading">
        Detalle Ficha Tiempo
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Día</th>
                    <th scope="col">Hora Desde</th>
                    <th scope="col">Hora Hasta</th>
                    <th scope="col">Total Segundos</th>
                    <th scope="col">Total Operaciones</th>
                    <th scope="col">Operaciones Realizadas</th>
                    <th scope="col">Valor Operacion</th>
                    <th scope="col">Valor a Pagar</th>
                    <th scope="col">Cumplimiento</th>
                    <th scope="col">Observación</th>                                        
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fichatiempodetalle as $val): ?>
                    <tr>                    
                        <td><?= $val->dia ?></td>                        
                        <td><?= $val->desde ?></td>
                        <td><?= $val->hasta ?></td>
                        <td><?= $val->total_segundos ?></td>
                        <td><?= $val->total_operacion ?></td>
                        <td><?= $val->realizadas ?></td>
                        <td><?= $val->valor_operacion ?></td>
                        <td><?= $val->valor_pagar ?></td>
                        <td><?= $val->cumplimiento ?></td>
                        <td><?= $val->observacion ?></td>                                                                        
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="panel-footer text-right">
        <?= Html::a('<span class="glyphicon glyphicon-export"></span> Excel', ['generarexcel', 'id' => $model->id_ficha_tiempo], ['class' => 'btn btn-primary ']); ?>        
    </div>
</div>
<?php ActiveForm::end(); ?>

