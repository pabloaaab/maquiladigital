  <?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;
//Modelos...
use app\models\Proveedor;
use app\models\Bodega;



$this->title = 'Referencias';
$this->params['breadcrumbs'][] = $this->title;

?>
<script language="JavaScript">
    function mostrarfiltro() {
        divC = document.getElementById("filtro");
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>

<!--<h1>Lista Facturas</h1>-->
<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("referencias/index"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);

$proveedor = ArrayHelper::map(Proveedor::find()->where(['=','genera_moda', 1])->orderBy ('nombrecorto ASC')->all(), 'idproveedor', 'nombrecorto');
$bodega = ArrayHelper::map(Bodega::find()->where(['=','estado', 1])->orderBy ('descripcion ASC')->all(), 'id_bodega', 'descripcion');

?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>
	
    <div class="panel-body" id="filtro" style="display:none">
        <div class="row" >
              <?= $formulario->field($form, "codigo_producto")->input("search") ?>
             <?= $formulario->field($form, 'idproveedor')->widget(Select2::classname(), [
                'data' => $proveedor,
                'options' => ['prompt' => 'Seleccione...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
             <?= $formulario->field($form, "descripcion")->input("search") ?>
            <?= $formulario->field($form, 'fecha_creacion')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
              <?= $formulario->field($form, 'id_bodega')->widget(Select2::classname(), [
                'data' => $bodega,
                'options' => ['prompt' => 'Seleccione...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute("referencias/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>

<?php $formulario->end() ?>
<?php
$form = ActiveForm::begin([
                "method" => "post",                            
            ]);
    ?>
<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
          Registros:<span class="badge"><?= $pagination->totalCount ?></span>
    </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr >         
                <th scope="col" style='background-color:#B9D5CE;'>Código</th>
                <th scope="col" style='background-color:#B9D5CE;'>Descripción</th>
                <th scope="col" style='background-color:#B9D5CE;'>T. producto</th>
                <th scope="col" style='background-color:#B9D5CE;'>Vlr_costo</th>
                <th scope="col" style='background-color:#B9D5CE;'>Mayorista</th>
                <th scope="col" style='background-color:#B9D5CE;'>Deptal</th>
                <th scope="col" style='background-color:#B9D5CE;'>Exist.</th>
                 <th scope="col" style='background-color:#B9D5CE;'>Proveedor</th>
                <th scope="col" style='background-color:#B9D5CE;'>Bodega</th>
                <th scope="col" style='background-color:#B9D5CE;'>F. creación</th> 
                <th scope="col" style='background-color:#B9D5CE;'>Usuario</th> 
                <th scope="col" style='background-color:#B9D5CE;'><span title="Autorizado">Aut.</span></th>
                <th scope="col" style='background-color:#B9D5CE;'></th>
                <th scope="col" style='background-color:#B9D5CE;'></th>
                <th score="col" style='background-color:#B9D5CE;'></th>                              
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr style ='font-size: 85%;'>                
                <td><?= $val->codigo_producto?></td>
                 <td><?= $val->descripcion?></td>
                <td><?= $val->producto->tipoProducto->concepto?></td>
                <td style="text-align: right"><?= '$'.number_format($val->precio_costo,0)?></td>
                <td style="text-align: right"><?= '$'.number_format($val->precio_venta_mayorista,0),' (',($val->porcentaje_mayorista),'%)'?></td>
                <td style="text-align: right"><?= '$'.number_format($val->precio_venta_deptal,0),' (',($val->porcentaje_deptal),'%)'?></td>
                <td><?= $val->total_existencias?></td>
                <td><?= $val->proveedor->nombrecorto?></td>
                <td><?= $val->bodega->descripcion?></td>
                <td><?= $val->fecha_creacion?></td>
                <td><?= $val->usuariosistema?></td>
                <td><?= $val->autorizadoreferencia?></td>
                <td style= 'width: 25px;'>
                  <a href="<?= Url::toRoute(["referencias/view", "id" => $val->id_referencia]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                 </td>
                <td style= 'width: 25px;'>
                   <a href="<?= Url::toRoute(["referencias/update", "id" => $val->id_referencia]) ?>" ><span class="glyphicon glyphicon-pencil"></span></a>                   
                </td>
                    <td style= 'width: 25px;'>
                        <?= Html::a('', ['eliminar', 'id' => $val->id_referencia], [
                            'class' => 'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => 'Esta seguro de eliminar el registro?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
            </tr>            
            <?php endforeach; ?>
            </tbody>    
        </table> 
        <div class="panel-footer text-right" >            
           <?= Html::submitButton("<span class='glyphicon glyphicon-export'></span> Excel", ['name' => 'excel','class' => 'btn btn-primary btn-sm']); ?>                
            <a align="right" href="<?= Url::toRoute("referencias/nuevareferencia") ?>" class="btn btn-success btn-sm"><span class='glyphicon glyphicon-plus'></span> Nuevo</a>
        <?php $form->end() ?>
        </div>
     </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>

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