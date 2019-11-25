<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */

$this->title = 'Detalle Contrato';
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_contrato;
$view = 'contrato';
?>
<div class="contrato-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_contrato], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_contrato], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', ['imprimir', 'id' => $model->id_contrato], ['class' => 'btn btn-default']); ?>
        <?= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Archivos', ['archivodir/index','numero' => 11, 'codigo' => $model->id_contrato,'view' => $view], ['class' => 'btn btn-default']) ?>        
        <?php if ($model->contrato_activo == 1){ ?>
        <!-- Inicio Cerrar contrato -->
        <?= Html::a('<span class="glyphicon glyphicon-remove"></span> Cerrar Contrato',            
            ['/contrato/cerrarcontrato','id' => $model->id_contrato],
            [
                'title' => 'Cerrar Contrato',
                'data-toggle'=>'modal',
                'data-target'=>'#modalcerrarcontrato'.$model->id_contrato,
                'class' => 'btn btn-default'
            ]
        );
        ?>
        <?php } ?>
        <div class="modal remote fade" id="modalcerrarcontrato<?= $model->id_contrato ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content"></div>
            </div>
        </div>
        <!-- Fin Cerrar contrato -->
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Contrato
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_contrato') ?>:</th>
                    <td><?= Html::encode($model->id_contrato) ?></td>
                    <th><?= Html::activeLabel($model, 'tiempo_contrato') ?>:</th>
                    <td><?= Html::encode($model->tiempo_contrato) ?></td>
                    <th><?= Html::activeLabel($model, 'id_tipo_contrato') ?>:</th>
                    <td><?= Html::encode($model->tipoContrato->contrato) ?></td>
                    <th><?= Html::activeLabel($model, 'fecha_inicio') ?>:</th>
                    <td><?= Html::encode($model->fecha_inicio) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'identificacion') ?>:</th>
                    <td><?= Html::encode($model->identificacion) ?></td>
                    <th><?= Html::activeLabel($model, 'id_cargo') ?>:</th>
                    <td><?= Html::encode($model->id_cargo) ?></td>
                    <th><?= Html::activeLabel($model, 'descripcion') ?>:</th>
                    <td><?= Html::encode($model->descripcion) ?></td>
                    <th><?= Html::activeLabel($model, 'fecha_final') ?>:</th>
                    <td><?= Html::encode($model->fecha_final) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'funciones_especificas') ?>:</th>
                    <td colspan="3"><?= Html::encode($model->funciones_especificas) ?></td>
                    <th><?= Html::activeLabel($model, 'id_centro_trabajo') ?>:</th>
                    <td><?= Html::encode($model->centroTrabajo->centro_trabajo) ?></td>
                    <th><?= Html::activeLabel($model, 'id_grupo_pago') ?>:</th>
                    <td><?= Html::encode($model->grupoPago->grupo_pago) ?></td>
                </tr>                
                <tr>
                    <th><?= Html::activeLabel($model, 'tipo_salario') ?>:</th>
                    <td><?= Html::encode($model->tipo_salario) ?></td>
                    <th><?= Html::activeLabel($model, 'salario') ?>:</th>
                    <td><?= Html::encode($model->salario) ?></td>
                    <th><?= Html::activeLabel($model, 'auxilio_transporte') ?>:</th>
                    <td><?= Html::encode($model->auxilio_transporte) ?></td>                    
                    <th><?= Html::activeLabel($model, 'horario_trabajo') ?>:</th>
                    <td><?= Html::encode($model->horario_trabajo) ?></td>                    
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'id_tipo_cotizante') ?>:</th>
                    <td><?= Html::encode($model->tipoCotizante->tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'id_subtipo_cotizante') ?>:</th>
                    <td><?= Html::encode($model->subtipoCotizante->subtipo) ?></td>
                    <th><?= Html::activeLabel($model, 'tipo_salud') ?>:</th>
                    <td><?= Html::encode($model->tipo_salud) ?></td>
                    <th><?= Html::activeLabel($model, 'id_entidad_salud') ?>:</th>
                    <td><?= Html::encode($model->entidadSalud->entidad) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'id_caja_compensacion') ?>:</th>
                    <td><?= Html::encode($model->cajaCompensacion->caja) ?></td>
                    <th><?= Html::activeLabel($model, 'id_cesantia') ?>:</th>
                    <td><?= Html::encode($model->cesantia->cesantia) ?></td>
                    <th><?= Html::activeLabel($model, 'tipo_pension') ?>:</th>
                    <td><?= Html::encode($model->tipo_pension) ?></td>
                    <th><?= Html::activeLabel($model, 'id_entidad_pension') ?>:</th>
                    <td><?= Html::encode($model->entidadPension->entidad) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'id_arl') ?>:</th>
                    <td><?= Html::encode($model->arl->arl) ?></td>
                    <th><?= Html::activeLabel($model, 'contrato_activo') ?>:</th>
                    <td><?= Html::encode($model->activo) ?></td>
                    <th><?= Html::activeLabel($model, 'ciudad_laboral') ?>:</th>
                    <td><?= Html::encode($model->ciudad_laboral) ?></td>
                    <th><?= Html::activeLabel($model, 'ciudad_contratado') ?>:</th>
                    <td><?= Html::encode($model->ciudad_contratado) ?></td>
                </tr>                
                <tr>
                    <th><?= Html::activeLabel($model, 'ultimo_pago') ?>:</th>
                    <td><?= Html::encode($model->ultimo_pago) ?></td>
                    <th><?= Html::activeLabel($model, 'ultima_prima') ?>:</th>
                    <td><?= Html::encode($model->ultima_prima) ?></td>
                    <th><?= Html::activeLabel($model, 'ultima_cesantia') ?>:</th>
                    <td><?= Html::encode($model->ultima_cesantia) ?></td>
                    <th><?= Html::activeLabel($model, 'ultima_vacacion') ?>:</th>
                    <td><?= Html::encode($model->ultima_vacacion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'ibp_cesantia_inicial') ?>:</th>
                    <td><?= Html::encode($model->ibp_cesantia_inicial) ?></td>
                    <th><?= Html::activeLabel($model, 'ibp_prima_inicial') ?>:</th>
                    <td><?= Html::encode($model->ibp_prima_inicial) ?></td>
                    <th><?= Html::activeLabel($model, 'ibp_recargo_nocturno') ?>:</th>
                    <td><?= Html::encode($model->ibp_recargo_nocturno) ?></td>
                    <th><?= Html::activeLabel($model, 'id_motivo_terminacion') ?>:</th>
                    <?php if ($model->id_motivo_terminacion){ ?>
                    <td><?= Html::encode($model->motivoTerminacion->motivo) ?></td>
                    <?php }else{ ?>
                    <td></td>
                    <?php } ?>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'comentarios') ?>:</th>
                    <td colspan="7"><?= Html::encode($model->comentarios) ?></td>                    
                </tr>
            </table>
        </div>
    </div>   
</div>
