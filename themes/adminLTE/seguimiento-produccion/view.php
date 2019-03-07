<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientoProduccion */

$this->title = 'Detalle Seguimiento Produccion';
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos Produccion', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_seguimiento_produccion;
?>
<p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_seguimiento_produccion], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_seguimiento_produccion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute(["seguimiento-produccion/view", 'id' => $model->id_seguimiento_produccion]),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],    
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'options' => []
    ],    
]);
?>

<div class="seguimiento-produccion-view">

    <!--<?= Html::encode($this->title) ?>-->

    
    
    <div class="panel panel-success">
        <div class="panel-heading">
            Seguimiento Producción
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_seguimiento_produccion') ?>:</th>
                    <td><?= Html::encode($model->id_seguimiento_produccion) ?></td>
                    <th><?= Html::activeLabel($model, 'fecha_inicio_produccion') ?>:</th>
                    <td><?= Html::encode($model->fecha_inicio_produccion.' - '.$model->hora_inicio) ?></td>                    
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'idcliente') ?>:</th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'ordenProduccion') ?>:</th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>                   
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'ordenProdInterna') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->ordenproduccion) ?></td>
                    <th><?= Html::activeLabel($model, 'ordenProdExterna') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->ordenproduccionext) ?></td>                   
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-success panel-filters">
    <div class="panel-heading">
        Parametros de entrada
    </div>
	
    <div class="panel-body" id="seguimiento-produccion">
        <div class="row" >
            <?= $formulario->field($form, "operarias")->input("search") ?>
            <?= $formulario->field($form, "horastrabajar")->input("search") ?>            
            <?= $formulario->field($form, 'minutos')->dropdownList([number_format($model->ordenproduccion->duracion,2) => 'Cliente'.'('.$model->ordenproduccion->duracion.')', number_format($model->ordenproduccion->segundosficha/60,2) => 'Confección'.'('.number_format($model->ordenproduccion->segundosficha/60,2).')'], ['prompt' => 'Seleccione...', 'onchange' => 'fpago()', 'id' => 'formapago']) ?>
            <?= $formulario->field($form, "reales")->input("search", ['value' => '0']) ?>
            <?= $formulario->field($form, "descanso")->input("search", ['value' => '0']) ?>
            <?= $formulario->field($form, "sistema")->input("search",['readonly' => TRUE]) ?>
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-list-alt'></span> Calcular prendas", ["class" => "btn btn-primary", 'name' => 'calcular']) ?>
            <?= Html::submitButton("<span class='glyphicon glyphicon-list-alt'></span> Generar Info", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute(["seguimiento-produccion/view", 'id' => $model->id_seguimiento_produccion]) ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>

</div>
<?php $formulario->end() ?>
<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Reporte
    </div>
        <table class="table table-hover">
            <thead>
            <tr>                
                <th scope="col">Fecha/Hora Consulta</th>
                <th scope="col">Minutos</th>
                <th scope="col">Cant. x Hora</th>
                <th scope="col">Horas a Trabajar</th>
                <th scope="col">Cant. Total x Hora</th>
                <th scope="col">Operarias</th>
                <th scope="col">Total Unid x Dia</th>
                <th scope="col">Operario x Hora</th>
                <th scope="col">Prendas x Sistemas</th>
                <th scope="col">Prendas Reales</th>
                <th scope="col">% Prod</th>                
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($seguimientodetalletemporal as $val): ?>    
            <tr>                                
                <td><?= $val->fecha_consulta.' '.$val->hora_consulta ?></td>
                <td><?= $val->minutos ?></td>
                <td><?= $val->cantidad_por_hora ?></td>
                <td><?= $val->horas_a_trabajar ?></td>
                <td><?= $val->cantidad_total_por_hora ?></td>
                <td><?= $val->operarias ?></td>
                <td><?= $val->total_unidades_por_dia ?></td>
                <td><?= $val->total_unidades_por_hora ?></td>
                <td><?= $val->prendas_sistema ?></td>
                <td><?= $val->prendas_reales ?></td>
                <td><?= $val->porcentaje_produccion ?></td>
                <td></td>
                <td>
                <?php
                $form = ActiveForm::begin([
                            "method" => "post",
                            'id' => 'formulario',
                            'enableClientValidation' => false,
                            'enableAjaxValidation' => true,
                            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
                            
                        ]);
                ?>    
                <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span>", ['name' => 'guardardetalle']); ?>
                <?php $form->end() ?>
                </td>
            </tr>
            </tbody>
            <?php endforeach; ?>            
        </table>        
    </div>
</div>

<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Detalles
    </div>
        <table class="table table-hover">
            <thead>
            <tr>                
                <th scope="col">Fecha/Hora Consulta</th>
                <th scope="col">Minutos</th>
                <th scope="col">Cant. x Hora</th>
                <th scope="col">Horas a Trabajar</th>
                <th scope="col">Cant. Total x Hora</th>
                <th scope="col">Operarias</th>
                <th scope="col">Total Unid x Dia</th>
                <th scope="col">Operario x Hora</th>
                <th scope="col">Prendas x Sistemas</th>
                <th scope="col">Prendas Reales</th>
                <th scope="col">% Prod</th>                
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>            
            <tbody>
            <?php foreach ($seguimientodetalle as $val): ?>    
            <tr>                                
                <td><?= $val->fecha_consulta.' '.$val->hora_consulta ?></td>
                <td><?= $val->minutos ?></td>
                <td><?= $val->cantidad_por_hora ?></td>
                <td><?= $val->horas_a_trabajar ?></td>
                <td><?= $val->cantidad_total_por_hora ?></td>
                <td><?= $val->operarias ?></td>
                <td><?= $val->total_unidades_por_dia ?></td>
                <td><?= $val->total_unidades_por_hora ?></td>
                <td><?= $val->prendas_sistema ?></td>
                <td><?= $val->prendas_reales ?></td>
                <td><?= $val->porcentaje_produccion ?></td>
                <td></td>
                <td><?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['eliminardetalle', 'id' => $val->id_seguimiento_produccion_detalle, 'idseguimiento' => $model->id_seguimiento_produccion]); ?></td>                
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <div class="panel-footer text-right">			            
            <?= Html::a('<span class="glyphicon glyphicon-export"></span> Excel', ['excel', 'id' => $model->id_seguimiento_produccion], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

