<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Editar seguimiento';
?>

<?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-6 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],
        ]);
?>

<div class="panel panel-success">
    <div class="panel-heading">
        Información: Seguimiento
    </div>
    <div class="panel-body">        
        
          <div class="row" col>
            <?= $form->field($model, 'nota', ['template' => '{label}<div class="col-sm-10 form-group">{input}{error}</div>'])->textarea(['rows' => 3]) ?>
        </div>
        <div class="panel-footer text-right">                        
            <a href="<?= Url::toRoute(["incapacidad/view", 'id_seguimiento' => $seguimiento->id_seguimiento, 'id' => $seguimiento->id_incapacidad]) ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm",]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>