<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamento;
use app\models\Empleado;
use app\models\EmpleadoTipo;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */
/* @var $form yii\widgets\ActiveForm */
?>

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
$departamento = ArrayHelper::map(Departamento::find()->all(), 'iddepartamento', 'departamento');
$municipio = ArrayHelper::map(Municipio::find()->all(), 'idmunicipio', 'municipio');
$tipodempleado = ArrayHelper::map(EmpleadoTipo::find()->all(), 'id_empleado_tipo', 'tipo');
?>
<div class="panel panel-success">
    <div class="panel-heading">
        Información Empleado
    </div>
    <div class="panel-body">
        <div class="row">
            <?= $form->field($model, 'id_empleado_tipo')->dropDownList($tipodempleado, ['prompt' => 'Seleccione...']) ?>
            <?= $form->field($model, 'identificacion')->input('text', ['id' => 'cedulanit', 'onchange' => 'calcularDigitoVerificacion()']) ?>                        
        </div>
        <div class="row">
            <?= $form->field($model, 'contrato')->dropdownList(['1' => 'Activo', '0' => 'Inactivo']) ?>
            <?= $form->field($model, 'dv')->input('text', ['id' => 'dv', 'readonly' => true, ['style'=>'width:2%']]) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'nombre1')->textInput(['maxlength' => true]) ?>    
            <?= $form->field($model, 'nombre2')->textInput(['maxlength' => true]) ?>
        </div>        
        <div class="row">
            <?= $form->field($model, 'apellido1')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'apellido2')->textInput(['maxlength' => true]) ?>
        </div>        
        <div class="row">
            <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>  					
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
        </div>        
        <div class="row">
            <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>                
        <div class="row">
            <?= $form->field($model, 'iddepartamento')->dropDownList($departamento, [ 'prompt' => 'Seleccione...', 'onchange' => ' $.get( "' . Url::toRoute('clientes/municipio') . '", { id: $(this).val() } ) .done(function( data ) {
            $( "#' . Html::getInputId($model, 'idmunicipio', ['required', 'class' => 'select-2']) . '" ).html( data ); });']); ?>
            <?= $form->field($model, 'idmunicipio')->dropDownList($municipio, ['prompt' => 'Seleccione...']) ?>
        </div>                
        <div class="row">
            <?=
            $form->field($model, 'fechaingreso')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true]])
            ?>
            <?=
            $form->field($model, 'fecharetiro')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true]])
            ?>
        </div>        
        <div class="row" col>
            <?= $form->field($model, 'observacion', ['template' => '{label}<div class="col-sm-10 form-group">{input}{error}</div>'])->textarea(['rows' => 3]) ?>
        </div>
        <div class="panel-footer text-right">			
            <a href="<?= Url::toRoute("empleado/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>
        </div>
    </div>
</div>
<?php $form->end() ?>     

</div>
