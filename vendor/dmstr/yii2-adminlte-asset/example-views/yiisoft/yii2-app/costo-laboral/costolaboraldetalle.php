<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\CostoLaboral;
use app\models\CostoLaboralDetalle;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\db\ActiveQuery;

/* @var $this yii\web\View */
/* @var $model app\models\CostoLaboral */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$this->title = 'Costo Laboral';

$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([

    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
]); ?>

<div class="panel panel-success">
    <div class="panel-heading">
        Costo Laboral
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th><?= Html::activeLabel($costolaboral, 'id_costo_laboral') ?>:</th>
                <td><?= Html::encode($costolaboral->id_costo_laboral) ?></td>
                <th><?= Html::activeLabel($costolaboral, 'id_costo_laboral') ?>:</th>
                <td><?= Html::encode($costolaboral->id_costo_laboral) ?></td>                    
            </tr>                                               
        </table>
    </div>
</div>

<div class="panel panel-success ">
    <div class="panel-heading">
        Detalle Costo Laboral
    </div>
    <div class="panel-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Código</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Costo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($costolaboraldetalle as $val): ?>
                    <tr>                    
                        <td><input type="number" name="nroempleados[]" value="<?= $val->nroempleados ?>" required></td>
                        <td><input type="number" name="salario[]" value="<?= $val->salario ?>" required></td>
                        <td><input type="number" name="auxilio_transporte[]" value="<?= $val->auxilio_transporte ?>" required></td>
                        <td><input type="hidden" name="id_carta_laboral_detalle[]" value="<?= $val->id_carta_laboral_detalle ?>"></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="panel-footer text-right">            
        <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar", ["class" => "btn btn-success",]) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

