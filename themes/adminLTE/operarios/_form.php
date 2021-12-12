<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamento;
use app\models\Operarios;
use app\models\TipoDocumento;
use kartik\date\DatePicker;
use kartik\select2\Select2;

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
$departamento = ArrayHelper::map(Departamento::find()->orderBy('departamento ASC')->all(), 'iddepartamento', 'departamento');
$municipio = ArrayHelper::map(Municipio::find()->orderBy('municipio ASC')->all(), 'idmunicipio', 'municipio');
$tipodocumento = ArrayHelper::map(TipoDocumento::find()->all(), 'id_tipo_documento', 'descripcion');
?>
<div class="panel panel-success">
    <div class="panel-heading">
        Operarios
    </div>
    
    <div class="panel-body">
        <div class="row">
            <?= $form->field($model, 'id_tipo_documento')->dropDownList($tipodocumento, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'documento')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="row">
            <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>    
            <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>
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
            <?=  $form->field($model, 'fecha_nacimiento')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                           'value' => date('Y-m-d', strtotime('+2 days')),
                           'options' => ['placeholder' => 'Seleccione una fecha ...'],
                           'pluginOptions' => [
                               'format' => 'yyyy-m-d',
                               'todayHighlight' => true]])
                       ?>
            <?= $form->field($model, 'estado')->dropDownList(['1' => 'SI', '0' => 'NO'], ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
         <div class="row">
              <?= $form->field($model, 'polivalente')->dropDownList(['1' => 'SI', '0' => 'NO'], ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'vinculado')->dropDownList(['1' => 'SI', '0' => 'NO'], ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'tipo_operaria')->dropDownList(['1' => 'CONFECCION', '2' => 'TERMINACION'], ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        
        <div class="panel-footer text-right">			
            <a href="<?= Url::toRoute("operarios/index") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm",]) ?>
        </div>
    </div>
</div>
<?php $form->end() ?>     

</div>
