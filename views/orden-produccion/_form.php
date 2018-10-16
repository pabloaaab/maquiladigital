<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */
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
        <h4>Información Orden Producción</h4>
    </div>
    <div class="panel-body">
		<div class="row">            
			<?= $form->field($model, 'idordenproduccion')->textInput(['maxlength' => true]) ?>
		</div>														   		
		<div class="row">			
			<?= $form->field($model, 'idcliente')->dropDownList($clientes, ['prompt' => 'Seleccione un cliente']) ?>	
        </div>
		<div class="row">
            <?= $form->field($model, 'fechallegada')->textInput(['maxlength' => true]) ?>  					
        </div>		
		<div class="row">
			<?= $form->field($model, 'fechaprocesada')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'fechaentrega')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'totalorden')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'valorletras')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'usuariosistema')->textInput(['maxlength' => true]) ?>
		</div>		
		<div class="panel-footer text-left">
			<?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>		
			<a href="<?= Url::toRoute("orden-produccion/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>

