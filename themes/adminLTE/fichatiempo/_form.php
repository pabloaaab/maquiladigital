<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Fichatiempo */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
                'options' => []
            ],
        ]);
?>
<?php
$empleado = ArrayHelper::map(app\models\Empleado::find()->all(), 'id_empleado', 'nombrecorto');
$horario = ArrayHelper::map(app\models\Horario::find()->all(), 'id_horario', 'nombreHorario');
$referencia = ArrayHelper::map(app\models\Producto::find()->all(), 'codigo', 'codigonombre');
?>
<div class="panel panel-success">
    <div class="panel-heading">
        Información Ficha Tiempo
    </div>
    <div class="panel-body">        														   		
        <div class="row">            
            <?= $form->field($model, 'id_empleado')->widget(Select2::classname(), [
            'data' => $empleado,
            'options' => ['placeholder' => 'Seleccione un empleado'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'id_horario')->dropDownList($horario, ['prompt' => 'Seleccione...']) ?>    
        </div>
        <div class="row">            
            <?= $form->field($model, 'referencia')->widget(Select2::classname(), [
            'data' => $referencia,
            'options' => ['placeholder' => 'Seleccione una referencia'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'total_segundos')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="panel-footer text-right">			
            <a href="<?= Url::toRoute("fichatiempo/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
