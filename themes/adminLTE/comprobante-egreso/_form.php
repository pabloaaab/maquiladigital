<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso*/
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
<!--<h1>Editar Cliente</h1>-->

<div class="panel panel-success">
    <div class="panel-heading">
        Información Comprobante Egreso
    </div>
    <div class="panel-body">        														   		
        <div class="row">            
            <?= $form->field($model, 'id_proveedor')->dropDownList($proveedores, ['prompt' => 'Seleccione un proveedor...']) ?>
        </div>
        <div class="row">                        
            <?= $form->field($model, 'id_comprobante_egreso_tipo')->dropDownList($tipo, ['prompt' => 'Seleccione un tipo...']) ?>
        </div>                                        
        <div class="row">            
            <?= $form->field($model, 'id_banco')->dropDownList($bancos, ['prompt' => 'Seleccione un banco...']) ?>
        </div>
        <div class="row">            
            <?=  $form->field($model, 'fecha_comprobante')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'id_municipio')->widget(Select2::classname(), [
                'data' => $municipios,
                'options' => ['prompt' => 'Seleccione un municipio ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'observacion')->textarea() ?>
        </div>                
        <div class="panel-footer text-right">			
            <a href="<?= Url::toRoute("/comprobante-egreso/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


