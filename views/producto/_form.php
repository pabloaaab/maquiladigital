<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Cliente;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
		'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
	'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-3 control-label'],
                    'options' => []
                ],
	]); ?>
    
 <div class="panel panel-success">
    <div class="panel-heading">
        <h4>Información Producto</h4>
    </div>
    <div class="panel-body">

		<div class="row">
			<?= $form->field($model, 'codigoproducto')->textInput(['maxlength' => true]) ?>    
        </div>
		<div class="row">
            <?= $form->field($model, 'producto')->textInput(['maxlength' => true]) ?>  					
        </div>		
		<div class="row">
			<?= $form->field($model, 'cantidad')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'stock')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'costoconfeccion')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'vlrventa')->textInput(['maxlength' => true]) ?>
		</div>
        <div class="row">
            <?= $form->field($model, 'idcliente')->widget(Select2::classname(), [
                'data' => $clientes,
                'options' => ['prompt' => 'Seleccione un cliente...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
		<div class="row">
            <?= $form->field($model, 'observacion')->textArea(['maxlength' => true]) ?>
		</div>
		<div class="panel-footer text-left">
			<?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>		
			<a href="<?= Url::toRoute("producto/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>

