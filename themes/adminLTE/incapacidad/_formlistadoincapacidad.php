<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Incapacidad;
//clases
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use yii\db\ActiveQuery;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventadetalle */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Listado de incapacidades';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute(["incapacidad/nuevodetalleincapacidad", 'id_pago' => $id_pago, 'id_eps' => $id_eps]),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    
	'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],
    

]);
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading">
        Parametros de entrada
    </div>
	
    <div class="panel-body" id="buscarmaquina">
        <div class="row" >
            <?= $formulario->field($form, "q")->input("search") ?>            
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute(["incapacidad/nuevodetalleincapacidad", 'id_pago' => $id_pago, 'id_eps' => $id_eps]) ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>

<?php $formulario->end() ?>

<?php
$form = ActiveForm::begin([
            "method" => "post",
            'id' => 'formulario',
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'options' => []
            ],
        ]);
?>

<?php
if ($mensaje != ""){
    ?> <div class="alert alert-danger"><?= $mensaje ?></div> <?php
}
?>

<div class="table table-responsive">
    <div class="panel panel-success ">
        <div class="panel-heading">
            Registros  <span class="badge"><?= count($incapacidades) ?> </span>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                    <th scope="col" style='background-color:#B9D5CE;'>Nr. incapacidad</th>
                    <th scope="col" style='background-color:#B9D5CE;'>Tipo incapacidad</th>
                     <th scope="col" style='background-color:#B9D5CE;'>Documento</th>
                    <th scope="col" style='background-color:#B9D5CE;'>Empleado</th>                    
                    <th scope="col" style='background-color:#B9D5CE;'>Fecha inicio</th> 
                    <th scope="col" style='background-color:#B9D5CE;'>Fecha final</th> 
                    <th scope="col" style='background-color:#B9D5CE;'><span title="Total dias incapacitado">Td</span></th>
                    <th scope="col" style='background-color:#B9D5CE;'><span title="Dias a cobrar">Dc</span></th>
                    <th scope="col" style='background-color:#B9D5CE;'>Vr. cobro</th> 
                    <th scope="col" style='background-color:#B9D5CE;'><input type="checkbox" onclick="marcar(this);"/></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($incapacidades as $val): ?>
                    <tr style="font-size: 85%;">
                    <td><?= $val->id_incapacidad ?></td>
                    <td><?= $val->numero_incapacidad ?></td>
                      <td><?= $val->codigoIncapacidad->nombre ?></td>
                    <td><?= $val->identificacion ?></td>
                    <td><?= $val->empleado->nombrecorto ?></td>
                    <td><?= $val->fecha_inicio ?></td>
                    <td><?= $val->fecha_final ?></td>
                    <td><?= $val->dias_incapacidad ?></td>
                    <td><?= $val->dias_cobro_eps ?></td>
                    <td style="text-align: right"><?= '$'.number_format($val->vlr_saldo_administradora,0) ?></td>
                    <td style="width: 30px;"><input type="checkbox" name="id_incapacidad[]" value="<?= $val->id_incapacidad ?>"></td>
                </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="panel-footer text-right">
            <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['incapacidad/viewdetallepago', 'id_pago' => $id_pago], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Enviar", ["class" => "btn btn-success btn-sm",]) ?>
        </div>

    </div>
</div>

<?php $form->end() ?>    

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