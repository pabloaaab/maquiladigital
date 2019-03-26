<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientoProduccion */

$this->title = 'Detalle Consulta Seguimiento Produccion';
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos Produccion', 'url' => ['indexconsulta']];
$this->params['breadcrumbs'][] = $model->id_seguimiento_produccion;
?>
<p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['indexconsulta'], ['class' => 'btn btn-primary']) ?>        
    </p>

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
                    <th><?= Html::activeLabel($model, 'idordenproduccion') ?>:</th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>                   
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'ordenproduccionint') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccionint) ?></td>
                    <th><?= Html::activeLabel($model, 'codigoproducto') ?>:</th>
                    <td><?= Html::encode($model->codigoproducto) ?></td>                   
                </tr>
            </table>
        </div>
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
                <th scope="col">T. Venta</th>
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
                <td><?= $val->total_venta ?></td>
                <td></td>                
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <div class="panel-footer text-right">			            
            <?= Html::a('<span class="glyphicon glyphicon-export"></span> Excel', ['excel', 'id' => $model->id_seguimiento_produccion], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

