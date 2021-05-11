<?php

use app\models\EntidadSalud;
use app\models\Banco;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;

$this->title = 'Pago de incapacidad';
$this->params['breadcrumbs'][] = ['label' => 'Pago', 'url' => ['index']];
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
?>
<?php
$eps = ArrayHelper::map(EntidadSalud::find()->orderBy('entidad ASC')->all(), 'id_entidad_salud', 'entidad');
$bancaria = ArrayHelper::map(Banco::find()->orderBy('entidad ASC')->all(), 'idbanco', 'entidad');
?>
<div class="panel panel-success">
    <div class="panel-heading">
        Pago de incapacidades
    </div>
    <div class="panel-body">
        <div class="row">
             <?= $form->field($model, 'id_entidad_salud')->widget(Select2::classname(), [
            'data' => $eps,
            'options' => ['placeholder' => 'Seleccione la eps'],
            'pluginOptions' => [
                'allowClear' => true ]]);
            ?>
            
           <?= $form->field($model, 'idbanco')->widget(Select2::classname(), [
            'data' => $bancaria,
            'options' => ['placeholder' => 'Forma de pago'],
            'pluginOptions' => [
                'allowClear' => true ]]);
            ?>
       </div>
        <div class="row">      
             <?=  $form->field($model, 'fecha_pago_entidad')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('Y-m-d', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
        </div>
        
        <div class="row" col>
            <?= $form->field($model, 'observacion', ['template' => '{label}<div class="col-sm-10 form-group">{input}{error}</div>'])->textarea(['rows' => 3]) ?>
        </div>
        <div class="panel-footer text-right">
            <a href="<?= Url::toRoute("incapacidad/indexpagoincapacidad") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm",]) ?>        
        </div>
  </div>
</div>    
<?php $form->end() ?>
