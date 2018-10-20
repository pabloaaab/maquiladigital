<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Cliente;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;


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
 <?php

 ?>
 <div class="panel panel-success">
    <div class="panel-heading">
        <h4>Información Orden Producción Detalle</h4>
    </div>
    <div class="panel-body">																   		
		<div class="row">
            <?= $form->field($model, 'cantidad')->textInput(['maxlength' => true]) ?>
        </div>
		<div class="row">
            <?= $form->field($model, 'vlrprecio')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'idordenproduccion')->textInput(['maxlength' => true]) ?>
        </div>

		<div class="panel-footer text-right">			

			<?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>		
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>

