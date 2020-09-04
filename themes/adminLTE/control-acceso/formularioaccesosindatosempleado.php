<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\TipoDocumento;
use app\models\SintomasCovid;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\ssss */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Control de Acceso Covid';
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

$municipio = ArrayHelper::map(Municipio::find()->all(), 'idmunicipio', 'municipio');
$tipodocumento = ArrayHelper::map(TipoDocumento::find()->all(), 'id_tipo_documento', 'descripcion');
$sintomascovid = ArrayHelper::map(SintomasCovid::find()->all(), 'id', 'sintoma');

?>
<div class="panel panel-success">
    <div class="panel-heading">
        Información Control Acceso
    </div>    
    <div class="panel-body">
        <div class="row">            
            <?= $form->field($model, 'tipo_documento')->dropDownList($tipodocumento, ['prompt' => 'Seleccione una opcion...']) ?>
            <?= $form->field($model, 'documento')->input('text', ['value' => $id, 'readonly' => true]) ?> 
        </div>        
        <div class="row">  
            <?= $form->field($model, 'nombrecompleto')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'idmunicipio')->dropDownList($municipio, ['prompt' => 'Seleccione una opcion...']) ?>
        </div>                       
        <div class="row">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>  
            <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>
        </div>   
        <div class="row">
            <?= $form->field($model, 'temperatura_inicial')->textInput(['maxlength' => true]) ?>  
            <?= $form->field($model, "tiene_sintomas")->dropdownList(['0' => 'NO', '1' => 'SI'], ['prompt' => 'Seleccione...']) ?>
        </div>
        <div class="row">           
            <?= $form->field($model, 'observacion')->textArea(['maxlength' => true]) ?>
            <?=
                $form->field($model, 'sintomascovid[]')->checkboxList($sintomascovid,[
                    'item' => function($index, $label, $name, $checked, $value) {
                    $checked = $checked ? 'checked' : '';
                    return "<label class='checkbox col-sm-4' style='font-weight: normal;'><input type='checkbox' {$checked} name='{$name}' value='{$value}'>{$label}</label>";
                    }
                ])
            ?>
        </div>           
        <div class="panel-footer text-right">			
            <a href="<?= Url::toRoute("control-acceso/validar") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>
        </div>
    </div>
</div>
<?php $form->end() ?>     

</div>
