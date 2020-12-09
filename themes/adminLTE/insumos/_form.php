<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
//modelos
use app\models\TipoMedida;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproducciontipo */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
		'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
	'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-3 control-label'],
                    'options' => []
                ],
	]);
$medida = ArrayHelper::map(TipoMedida::find()->where(['=','estado',1])->orderBy('medida ASC')->all(), 'id_tipo_medida', 'medida');
?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h4></h4>
    </div>
    <div class="panel-body">

        <div class="row">
            <?= $form->field($model, 'codigo_insumo')->textInput(['maxlength' => true]) ?>    
        </div>
        <div class="row">
            <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>    
        </div>
        <div class="row">
                     <?= $form->field($model, 'id_tipo_medida')->widget(Select2::classname(), [
                    'data' => $medida,
                    'options' => ['placeholder' => 'Seleccione...'],
                    'pluginOptions' => [
                        'allowClear' => true ]]);
                    ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'precio_unitario')->textInput(['maxlength' => true]) ?>    
        </div>
        
        <div class="row">
            <?= $form->field($model, 'estado_insumo')->dropdownList(['1' => 'SI', '0' => 'NO'], ['prompt' => 'Seleccione...']) ?>
        </div>
        <div class="panel-footer text-right">            
            <a href="<?= Url::toRoute("insumos/index") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>		
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

