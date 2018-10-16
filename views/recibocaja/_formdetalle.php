<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Recibocaja;
use app\models\Recibocajadetalle;
use app\models\RecibocajaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */
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
	
	<?php $model = ReciboCajaDetalle::find()->where(['iddetallerecibo' => $iddetallerecibo])->one();  
		  if ($model){
			$nrofactura = $model->nrofactura;
			$vlrabono = $model->vlrabono;
			$vlrsaldo = $model->vlrsaldo;
			$retefuente = $model->retefuente;
			$reteiva = $model->reteiva;
			$reteica = $model->reteica;
			$observacion = $model->observacion;
			$idrecibo = $model->idrecibo;
		  }else{
			$nrofactura = null;
			$vlrabono = null;
			$vlrsaldo = null;
			$retefuente = null;
			$reteiva = null;
			$reteica = null;
			$observacion = null;
			$idrecibo = $idrecibo;
		  }	
	?>
 <div class="panel panel-success">
    
    <div class="panel-body">
		<table class="table table-">
			<tr><input type="hidden" name="iddetallerecibo" value="<?= $iddetallerecibo ?>">
				<input type="hidden" name="idrecibo" value="<?= $idrecibo ?>">
				<td>N° Factura:</td>
				<td><?= Html::textInput('nrofactura', $nrofactura, ['id' => 'nrofactura', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>
				<td>Valor Abono:</td>
				<td><?= Html::textInput('vlrabono', $vlrabono, ['id' => 'vlrabono', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%', 'onkeypress' => 'return valida(event)', 'required' => true]) ?></td>											
			</tr>
			<tr>
				<td>Valor Saldo:</td>
				<td><?= Html::textInput('vlrsaldo', $vlrsaldo, ['id' => 'vlrsaldo', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>
				<td>Rete Fuente:</td>
				<td><?= Html::textInput('retefuente', $retefuente, ['id' => 'retefuente', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>											
			</tr>
			<tr>
				<td>Rete Iva:</td>
				<td><?= Html::textInput('reteiva', $reteiva, ['id' => 'reteiva', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>
				<td>Rete Ica:</td>
				<td><?= Html::textInput('reteica', $reteica, ['id' => 'reteica', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:80%','onkeypress' => 'return valida(event)', 'required' => true]) ?></td>
			</tr>
			<tr>
				<td>Observación:</td>
				<td colspan="6"><?= Html::textArea('observacion', $observacion, ['id' => 'observacion', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 40, 'class' => 'form-control', 'style' => 'width:93%']) ?></td>
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
