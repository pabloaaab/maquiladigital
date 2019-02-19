<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $model app\models\SeguimientoProduccion */
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

<div class="panel panel-success">
    <div class="panel-heading">
        Información Seguimiento Produccion
    </div>
    <div class="panel-body">        														   		
        <div class="row">
            <?= $form->field($model,'fecha_inicio_produccion')->widget(DatePicker::className(),['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]]) ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'idcliente')->dropDownList($clientes,['prompt'=>'Seleccione un cliente...', 'onchange'=>' $.get( "'.Url::toRoute('facturaventa/ordenp').'", { id: $(this).val() } ) .done(function( data ) {
        $( "#'.Html::getInputId($model, 'idordenproduccion',['required', 'class' => 'select-2']).'" ).html( data ); });']); ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'idordenproduccion')->dropDownList($ordenesproduccion,['prompt' => 'Seleccione una orden de producción...']) ?>
        </div>
        <div class="row">            
            <?= $form->field($model, 'hora_inicio')->widget(TimePicker::classname(), []); ?>
        </div>                                        
        <div class="panel-footer text-right">			
            <a href="<?= Url::toRoute("seguimiento-produccion/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>