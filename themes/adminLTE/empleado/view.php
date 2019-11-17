<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */

$this->title = 'Detalle Empleado';
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_empleado;
$view = 'empleado';
?>
<div class="empleado-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_empleado], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_empleado], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', ['imprimir', 'id' => $model->id_empleado], ['class' => 'btn btn-default']); ?>
        <?= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Archivos', ['archivodir/index','numero' => 10, 'codigo' => $model->id_empleado,'view' => $view], ['class' => 'btn btn-default']) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Banco
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_empleado') ?>:</th>
                    <td><?= Html::encode($model->id_empleado) ?></td>
                    <th><?= Html::activeLabel($model, 'tipo_documento') ?>:</th>
                    <td><?= Html::encode($model->tipoDocumento->descripcion) ?></td>
                    <th><?= Html::activeLabel($model, 'identificacion') ?>:</th>
                    <td><?= Html::encode($model->identificacion) ?></td>
                    <th><?= Html::activeLabel($model, 'dv') ?>:</th>
                    <td><?= Html::encode($model->dv) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'tipo_empleado') ?>:</th>
                    <td><?= Html::encode($model->tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'fecha_expedicion') ?>:</th>
                    <td><?= Html::encode($model->fecha_expedicion) ?></td>
                    <th><?= Html::activeLabel($model, 'ciudad_expedicion') ?>:</th>
                    <td><?= Html::encode($model->ciudadExpedicion->municipio) ?></td>
                    <th><?= Html::activeLabel($model, 'rh') ?>:</th>
                    <td><?= Html::encode($model->rh->rh) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'nombre1') ?>:</th>
                    <td><?= Html::encode($model->nombre1) ?></td>
                    <th><?= Html::activeLabel($model, 'nombre2') ?>:</th>
                    <td><?= Html::encode($model->nombre2) ?></td>
                    <th><?= Html::activeLabel($model, 'apellido1') ?>:</th>
                    <td><?= Html::encode($model->apellido1) ?></td>                    
                    <th><?= Html::activeLabel($model, 'apellido2') ?>:</th>
                    <td><?= Html::encode($model->apellido2) ?></td>                    
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'direccion') ?>:</th>
                    <td><?= Html::encode($model->direccion) ?></td>
                    <th><?= Html::activeLabel($model, 'telefono') ?>:</th>
                    <td><?= Html::encode($model->telefono) ?></td>
                    <th><?= Html::activeLabel($model, 'iddepartamento') ?>:</th>
                    <td><?= Html::encode($model->departamento->departamento) ?></td>
                    <th><?= Html::activeLabel($model, 'idmunicipio') ?>:</th>
                    <td><?= Html::encode($model->municipio->municipio) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'barrio') ?>:</th>
                    <td><?= Html::encode($model->barrio) ?></td>
                    <th><?= Html::activeLabel($model, 'celular') ?>:</th>
                    <td><?= Html::encode($model->celular) ?></td>
                    <th><?= Html::activeLabel($model, 'sexo') ?>:</th>
                    <td><?= Html::encode($model->sexo) ?></td>
                    <th><?= Html::activeLabel($model, 'id_estado_civil') ?>:</th>
                    <td><?= Html::encode($model->estadoCivil->estado_civil) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'estatura') ?>:</th>
                    <td><?= Html::encode($model->estatura) ?></td>
                    <th><?= Html::activeLabel($model, 'peso') ?>:</th>
                    <td><?= Html::encode($model->peso) ?></td>
                    <th><?= Html::activeLabel($model, 'libreta_militar') ?>:</th>
                    <td><?= Html::encode($model->libreta_militar) ?></td>
                    <th><?= Html::activeLabel($model, 'distrito_militar') ?>:</th>
                    <td><?= Html::encode($model->distrito_militar) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fecha_nacimiento') ?>:</th>
                    <td><?= Html::encode($model->fecha_nacimiento) ?></td>
                    <th><?= Html::activeLabel($model, 'ciudad_nacimiento') ?>:</th>
                    <td><?= Html::encode($model->ciudadNacimiento->municipio) ?></td>
                    <th><?= Html::activeLabel($model, 'padre_familia') ?>:</th>
                    <td><?= Html::encode($model->padreFamilia) ?></td>
                    <th><?= Html::activeLabel($model, 'cabeza_hogar') ?>:</th>
                    <td><?= Html::encode($model->cabezaHogar) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'horario') ?>:</th>
                    <td><?= Html::encode($model->horario->horario) ?></td>
                    <th><?= Html::activeLabel($model, 'discapacidad') ?>:</th>
                    <td><?= Html::encode($model->discapacitado) ?></td>
                    <th><?= Html::activeLabel($model, 'banco_empleado') ?>:</th>
                    <td><?= Html::encode($model->bancoEmpleado->banco) ?></td>
                    <th><?= Html::activeLabel($model, 'tipo_cuenta') ?>:</th>
                    <td><?= Html::encode($model->tipo_cuenta) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'cuenta_bancaria') ?>:</th>
                    <td><?= Html::encode($model->cuenta_bancaria) ?></td>
                    <th><?= Html::activeLabel($model, 'id_centro_costo') ?>:</th>
                    <td><?= Html::encode($model->centroCosto->centro_costo) ?></td>
                    <th><?= Html::activeLabel($model, 'id_sucursal') ?>:</th>
                    <td><?= Html::encode($model->sucursal->sucursal) ?></td>
                    <th><?= Html::activeLabel($model, 'contrato') ?>:</th>
                    <td><?= Html::encode($model->contratado) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'observacion') ?>:</th>
                    <td colspan="7"><?= Html::encode($model->observacion) ?></td>                    
                </tr>
            </table>
        </div>
    </div>

    <!--<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_empleado',
            'id_empleado_tipo',
            'identificacion',
            'dv',
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'nombrecorto',
            'direccion',
            'telefono',
            'celular',
            'email:email',
            'iddepartamento',
            'idmunicipio',
            'contrato',
            'observacion:ntext',
            'fechaingreso',
            'fecharetiro',
        ],
    ]) ?>-->

</div>
