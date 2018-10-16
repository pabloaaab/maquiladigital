<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Facturaventa;
use app\models\Facturaventadetalle;
use app\models\FacturaventaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventa */
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
	
	<?php $model = Facturaventadetalle::find()->where(['iddetallefactura' => $iddetallefactura])->one();  
		  if ($model){
			$nrofactura = $model->nrofactura;
			$idproducto = $model->idproducto;
			$codigoproducto = $model->codigoproducto;
			$cantidad = $model->cantidad;
			$preciounitario = $model->preciounitario;
			$total = $model->total;			
		  }else{
			$nrofactura = $nrofactura;
			$idproducto = null;
			$codigoproducto = null;
			$cantidad = null;
			$preciounitario = null;
			$total = null;
		  }	
	?>
 <div class="panel panel-success">
    
    <div class="panel-body">
		<table class="table table-">
			<tr><input type="hidden" name="iddetallefactura" value="<?= $iddetallefactura ?>">
				<input type="hidden" name="nrofactura" value="<?= $nrofactura ?>">
				<td>N° Factura:</td>
				<td><?= Html::textInput('nrofactura', $nrofactura, ['id' => 'nrofactura', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>
				<td>idproducto:</td>
				<td><?= Html::textInput('idproducto', $idproducto, ['id' => 'idproducto', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%', 'onkeypress' => 'return valida(event)', 'required' => true]) ?></td>											
			</tr>
			<tr>
				<td>Código Producto:</td>
				<td><?= Html::textInput('codigoproducto', $codigoproducto, ['id' => 'codigoproducto', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>
				<td>Cantidad:</td>
				<td><?= Html::textInput('cantidad', $cantidad, ['id' => 'cantidad', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>											
			</tr>
			<tr>
				<td>Precio Unitario:</td>
				<td><?= Html::textInput('preciounitario', $preciounitario, ['id' => 'preciounitario', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>
				<td>Total:</td>
				<td><?= Html::textInput('total', $total, ['id' => 'total', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>	
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
