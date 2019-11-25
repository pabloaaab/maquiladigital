<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamento;
use app\models\Empleado;
use app\models\EmpleadoTipo;
use app\models\TipoDocumento;
use app\models\EstadoCivil;
use app\models\Horario;
use app\models\BancoEmpleado;
use app\models\Sucursal;
use app\models\CentroCosto;
use app\models\Rh;
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
$estadoCivil = ArrayHelper::map(EstadoCivil::find()->all(), 'id_estado_civil', 'estado_civil');
$tipodocumento = ArrayHelper::map(TipoDocumento::find()->all(), 'id_tipo_documento', 'descripcion');
$horario = ArrayHelper::map(Horario::find()->all(), 'id_horario', 'horario');
$banco_empleado = ArrayHelper::map(BancoEmpleado::find()->all(), 'id_banco_empleado', 'banco');
$centro_costo = ArrayHelper::map(CentroCosto::find()->all(), 'id_centro_costo', 'centro_costo');
$sucursal = ArrayHelper::map(Sucursal::find()->all(), 'id_sucursal', 'sucursal');
$rh = ArrayHelper::map(Rh::find()->all(), 'id_rh', 'rh');
?>
<div class="panel panel-success">
    <div class="panel-heading">
        Información Empleado
    </div>
    <br><br><br>
    <div class="panel-body">
        <div class="row">
            <?= $form->field($model, 'id_empleado_tipo')->dropDownList($tipodempleado, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'id_tipo_documento')->dropDownList($tipodocumento, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'identificacion')->input('text', ['id' => 'cedulanit', 'onchange' => 'calcularDigitoVerificacion()']) ?>                        
            <?= $form->field($model, 'dv')->input('text', ['id' => 'dv', 'readonly' => true, ['style'=>'width:2%']]) ?>
        </div>
        <div class="row">
            <?=
            $form->field($model, 'fecha_expedicion')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true]])
            ?>    
            <?= $form->field($model, 'ciudad_expedicion')->dropDownList($municipio, ['prompt' => 'Seleccione una opcion...']) ?>
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
            <?= $form->field($model, 'iddepartamento')->dropDownList($departamento, [ 'prompt' => 'Seleccione una opcion...', 'onchange' => ' $.get( "' . Url::toRoute('clientes/municipio') . '", { id: $(this).val() } ) .done(function( data ) {
            $( "#' . Html::getInputId($model, 'idmunicipio', ['required', 'class' => 'select-2']) . '" ).html( data ); });']); ?>
            <?= $form->field($model, 'idmunicipio')->dropDownList($municipio, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'barrio')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'id_rh')->dropDownList($rh, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'sexo')->dropDownList(['MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO'], ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'id_estado_civil')->dropDownList($estadoCivil, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'estatura')->textInput(['maxlength' => true]) ?>    
            <?= $form->field($model, 'peso')->textInput(['maxlength' => true]) ?>
        </div>        
        <div class="row">
            <?= $form->field($model, 'libreta_militar')->textInput(['maxlength' => true]) ?>    
            <?= $form->field($model, 'distrito_militar')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="row">
            <?=
            $form->field($model, 'fecha_nacimiento')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true]])
            ?>    
            <?= $form->field($model, 'ciudad_nacimiento')->dropDownList($municipio, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'padre_familia')->dropDownList(['0' => 'NO', '1' => 'SI'], ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'cabeza_hogar')->dropDownList(['0' => 'NO', '1' => 'SI'], ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'id_horario')->dropDownList($horario, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'discapacidad')->dropDownList(['0' => 'NO', '1' => 'SI'], ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'id_banco_empleado')->dropDownList($banco_empleado, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'tipo_cuenta')->dropDownList(['AHORRO' => 'AHORRO', 'CORRIENTE' => 'CORRIENTE'], ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'cuenta_bancaria')->textInput(['maxlength' => true]) ?>    
            <?= $form->field($model, 'id_centro_costo')->dropDownList($centro_costo, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">            
            <?= $form->field($model, 'id_sucursal')->dropDownList($sucursal, ['prompt' => 'Seleccione una opcion...']) ?>
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
