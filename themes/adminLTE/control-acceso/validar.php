<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
use moonland\phpexcel\Excel;

$this->title = 'Validar Información';
?>

<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("control-acceso/validar"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);

?>

<?php if ($tipomsg == "danger") { ?>
    <h3 class="alert-danger"><?= $msg ?></h3>
<?php } else{
    if (isset($_REQUEST['msg'])) { $dato = $_REQUEST['msg']; }else {$dato = $msg;}?>       
        <?php if ($dato <> ""){ ?>
        <div class="alert alert-success alert-dismissable">          
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $dato ?>           
        </div> 
        <?php } ?>
<?php } ?>

<div class="panel panel-success panel-filters">    
    <div class="panel-heading">
        Ingreso de Información
    </div>        
    <div class="panel-body" id="filtroreporte">
        <div class="row" >
            <?= $formulario->field($form, "cedula")->input("search") ?>            
            <?= $formulario->field($form, "tipo_personal")->dropdownList(['Empleado' => 'Empleado', 'Visitante' => 'Visitante'], ['prompt' => 'Seleccione...']) ?>                                                  
        </div>        
        <div class="panel-footer text-right">
            <?= Html::submitButton("Validar", ["class" => "btn btn-primary"]) ?>            
        </div>
    </div>
</div>

<?php $formulario->end() ?>

