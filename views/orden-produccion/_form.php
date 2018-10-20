<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Cliente;
use app\models\Ordenproducciontipo;
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
        <h4>Información Orden Producción</h4>
    </div>
    <div class="panel-body">																   		
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
            <?= $form->field($model, 'idtipo')->widget(Select2::classname(), [
                'data' => $ordenproducciontipos,
                'options' => ['prompt' => 'Seleccione un tipo ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
		<div class="row">
            <?= $form->field($model,'fechallegada')->widget(DatePicker::className(),['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]]) ?>
        </div>		
		<div class="row">
            <?= $form->field($model,'fechaprocesada')->widget(DatePicker::className(),['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]]) ?>
		</div>
		<div class="row">
            <?= $form->field($model,'fechaentrega')->widget(DatePicker::className(),['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]]) ?>
		</div>
        <div class="row">
            <?= $form->field($model, 'ordenproduccion')->textInput(['maxlength' => true]) ?>
        </div>
		<div class="row">
			<?= $form->field($model, 'observacion')->textArea(['maxlength' => true]) ?>
		</div>
		<div class="panel-footer text-right">			
			<a href="<?= Url::toRoute("orden-produccion/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
			<?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>		
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>

