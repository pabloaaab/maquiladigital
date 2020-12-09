<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\Session;
use yii\data\Pagination;
use yii\db\ActiveQuery;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Detalles';
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

<div class="modal-body">

    <div class="panel panel-success ">
        <div class="panel-heading">
            Editar detalle
        </div>
        <div class="panel-body">
           <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                    <th scope="col" style='background-color:#B9D5CE;'>Codigo</th>
                    <th scope="col" style='background-color:#B9D5CE;'>Insumo</th>
                    <th scope="col" style='background-color:#B9D5CE;'>Cantidad</th>
                    <th scope="col" style='background-color:#B9D5CE;'>Vlr_unitario</th>
                    <th scope="col" style='background-color:#B9D5CE;'>Total</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php foreach ($detalles as $val): ?>
                    <tr style='font-size: 85%;'>
                    <td><?= $val->id ?></td>    
                    <td><?= $val->codigo_insumo ?></td>
                    <td><?= $val->insumos->descripcion ?></td>
                    <td ><input type="text" name="cantidad[]" style="text-align: right" value="<?= $val->cantidad ?>" required></td>
                    <td><input type="text" name="vlrunitario[]" style="text-align: right" value="<?= $val->vlr_unitario ?>" required></td>
                    <td><?= $val->total ?></td>
                    <input type="hidden" name="iddetalle[]" value="<?= $val->id ?>">
                </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="panel-footer text-right">
            <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['costo-producto/view', 'id' => $id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm",]) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

