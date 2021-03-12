<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Cliente;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal condensed ', 'role' => 'form'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
                'options' => []
            ],
        ]);
?>
<?php ?>
<div class="panel panel-success">
    <div class="panel-heading">
        Nuevo
    </div>
    <div class="panel-body">
        <div class="row">
            <?= $form->field($model, 'idcliente')->dropDownList($clientes,['prompt'=>'Seleccione un cliente...', 'onchange'=>' $.get( "'.Url::toRoute('orden-produccion/ordenes').'", { id: $(this).val() } ) .done(function( data ) {
        $( "#'.Html::getInputId($model, 'idordenproduccion',['required', 'class' => 'select-2']).'" ).html( data ); });']); ?>
        </div>
        <div class="row">            
            <?= $form->field($model, 'idordenproduccion')->widget(Select2::classname(), [
            'data' => $orden,
            'options' => ['placeholder' => 'Seleccione la orden'],
            'pluginOptions' => [
                'allowClear' => true ]]);
            ?>
        </div>
        <div class="row">
               <?= $form->field($model, 'tipo_proceso')->dropDownList(['1'=> 'ENTRADA', '2'=> 'SALIDA'], ['prompt' => 'Seleccione']) ?>
        </div>
        <div class="row">
            <?=
            $form->field($model, 'fecha_entrada_salida')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'observacion')->textArea(['maxlength' => true]) ?>
        </div>
        <div class="panel-footer text-right">			
            <a href="<?= Url::toRoute("orden-produccion/indexentradasalida") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm",]) ?>		
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

