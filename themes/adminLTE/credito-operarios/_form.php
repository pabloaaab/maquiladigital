<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\TipoPagoCredito;
use app\models\ConfiguracionCredito;
use app\models\Operarios;
use kartik\select2\Select2;
use kartik\date\DatePicker;

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = ['label' => 'Prestamo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$form = ActiveForm::begin([
            "method" => "post",
            'id' => 'formulario',
            'enableClientValidation' => false,
            'enableAjaxValidation' => false,
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => []
        ],
        ]);
$operario = ArrayHelper::map(Operarios::find()->where(['=','estado',1])->orderBy('nombrecompleto ASC')->all(), 'id_operario', 'nombrecompleto');
$tipopagocredito = ArrayHelper::map(TipoPagoCredito::find()->where(['=','estado',1])->orderBy('descripcion ASC')->all(), 'id_tipo_pago', 'descripcion');
$configuracioncredito = ArrayHelper::map(ConfiguracionCredito::find()->orderBy( 'nombre_credito ASC')->all(), 'codigo_credito', 'nombre_credito');
?>
        <div class="panel panel-success">
            <div class="panel-heading">
                Información: Prestamo
            </div>
            <div class="panel-body">
                <div class="row">

                     <?= $form->field($model, 'id_operario')->widget(Select2::classname(), [
                    'data' => $operario,
                    'options' => ['placeholder' => 'Seleccione ....'],
                    'pluginOptions' => [
                        'allowClear' => true ]]);
                    ?>
                    <?= $form->field($model, 'codigo_credito')->widget(Select2::classname(), [
                    'data' => $configuracioncredito,
                    'options' => ['placeholder' => 'Seleccione...'],
                    'pluginOptions' => [
                        'allowClear' => true ]]);
                    ?>
                </div>   
                <div class="row">
                     <?= $form->field($model, 'vlr_credito')->textInput(['maxlength' => true]) ?>
                     <?= $form->field($model, 'vlr_cuota')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="row">
                    <?= $form->field($model, 'numero_cuotas')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'numero_cuota_actual')->textInput(['maxlength' => true]) ?>
                </div>
                 <div class="row">
                      <?=  $form->field($model, 'fecha_inicio')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                           'value' => date('Y-m-d', strtotime('+2 days')),
                           'options' => ['placeholder' => 'Seleccione una fecha ...'],
                           'pluginOptions' => [
                               'format' => 'yyyy-m-d',
                               'todayHighlight' => true]])
                       ?>
                     <div class="checkbox checkbox-success" align ="center"><?= $form->field($model, 'validar_cuotas')->checkBox(['class'=>'bs_switch','style'=>'margin-bottom:5px;align:center', 'id'=>'validar_cuotas', 'label' => 'Validar cuota','' =>'small']) ?></div>
                 </div>   
                
                <div class="row">
                    <?= $form->field($model, 'saldo_credito')->input('text', ['saldo_credito', 'readonly' => TRUE, ['style' => 'width:15%']]) ?> 
                    <?= $form->field($model, 'observacion')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="panel-footer text-right">			
                    <a href="<?= Url::toRoute("credito-operarios/index") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm",]) ?>
                </div>
            </div>
        </div>
<?php $form->end() ?>     
