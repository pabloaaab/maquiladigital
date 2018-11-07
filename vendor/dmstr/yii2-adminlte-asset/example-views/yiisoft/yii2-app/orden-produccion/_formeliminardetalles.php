<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Ordenproduccion;
use app\models\Producto;
use app\models\Ordenproducciondetalle;
use app\models\OrdenproduccionSearch;
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
?>

<?php
$this->title = 'Eliminar Detalles Ordenes de Producción ' .$idordenproduccion;
$this->params['breadcrumbs'][] = ['label' => 'Volver Detalle', 'url' => ['view','id' => $idordenproduccion]];
$this->params['breadcrumbs'][] = $idordenproduccion;
?>

<?php $form = ActiveForm::begin([

    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
]); ?>

<?php
if ($mensaje != ""){
    ?> <div class="alert alert-danger"><?= $mensaje ?></div> <?php
}
?>

<div class="table table-responsive">
    <div class="panel panel-success ">
        <div class="panel-heading">
            Eliminar detalle Orden de prducción
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
                    <th scope="col">Subtotal</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($mds as $val): ?>
                <tr>
                    <td><?= $val->iddetalleorden ?></td>
                    <td><?= $val->producto->nombreProducto ?></td>
                    <td><?= $val->codigoproducto ?></td>
                    <td><?= $val->cantidad ?></td>
                    <td><?= '$ '.number_format($val->vlrprecio,2) ?></td>
                    <td><?= '$ '.number_format($val->subtotal,2) ?></td>
                    <td><input type="checkbox" name="seleccion[]" value="<?= $val->iddetalleorden ?>"></td>
                </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="panel-footer text-right">
            <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['orden-produccion/view', 'id' => $idordenproduccion], ['class' => 'btn btn-primary']) ?>
            <?= Html::submitButton("<span class='glyphicon glyphicon-trash'></span> Eliminar", ["class" => "btn btn-danger",]) ?>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>

