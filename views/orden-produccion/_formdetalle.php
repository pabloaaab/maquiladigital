<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Ordenproduccion;
use app\models\OrdenProduccionDetalle;
use app\models\OrdenproduccionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
		'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
	'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-3 control-label'],
                    'options' => []
                ],
	]); ?>	
	
	<?php $model = OrdenProduccionDetalle::find()->where(['iddetalleorden' => $iddetalleorden])->one();  
		  if ($model){
			$idproducto = $model->idproducto;
			$cantidad = $model->cantidad;
			$vlrprecio = $model->vlrprecio;
			$subtotal = $model->subtotal;
			$idordenproduccion = $model->idordenproduccion;			
		  }else{
			$idproducto = null;
			$cantidad = null;
			$vlrprecio = null;
			$subtotal = null;
			$idordenproduccion = $idordenproduccion;
		  }	
	?>
 <div class="panel panel-success">
    
    <div class="panel-body">
		<table class="table table-">
			<tr><input type="hidden" name="iddetalleorden" value="<?= $iddetalleorden ?>">
				<input type="hidden" name="idordenproduccion" value="<?= $idordenproduccion ?>">
				<td>Idproducto:</td>
				<td><?= Html::textInput('idproducto', $idproducto, ['id' => 'idproducto', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>
				<td>Cantidad:</td>
				<td><?= Html::textInput('cantidad', $cantidad, ['id' => 'cantidad', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%', 'onkeypress' => 'return valida(event)', 'required' => true]) ?></td>											
			</tr>
			<tr>
				<td>Valor Precio:</td>
				<td><?= Html::textInput('vlrprecio', $vlrprecio, ['id' => 'vlrprecio', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>
				<td>Subtotal:</td>
				<td><?= Html::textInput('subtotal', $subtotal, ['id' => 'subtotal', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>											
			</tr>
			<tr>
				<td>Idordenproduccion:</td>
				<td><?= Html::textInput('idordenproduccion', $idordenproduccion, ['id' => 'idordenproduccion', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>				
			</tr>			
		</table>
		<div class="panel-footer text-right">			
			<button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
			<?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>		
		</div>					
	</div>
</div>
<?php ActiveForm::end(); ?>

<script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>
