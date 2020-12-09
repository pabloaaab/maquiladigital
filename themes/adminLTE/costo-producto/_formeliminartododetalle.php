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
$this->title = 'Listado de insumos';
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

<?php
    if ($mensaje != ""){
        ?> <div class="alert alert-danger"><?= $mensaje ?></div> <?php
    }
?>

<div class="table table-responsive">
    <div class="panel panel-success ">
        <div class="panel-heading">
            Detalles
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
                    <th scope="col" style='background-color:#B9D5CE;'><input type="checkbox" onclick="marcar(this);"/></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($detalles as $val): ?>
                <tr style='font-size: 85%;'>
                   <td><?= $val->id ?></td>    
                    <td><?= $val->codigo_insumo ?></td>
                    <td><?= $val->insumos->descripcion ?></td>
                    <td><?= $val->cantidad ?></td>
                    <td><?= $val->vlr_unitario ?></td>
                    <td><?= $val->total ?></td>
                    <td><input type="checkbox" name="seleccion[]" value="<?= $val->id ?>"></td>
                </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="panel-footer text-right">
            <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['costo-producto/view', 'id' => $id], ['class' => 'btn btn-primary']) ?>
            <?= Html::submitButton("<span class='glyphicon glyphicon-trash'></span> Eliminar", ["class" => "btn btn-danger",]) ?>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>