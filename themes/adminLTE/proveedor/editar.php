<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamento;
use app\models\TipoDocumento;
use yii\widgets\LinkPager;

$this->title = 'Editar Proveedor';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<body onload= "mostrar()">
<!--<h1>Editar proveedor</h1>-->
<?php if ($tipomsg == "danger") { ?>
    <h3 class="alert-danger"><?= $msg ?></h3>
<?php } else{ ?>
    <h3 class="alert-success"><?= $msg ?></h3>
<?php } ?>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'id' => 'formulario',
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
	'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],
]);
?>

<?php
$departamento= ArrayHelper::map(Departamento::find()->all(), 'iddepartamento','departamento');

$tipodocumento = ArrayHelper::map(TipoDocumento::find()->all(), 'idtipo','descripcion');
?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4>Información Proveedor</h4>
        </div>

        <div class="panel-body">
            <div class="row" id="personal">            
                <?= $form->field($model, 'idtipo')->dropDownList($tipodocumento, ['prompt' => 'Seleccione...', 'onload' => 'mostrar()', 'onchange' => 'mostrar()', 'id' => 'idtipo']) ?>
                <?= $form->field($model, 'cedulanit')->input('text', ['id' => 'cedulanit', 'onchange' => 'calcularDigitoVerificacion()']) ?>			
                <?= Html::textInput('dv', $model->dv, ['id' => 'dv', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 1, 'class' => 'form-control', 'style' => 'width:35px', 'readonly' => true, 'aria-required' => true]) ?>
            </div>
            <div class="row">
                <div id="nombreproveedor" style="display:block"><?= $form->field($model, 'nombreproveedor')->input("text") ?></div>
                <div id="apellidoproveedor" style="display:block"><?= $form->field($model, 'apellidoproveedor')->input("text") ?></div>    
            </div>
            <div class="row">
                <div id="razonsocial" style="display:none"><?= $form->field($model, 'razonsocial')->input("text") ?></div>

            </div>
            <div class="row">
                <?= $form->field($model, 'emailproveedor')->input("text") ?>
                <?= $form->field($model, 'celularproveedor')->input("text") ?>	
            </div>
            <div class="row">
                <?= $form->field($model, 'telefonoproveedor')->input("text", ['id' => 'telefonoproveedor']) ?>
                <?= $form->field($model, 'direccionproveedor')->input("text") ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'iddepartamento')->dropDownList($departamento, ['prompt' => 'Seleccione...', 'onchange' => ' $.get( "' . Url::toRoute('proveedor/municipio') . '", { id: $(this).val() } ) .done(function( data ) {
            $( "#' . Html::getInputId($model, 'idmunicipio', ['required']) . '" ).html( data ); });']); ?>
                <?= $form->field($model, 'idmunicipio')->dropDownList($municipio, ['prompt' => 'Seleccione...']) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'contacto')->input("text") ?>
                <?= $form->field($model, 'telefonocontacto')->input("text") ?>
            </div>	
            <div class="row">
                <?= $form->field($model, 'celularcontacto')->input("text") ?>
                <?= $form->field($model, 'nitmatricula')->input("text", ['readonly' => true]) ?>			
            </div>    
            <div class="row">
                <?= $form->field($model, 'formapago')->dropdownList(['1' => 'CONTADO', '2' => 'CRÉDITO'], ['prompt' => 'Seleccione...', 'onchange' => 'fpago()', 'id' => 'formapago']) ?>
                <?= $form->field($model, 'plazopago')->input("text",['id' => 'plazopago']) ?>			
            </div>
            <div class="row">
                <?= $form->field($model, 'tiporegimen')->dropdownList(['1' => 'COMÚN', '2' => 'SIMPLIFICADO'], ['prompt' => 'Seleccione...', 'onchange' => 'tregimen()', 'id' => 'tiporegimen']) ?>
                <?= $form->field($model, 'autoretenedor')->dropdownList(['1' => 'SI', '0' => 'NO'], ['prompt' => 'Seleccione...', 'onchange' => 'retener()', 'id' => 'autoretenedor']) ?>
            </div>
            <div class="row">
                <?= $form->field($model, 'retencioniva')->dropdownList(['0' => 'NO', '1' => 'SI'], ['id' => 'retencioniva', 'readonly' => 'readonly']) ?>
                <?= $form->field($model, 'retencionfuente')->dropdownList(['0' => 'NO', '1' => 'SI'], ['id' => 'retencionfuente', 'readonly' => 'readonly']) ?>
            </div>
            <div class="row">
                <div class="field-tblproveedor-observaciones_proveedor has-success">
                    <?= $form->field($model, 'observacion', ['template' => '{label}<div class="col-sm-10 form-group">{input}{error}</div>'])->textarea(['rows' => 3]) ?>
                </div>
            </div>        
        </div>
        <div class="panel-footer text-right">        
            <a href="<?= Url::toRoute("proveedor/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
            <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>
        </div>
    </div>
<?php $form->end() ?>
