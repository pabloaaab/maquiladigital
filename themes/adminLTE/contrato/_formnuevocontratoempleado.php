<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamento;
use app\models\Empleado;
use app\models\Contrato;
use app\models\TipoCargo;
use app\models\TipoContrato;
use app\models\TipoCotizante;
use app\models\SubtipoCotizante;
use app\models\Cesantia;
use app\models\CajaCompensacion;
use app\models\Arl;
use app\models\CentroTrabajo;
use app\models\Cargo;
use app\models\EntidadPension;
use app\models\EntidadSalud;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */
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
$ciudadLaboral = ArrayHelper::map(Municipio::find()->all(), 'idmunicipio', 'municipio');
$ciudadContratado = ArrayHelper::map(Municipio::find()->all(), 'idmunicipio', 'municipio');
$entidadSalud = ArrayHelper::map(EntidadSalud::find()->all(), 'id_entidad_salud', 'entidad');
$entidadPension = ArrayHelper::map(EntidadPension::find()->all(), 'id_entidad_pension', 'entidad');
$arl = ArrayHelper::map(Arl::find()->all(), 'id_arl', 'arl');
$cargo = ArrayHelper::map(Cargo::find()->all(), 'id_cargo', 'cargo');
$tipocotizante = ArrayHelper::map(TipoCotizante::find()->all(), 'id_tipo_cotizante', 'tipo');
$subtipocotizante = ArrayHelper::map(SubtipoCotizante::find()->all(), 'id_subtipo_cotizante', 'subtipo');
$caja = ArrayHelper::map(CajaCompensacion::find()->all(), 'id_caja_compensacion', 'caja');
$cesantia = ArrayHelper::map(Cesantia::find()->all(), 'id_cesantia', 'cesantia');
$centroTrabajo = ArrayHelper::map(CentroTrabajo::find()->all(), 'id_centro_trabajo', 'centro_trabajo');
$tipocontrato = ArrayHelper::map(TipoContrato::find()->all(), 'id_tipo_contrato', 'contrato');
?>
<div class="panel panel-success">
    <div class="panel-heading">
        Información Contrato
    </div>
    <div class="panel-body">
        <div class="row">
            <?= $form->field($model, 'id_tipo_contrato')->dropDownList($tipocontrato, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'tiempo_contrato')->dropDownList(['TIEMPO COMPLETO' => 'TIEMPO COMPLETO', 'MEDIO TIEMPO' => 'MEDIO TIEMPO', 'SABATINO' => 'SABATINO'], ['prompt' => 'Seleccione una opcion...']) ?>    
        </div>        
        <div class="row">
            <?=
            $form->field($model, 'fecha_inicio')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true]])
            ?>    
            <?=
            $form->field($model, 'fecha_final')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true]])
            ?>
        </div>                        
        <div class="row">
            <?= $form->field($model, 'id_cargo')->dropDownList($cargo, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
        </div>        
        <div class="row">
            <?= $form->field($model, 'funciones_especificas', ['template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>'])->textarea(['rows' => 3]) ?>
            <?= $form->field($model, 'id_centro_trabajo')->dropDownList($centroTrabajo, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>        
        <div class="row">
            <?= $form->field($model, 'tipo_salario')->dropDownList(['FIJO' => 'FIJO', 'VARIABLE' => 'VAIABLE'], ['prompt' => 'Seleccione una opcion...']) ?>    
            <?= $form->field($model, 'salario')->textInput(['maxlength' => true]) ?>
        </div>                
        <div class="row">
            <?= $form->field($model, 'ciudad_laboral')->dropDownList($ciudadLaboral, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'ciudad_contratado')->dropDownList($ciudadContratado, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'auxilio_transporte')->dropDownList(['0' => 'NO', '1' => 'SI'], ['prompt' => 'Seleccione una opcion...']) ?>    
            <?= $form->field($model, 'horario_trabajo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'id_tipo_cotizante')->dropDownList($tipocotizante, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'id_subtipo_cotizante')->dropDownList($subtipocotizante, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'tipo_salud')->dropDownList(['EMPLEADO' => 'EMPLEADO', 'EMPLEADOR' => 'EMPLEADOR'], ['prompt' => 'Seleccione una opcion...']) ?>  
            <?= $form->field($model, 'id_entidad_salud')->dropDownList($entidadSalud, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>        
        <div class="row">
            <?= $form->field($model, 'tipo_pension')->dropDownList(['EMPLEADO' => 'EMPLEADO', 'EMPLEADOR' => 'EMPLEADOR'], ['prompt' => 'Seleccione una opcion...']) ?>  
            <?= $form->field($model, 'id_entidad_pension')->dropDownList($entidadPension, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'tipo_pension')->dropDownList(['EMPLEADO' => 'EMPLEADO', 'EMPLEADOR' => 'EMPLEADOR'], ['prompt' => 'Seleccione una opcion...']) ?>  
            <?= $form->field($model, 'id_entidad_pension')->dropDownList($entidadPension, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'id_caja_compensacion')->dropDownList($caja, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'id_cesantia')->dropDownList($cesantia, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'id_arl')->dropDownList($arl, ['prompt' => 'Seleccione una opcion...']) ?>
            
        </div>        
        <div class="row" col>
            <?= $form->field($model, 'comentarios', ['template' => '{label}<div class="col-sm-10 form-group">{input}{error}</div>'])->textarea(['rows' => 3]) ?>
        </div>
        <div class="panel-footer text-right">			
            <a href="<?= Url::toRoute("contrato/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>
        </div>
    </div>
</div>
<?php $form->end() ?>     

</div>
