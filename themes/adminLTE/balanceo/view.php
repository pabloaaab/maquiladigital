<?php
//clases
use yii\bootstrap\Progress;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\Session;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\AccessControl;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */

$this->title = 'Detalle modulo';
$this->params['breadcrumbs'][] = ['label' => 'Detalle modulo', 'url' => ['proceso']];
$this->params['breadcrumbs'][] = $model->idordenproduccion;
$operarios = ArrayHelper::map(\app\models\Operarios::find()->where(['=','estado', 1])->orderBy('nombrecompleto ASC')->all(), 'id_operario', 'nombrecompleto');
?>
<div class="ordenproduccionproceso-view">
    <div class="btn-group" role="group" aria-label="...">
        <button type="button" class="btn btn-default btn"> <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'],['class' => 'btn btn-primary btn-xs']) ?></button>
    </div>    
    <div class="panel panel-success">
        <div class="panel-heading">
            Detalle del registro
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Id')?>:</th>
                    <td><?= Html::encode($model->id_balanceo) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Nro_modulo') ?>:</th>
                    <td><?= Html::encode($model->modulo) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Orden_Produccion') ?>:</th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Operarios') ?>:</th>
                    <td align="right"><?= Html::encode($model->cantidad_empleados) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_inicio') ?>:</th>
                    <td><?= Html::encode($model->fecha_inicio) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_terminación') ?>:</th>
                    <td><?= Html::encode($model->fecha_terminacion) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Cliente') ?>:</th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Abierto') ?>:</th>
                    <td><?= Html::encode($model->estadomodulo) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Usuario') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_creación') ?>:</th>
                    <td><?= Html::encode($model->fecha_creacion) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Observaciones') ?>:</th>
                    <td colspan="3"><?= Html::encode($model->observacion) ?></td>
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
    ]);?>
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#flujo" aria-controls="flujo" role="tab" data-toggle="tab">Operaciones: <span class="badge"><?= count($flujo_operaciones) ?></span></a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="flujo">
                <div class="table-responsive">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Operacion</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Op</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Segundos</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Minutos</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Orden</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Maquina</th>
                                        <th scope="col" style='background-color:#B9D5CE;'>Operarios</th>
                                        <th scope="col" style='background-color:#B9D5CE;'></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalsegundos = 0;
                                    $totalminutos = 0;
                                    foreach ($flujo_operaciones as $val):
                                        $totalminutos += $val->minutos;
                                        $totalsegundos += $val->segundos;
                                        ?>
                                         <tr style="font-size: 85%;">
                                            <td><?= $val->id?></td>
                                            <td><?= $val->proceso->proceso ?></td>
                                            <td><?= $val->idordenproduccion ?></td>
                                            <td><?= $val->segundos ?></td>
                                            <td><?= $val->minutos ?></td>
                                             <td><?= $val->orden_aleatorio ?></td>
                                             <td><?= $val->tipomaquina->descripcion ?></td>
                                            <td><?= Html::dropDownList('id_operario[]', '', $operarios, ['class' => 'col-sm-12', 'prompt' => 'Seleccion el operario']) ?></td>
                                            <input type="hidden" name="id_balanceo[]" value="<?= $model->id_balanceo ?>">
                                            <input type="hidden" name="idproceso[]" value="<?= $val->idproceso ?>">
                                            <input type="hidden" name="id_tipo[]" value="<?= $val->id_tipo ?>">
                                            <input type="hidden" name="segundos[]" value="<?= $val->segundos ?>">
                                            <input type="hidden" name="minutos[]" value="<?= $val->minutos ?>">
                                            <input type="hidden" name="totalminutos[]" value="<?= $totalminutos ?>">
                                            <input type="hidden" name="totalsegundos[]" value="<?= $totalsegundos ?>">
                                            <td></td>
                                        </tr>
                                   <?php endforeach; ?>
                                </tbody>  
                                <td colspan="3"></td><td style="font-size: 85%;"><b>Total:</b> <?= $totalsegundos ?> <td style="font-size: 85%;"><b>Total:</b> <?= $totalminutos ?></td><td colspan="4"></td>
                            </table>
                        </div>   
                        <div class="panel-footer text-right">
                            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm", 'name' => 'guardar']) ?>
                        </div>
                    </div>
                </div>    
            </div>
          <!--- TERMINA EL TABS-->
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
