<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\ConfiguracionPension;
use app\models\ConceptoSalarios;
use kartik\select2\Select2;
?>

<?php
$form = ActiveForm::begin([
            "method" => "post",
            'id' => 'formulario',
            'enableClientValidation' => false,
            'enableAjaxValidation' => false,
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => []
        ],
        ]);
?>
<?php
   $salarios = ArrayHelper::map(ConceptoSalarios::find()-> where(['=','concepto_pension',1])->all(), 'codigo_salario', 'nombre_concepto');
?>
<body>
<!--<h1>Editar Cliente</h1>-->

<div class="panel panel-success">
    <div class="panel-heading">
        Información de Pension
    </div>
    <div class="panel-body">        														   		
        <div class="row">
            <?= $form->field($model, 'codigo_salario')->dropDownList($salarios, ['prompt' => 'Seleccione concepto']) ?>
            <?= $form->field($model, 'concepto')->textInput(['maxlength' => true]) ?>    
        </div>
        <div class="row">
            <?= $form->field($model, 'porcentaje_empleado')->textInput(['maxlength' => true]) ?>
             <?= $form->field($model, 'porcentaje_empleador')->textInput(['maxlength' => true]) ?>
        </div>		
        <div class="panel-footer text-right">                
            <a href="<?= Url::toRoute("configuracion-pension/index") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm",]) ?>		
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>