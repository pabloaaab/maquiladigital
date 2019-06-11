<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgresoTipo */

$this->title = 'Detalle Comprobante Egreso Tipo';
$this->params['breadcrumbs'][] = ['label' => 'Comprobante Egresos Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_comprobante_egreso_tipo;
?>
<div class="comprobante-egreso-tipo-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_comprobante_egreso_tipo], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_comprobante_egreso_tipo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Comprobante Egreso Tipo
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_comprobante_egreso_tipo') ?>:</th>
                    <td><?= Html::encode($model->id_comprobante_egreso_tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'concepto') ?>:</th>
                    <td><?= Html::encode($model->concepto) ?></td>
                    <th><?= Html::activeLabel($model, 'activo') ?>:</th>
                    <td><?= Html::encode($model->estado) ?></td>
                </tr>                                                
            </table>
        </div>
    </div>
    <?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
    ]); ?>
    <div class="table-responsive">
        <div class="panel panel-success ">
            <div class="panel-heading">
                Cuentas:  <?= $registros ?>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Cuenta</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Base</th>                        
                        <th scope="col"><input type="checkbox" onclick="marcar(this);"/></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($modeldetalles as $val): ?>
                    <tr>
                        <?php if ($val->tipocuenta == 1){$tipo = "DEBITO";}else{$tipo = "CREDITO";} ?>                        
                        <?php if ($val->base == 0){$base = "NO";}else{$base = "SI";} ?>                        
                        <td><?= $val->id_comprobante_egreso_tipo_cuenta ?></td>                        
                        <td><?= $val->cuenta ?></td>
                        <td><?= $tipo ?></td>
                        <td><?= $base ?></td>                        
                        <td><input type="checkbox" name="id_comprobante_egreso_tipo_cuenta[]" value="<?= $val->id_comprobante_egreso_tipo_cuenta ?>"></td>
                    </tr>
                    </tbody>
                    <?php endforeach; ?>
                </table>
            </div>            
                <div class="panel-footer text-right">
                    <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['comprobante-egreso-tipo/nuevodetalles', 'id_comprobante_egreso_tipo' => $model->id_comprobante_egreso_tipo], ['class' => 'btn btn-success']) ?>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-trash'></span> Eliminar", ["class" => "btn btn-danger", 'name' => 'eliminar']) ?>
                </div>            
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>