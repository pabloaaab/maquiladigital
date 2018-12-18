<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Arl;

/* @var $this yii\web\View */
/* @var $model app\models\Resumencostos */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Resumen Costos';
$this->params['breadcrumbs'][] = $this->title;

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
$arl = ArrayHelper::map(Arl::find()->all(), 'id_arl', 'arl');
?>
<div class="panel panel-success">
    <div class="panel-heading">
        Resumen Costos
    </div>
    <div class="panel-body">        
        <div class="row">
            <div class="col-sm-3 control-label">
                <?= Html::activeLabel($model, 'costo_laboral') ?>:
            </div>
            <div class="col-sm-1 control-label">
                <?= "$ ".number_format(Html::encode($model->costo_laboral)) ?>
            </div>                
        </div>
        <div class="row">
            <div class="col-sm-3 control-label">
                <?= Html::activeLabel($model, 'costo_fijo') ?>:
            </div>
            <div class="col-sm-1 control-label">
                <?= "$ ".number_format(Html::encode($model->costo_fijo)) ?>
            </div>                
        </div>
        <div class="row">
            <div class="col-sm-3 control-label">
                <?= Html::activeLabel($model, 'total_costo') ?>:
            </div>
            <div class="col-sm-1 control-label">
                <?= "$ ".number_format(Html::encode($model->total_costo)) ?>
            </div>                
        </div>
        <div class="row">
            <div class="col-sm-3 control-label">
                <?= Html::activeLabel($model, 'costo_diario') ?>:
            </div>
            <div class="col-sm-1 control-label">
                <?= "$ ".number_format(Html::encode($model->costo_diario)) ?>
            </div>                
        </div>                        
        <div class="panel-footer text-right">			                        
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar", ["class" => "btn btn-success",]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
