<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Contrato;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
?>


<?php
$form = ActiveForm::begin([
            "method" => "post",
            'id' => 'formulario',
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => []
        ],
        ]);
?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">        
        <div class="table table-responsive">
            <div class="panel panel-success ">
                <div class="panel-heading">
                   Nueva Cantidad de operarios..
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?= $form->field($model, 'cantidad_empleados')->textInput(['maxlength' => true]) ?>  
                        <?= $form->field($model, 'fecha_inicio')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
                        	
                    </div>    
                     <div class="row">
                        <?= $form->field($model, 'tiempo_balanceo')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
                         <?= $form->field($model, 'fecha_final')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
                        	
                    </div>
                    <div class="row">
                        <?= $form->field($model, 'idordenproduccion')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
                    </div>
                </div>        
            </div>   
            
                 <div class="panel-footer text-right">			
                <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar", ["class" => "btn btn-primary", 'name' => 'actualizaroperario']) ?>                    
            </div>
            </div>    
            
        </div>
    </div>
<?php $form->end() ?> 