<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventa */
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
        <h4>Información Factura Venta</h4>
    </div>
    <div class="panel-body">
		<div class="row">            
			<?= $form->field($model, 'nrofactura')->textInput(['maxlength' => true]) ?>
		</div>														   		
		<div class="row">
			<?= $form->field($model, 'fechainicio')->textInput(['maxlength' => true]) ?>    
        </div>
		<div class="row">
            <?= $form->field($model, 'fechavcto')->textInput(['maxlength' => true]) ?>  					
        </div>		
		<div class="row">
			<?= $form->field($model, 'formapago')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'plazopago')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'porcentajeiva')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'porcentajefuente')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'porcentajereteiva')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'subtotal')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'retencionfuente')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'impuestoiva')->textInput() ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'retencioniva')->textInput() ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'totalpagar')->textInput() ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'valorletras')->textInput() ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'idcliente')->textInput() ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'idordenproduccion')->textInput() ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'usuariosistema')->textInput() ?>
		</div>	
		<div class="panel-footer text-left">
			<?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>		
			<a href="<?= Url::toRoute("facturaventa/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>

