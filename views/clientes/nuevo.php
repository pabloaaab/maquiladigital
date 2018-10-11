<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamentos;
use app\models\TipoDocumento;
use yii\widgets\LinkPager;

$this->title = 'Nuevo Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<script language="JavaScript">
    function calcularDigitoVerificacion() {
        var vpri,
            x,
            y,
            z;

        // Se limpia el Nit
        myNit = document.getElementById('cedulanit').value;
        myNit = myNit.replace ( /\s/g, "" ) ; // Espacios
        myNit = myNit.replace ( /,/g,  "" ) ; // Comas
        myNit = myNit.replace ( /\./g, "" ) ; // Puntos
        myNit = myNit.replace ( /-/g,  "" ) ; // Guiones
        // Se valida el nit
        if  ( isNaN ( myNit ) )  {
            console.log ("El nit/cédula '" + myNit + "' no es válido(a).") ;
            return "" ;
        };
        // Se valida el nit
        if  ( isNaN ( myNit ) )  {
            console.log ("El nit/cédula '" + myNit + "' no es válido(a).") ;
            return "" ;
        };

        // Procedimiento
        vpri = new Array(16) ;
        z = myNit.length ;
        vpri[1]  =  3 ;
        vpri[2]  =  7 ;
        vpri[3]  = 13 ;
        vpri[4]  = 17 ;
        vpri[5]  = 19 ;
        vpri[6]  = 23 ;
        vpri[7]  = 29 ;
        vpri[8]  = 37 ;
        vpri[9]  = 41 ;
        vpri[10] = 43 ;
        vpri[11] = 47 ;
        vpri[12] = 53 ;
        vpri[13] = 59 ;
        vpri[14] = 67 ;
        vpri[15] = 71 ;
        x = 0 ;
        y = 0 ;
        for  ( var i = 0; i < z; i++ )  {
            y = ( myNit.substr (i, 1 ) ) ;
            // console.log ( y + "x" + vpri[z-i] + ":" ) ;

            x += ( y * vpri [z-i] ) ;
            // console.log ( x ) ;
        }
        y = x % 11 ;
        // console.log ( y ) ;
        //return ( y > 1 ) ? 11 - y : y ;
        document.getElementById('dv').value = ( y > 1 ) ? 11 - y : y;
    }
</script>
<script language="JavaScript">
    function mostrar() {
        idtipo = document.getElementById('idtipo').value;
        if (idtipo == '1'){
            razonsocial.style.display = "none";
            nombrecliente.style.display = "block";
            apellidocliente.style.display = "block";
        }
        else if (idtipo == '5') {
            razonsocial.style.display = "block";
            nombrecliente.style.display = "none";
            apellidocliente.style.display = "none";
        }
    }
</script>
<h1>Nuevo Cliente</h1>
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
$departamento= ArrayHelper::map(Departamentos::find()->all(), 'iddepartamento','nombredepartamento');
$municipio = ArrayHelper::map(Municipio::find()->all(), 'idmunicipio','municipio');
$tipodocumento = ArrayHelper::map(TipoDocumento::find()->all(), 'idtipo','descripcion');
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4>Información Cliente</h4>
    </div>
    <div class="panel-body">
		<div class="row" id="personal">            
			<?= $form->field($model, 'idtipo')->dropDownList($tipodocumento,['prompt' => 'Seleccione...', 'onchange' => 'mostrar()', 'id' => 'idtipo' ]) ?>			
            <?= $form->field($model, 'cedulanit')->input('text',['id' => 'cedulanit', 'onchange' =>  'calcularDigitoVerificacion()']) ?>
			<?= Html::textInput('dv', $model->dv, ['id' => 'dv', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 1, 'class' => 'form-control', 'placeholder' => 'dv','style' => 'width:50px', 'readonly' => true]) ?>       
		</div>														   
		</div>
		<div class="row">
			<div id="nombrecliente" style="display:block"><?= $form->field($model, 'nombrecliente')->input("text") ?></div>
            <div id="apellidocliente" style="display:block"><?= $form->field($model, 'apellidocliente')->input("text") ?></div>    
        </div>
		<div class="row">
            <div id="razonsocial" style="display:none"><?= $form->field($model, 'razonsocial')->input("text") ?></div>
					
        </div>
		<div class="row">
			<?= $form->field($model, 'emailcliente')->input("text") ?>
			<?= $form->field($model, 'celularcliente')->input("text") ?>	
		</div>
		<div class="row">
			<?= $form->field($model, 'telefonocliente')->input("text",['id' => 'telefonocliente']) ?>
            <?= $form->field($model, 'direccioncliente')->input("text") ?>
		</div>
		<div class="row">
			<?= $form->field($model, 'iddepartamento')->dropDownList($departamento,['prompt'=>'Seleccione...', 'onchange'=>' $.get( "'.Url::toRoute('clientes/municipio').'", { id: $(this).val() } ) .done(function( data ) {
            $( "#'.Html::getInputId($model, 'idmunicipio',['required']).'" ).html( data ); });']); ?>
			<?= $form->field($model, 'idmunicipio')->dropDownList($municipio,['prompt' => 'Seleccione...']) ?>
		</div>
        <div class="row">
			<?= $form->field($model, 'contacto')->input("text") ?>
			<?= $form->field($model, 'telefonocontacto')->input("text") ?>
		</div>	
        <div class="row">
            <?= $form->field($model, 'celularcontacto')->input("text") ?>
			
        </div>    
        <div class="row">
            <?= $form->field($model, 'formapago')->dropdownList(['1' => 'Contado', '2' => 'Credito'], ['prompt' => 'Seleccione...']) ?>
			<?= $form->field($model, 'plazopago')->input("text") ?>			
        </div>
		<div class="row">
            <?= $form->field($model, 'tiporegimen')->dropdownList(['1' => 'Cómun', '2' => 'Simpplificado'], ['prompt' => 'Seleccione...']) ?>
			<?= $form->field($model, 'autoretenedor')->dropdownList(['Si' => 'Si', 'No' => 'No'], ['prompt' => 'Seleccione...']) ?>			
        </div>
		<div class="row">
            <?= $form->field($model, 'retencioniva')->input("text") ?>
			<?= $form->field($model, 'retencionfuente')->input("text") ?>			
        </div>
		<div class="row">
			<div class="field-tblclientes-observaciones_cliente has-success">
				<?= $form->field($model, 'observacion', ['template' => '{label}<div class="col-sm-10 form-group">{input}{error}</div>'])->textarea(['rows' => 3]) ?>
			</div>
		</div> 	
    
    <div class="panel-footer text-left">

        <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-primary",]) ?>
        <a href="<?= Url::toRoute("clientes/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
    </div>
</div>
<?php $form->end() ?>
