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
use app\models\Cliente;

/* @var $this yii\web\View */
/* @var $model app\models\Fichatiempo */

$this->title = 'Detalle Ficha Tiempo';
$this->params['breadcrumbs'][] = ['label' => 'Fichas Tiempos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_ficha_tiempo;
?>
<?php
$clientes = ArrayHelper::map(Cliente::find()->where(['=','proceso', 1])->all(), 'idcliente', 'nombrecorto');
?>
<div class="Fichatiempo-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_ficha_tiempo], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_ficha_tiempo], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
        <?php 
        if ($model->estado == 0){ ?>
            <?= Html::a('<span class="glyphicon glyphicon-remove"></span> Cerrar', ['cerrar', 'id' => $model->id_ficha_tiempo], [
                'class' => 'btn btn-default btn-sm',
                'data' => [
                'confirm' => 'Esta seguro de cerrar el registro?',
                'method' => 'post',
                ],
                ]) ?>
        <?php } ?>        
        
        <button type="button" class="btn btn-warning">Cerrado <span class="badge"><?= $model->cerrado ?></span></button>
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
                    <th><?= Html::activeLabel($model, 'horario') ?>:</th>
                    <td><?= Html::encode($model->horario->horario) ?></td>
                    <th><?= Html::activeLabel($model, 'h_desde') ?>:</th>
                    <td><?= Html::encode($model->horario->desde) ?></td>
                    <th><?= Html::activeLabel($model, 'h_hasta') ?>:</th>
                    <td><?= Html::encode($model->horario->hasta) ?></td>
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
                    <th scope="col">Cliente</th>
                    <th scope="col">Día</th>
                    <th scope="col">Hora Desde</th>
                    <th scope="col">Hora Hasta</th>
                    <th scope="col">Total Seg</th>
                    <th scope="col" title="TOTAL OPERACIONES">Total Op</th>
                    <th scope="col">Op Realizadas</th>
                    <th scope="col">Vlr Op</th>
                    <th scope="col">Vlr Pagar</th>
                    <th scope="col" title="CUMPLIMIENTO">Cump</th>
                    <th scope="col">Observación</th>                    
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fichatiempodetalle as $val): ?>
                    <tr>                    
                        <td style="padding-left: 1;padding-right: 1;"><?= Html::dropDownList('idcliente[]', $val->idcliente, $clientes, ['class' => 'col-sm-12', 'prompt' => 'Seleccion...', 'required' => true]) ?></td>
                        <td style="padding-left: 1;padding-right: 1;"><input type="date" name="dia[]" value="<?= $val->dia ?>" size="2" required></td>                        
                        <td style="padding-left: 1;padding-right: 1;"><input type="time" name="horadesde[]" value="<?= $val->desde ?>" size="2" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 1;padding-right: 1;"><input type="time" name="horahasta[]" value="<?= $val->hasta ?>" size="2" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 1;padding-right: 1;"><input type="text" name="totalsegundos[]" value="<?= $val->total_segundos ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 1;padding-right: 0;"><?= $val->total_operacion ?></td>
                        <td style="padding-left: 1;padding-right: 1;"><input type="text" name="realizadas[]" value="<?= $val->realizadas ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 1;padding-right: 0;"><?= $val->valor_operacion ?></td>
                        <td style="padding-left: 1;padding-right: 0;"><?= $val->valor_pagar ?></td>
                        <td style="padding-left: 1;padding-right: 0;"><?= $val->cumplimiento ?></td>
                        <td style="padding-left: 1;padding-right: 0;"><?= $val->observacion ?></td>                        
                        <td style="padding-left: 0;padding-right: 0;"><input type="hidden" name="id_ficha_tiempo_detalle[]" value="<?= $val->id_ficha_tiempo_detalle ?>"></td>
                        <td>
                            <?php if ($model->estado == 0){ ?>
                            <?=
                            Html::a('<span class="glyphicon glyphicon-trash"></span> ', ['eliminar', 'id' => $model->id_ficha_tiempo, 'iddetalle' => $val->id_ficha_tiempo_detalle], [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Esta seguro de eliminar el registro?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                            <?php } ?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="panel-footer text-right">
        <?= Html::a('<span class="glyphicon glyphicon-export"></span> Excel', ['generarexcel', 'id' => $model->id_ficha_tiempo], ['class' => 'btn btn-primary btn-sm ']); ?>
        <?php if ($model->estado == 0) { ?>
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['nuevodetalle', 'id' => $model->id_ficha_tiempo], ['class' => 'btn btn-success btn-sm']); ?>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar", ["class" => "btn btn-success btn-sm",]) ?>
        <?php } ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
    function esInteger(e) {
        var charCode
        charCode = e.keyCode
        status = charCode
        if (charCode != 46 && charCode > 31 
 
      && (charCode < 48 || charCode > 57)) {
            return false
        }
        return true
    }
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>