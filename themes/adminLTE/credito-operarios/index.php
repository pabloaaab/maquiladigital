<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use app\models\Operarios;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;

$this->title = 'Prestamos';
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
    "action" => Url::toRoute("credito-operarios/index"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);

$operario = ArrayHelper::map(Operarios::find()->orderBy('nombrecompleto ASC')->all(), 'id_operario', 'nombrecompleto');
$codigocredito = ArrayHelper::map(\app\models\ConfiguracionCredito::find()->orderBy('nombre_credito ASC')->all(),'codigo_credito' , 'nombre_credito');
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>
	
    <div class="panel-body" id="filtro" style="display:none">
        <div class="row" >
            <?= $formulario->field($form, 'id_operario')->widget(Select2::classname(), [
                'data' => $operario,
                'options' => ['prompt' => 'Seleccione...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
             <?= $formulario->field($form, 'codigo_credito')->widget(Select2::classname(), [
                'data' => $codigocredito,
                'options' => ['prompt' => 'Seleccione...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
             <?= $formulario->field($form, 'desde')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
            <?= $formulario->field($form, 'hasta')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
            <?= $formulario->field($form, 'saldo')->dropDownList(['1' => 'SI'],['prompt' => 'Seleccione una opcion ...']) ?>
        </div>
        
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute("credito-operarios/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
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
        Registros: <span class="badge"><?= $pagination->totalCount ?></span>
    </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>                
                <th scope="col" style='background-color:#B9D5CE;'>Nro</th>
                <th scope="col" style='background-color:#B9D5CE;'>Tipo crédito</th>
                <th scope="col" style='background-color:#B9D5CE;'>Documento</th>
                <th scope="col" style='background-color:#B9D5CE;'>Operario</th>
                <th scope="col" style='background-color:#B9D5CE;'>Vlr_Credito</th>                
                <th scope="col" style='background-color:#B9D5CE;'>Cuota</th> 
                <th scope="col" style='background-color:#B9D5CE;'>Saldo</th> 
                <th scope="col" style='background-color:#B9D5CE;'>Fecha inicio</th> 
                <th scope="col" style='background-color:#B9D5CE;'><span title="Numero de cuotas">N_C</span></th>
                <th scope="col" style='background-color:#B9D5CE;'><span title="Cuota actual">C_A</span></th>
                <th scope="col" style='background-color:#B9D5CE;'><span title="Estado crédito activo">E_C_A</span></th>
                <th colspan="3" style='background-color:#B9D5CE;'><p style="color:blue;" align="center">Opciones</p></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr style= 'font-size:85%;'>                
                <td><?= $val->id_credito?></td>
                 <td><?= $val->codigoCredito->nombre_credito?></td>
                 <td><?= $val->operario->documento?></td>
                 <td><?= $val->operario->nombrecompleto?></td>
                 <td><?= '$'.number_format($val->vlr_credito,0)?></td>
                  <td><?= '$'.number_format($val->vlr_cuota,0)?></td>
                 <td><?= '$'.number_format($val->saldo_credito,0)?></td>
                  <td><?= $val->fecha_inicio?></td>
                 <td><?= $val->numero_cuotas?></td>
                 <td><?= $val->numero_cuota_actual?></td>
                 <td><?= $val->Estadocredito?></td>
               
                <?php if($val->saldo_credito <= 0){?>   
                 <td style='width: 25px;'>
                        <a href="<?= Url::toRoute(["credito-operarios/view", "id" => $val->id_credito]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>                   
                 </td>
                    <td>
                    </td>   
                    <td>
                    </td>
                   
                <?php }else{ ?>   
                   <td style='width: 25px;'>
                        <a href="<?= Url::toRoute(["credito-operarios/view", "id" => $val->id_credito]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                    </td>
                    <td style='width: 25px;'>
                        <a href="<?= Url::toRoute(["credito-operarios/update", "id" => $val->id_credito]) ?>" ><span class="glyphicon glyphicon-pencil"></span></a>                   
                    </td>
                    <td style='width: 25px;'>
                      <?= Html::a('', ['eliminar', 'id' => $val->id_credito], [
                        'class' => 'glyphicon glyphicon-trash',
                        'data' => [
                            'confirm' => 'Esta seguro de eliminar el registro?',
                            'method' => 'post',
                        ],
                      ]) ?>
                    </td>
                <?php }?>   
                
            </tr>            
            </tbody>            
            <?php endforeach; ?>
        </table> 
        <div class="panel-footer text-right" >    
                <?= Html::submitButton("<span class='glyphicon glyphicon-export'></span> Excel", ['name' => 'excel','class' => 'btn btn-primary btn-sm']); ?>                
                <a align="right" href="<?= Url::toRoute("credito-operarios/nuevo") ?>" class="btn btn-success btn-sm"><span class='glyphicon glyphicon-plus'></span> Nuevo</a>
        </div>        
        <?php $form->end() ?>
       
     </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>

