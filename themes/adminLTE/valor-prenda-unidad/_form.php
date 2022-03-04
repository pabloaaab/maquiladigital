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
$tipo = ArrayHelper::map(app\models\Ordenproducciontipo::find()->all(), 'idtipo', 'tipo');
$proceso_confeccion = ArrayHelper::map(\app\models\ProcesoConfeccionPrenda::find()->orderBy('id_proceso_confeccion ASC')->all(),'id_proceso_confeccion','descripcion_proceso');
?>
<div class="panel panel-success">
    <div class="panel-heading">
        Valor prenda
    </div>
    <div class="panel-body">        														   		
        <div class="row">            
            <?= $form->field($model, 'idordenproduccion')->widget(Select2::classname(), [
            'data' => $orden,
            'options' => ['placeholder' => 'Seleccione la orden'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        </div>
        <div class="row">            
            <?= $form->field($model, 'idtipo')->widget(Select2::classname(), [
            'data' => $tipo,
            'options' => ['placeholder' => 'Seleccione el servicio'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>    
        </div>
        <div class="row">
            <?= $form->field($model, 'id_proceso_confeccion')->widget(Select2::classname(), [
             'data' => $proceso_confeccion,
             'options' => ['placeholder' => 'Seleccione.... '],
             'pluginOptions' => [
             'allowClear' => true ]]);
            ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'vlr_vinculado')->textInput(['maxlength' => true]) ?>  
        </div>
        
        <div class="row">
            <?= $form->field($model, 'vlr_contrato')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="panel-footer text-right">			
            <a href="<?= Url::toRoute("valor-prenda-unidad/index") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm",]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
