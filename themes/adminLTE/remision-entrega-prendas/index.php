<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use app\models\Cliente;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;

$this->title = 'Remision de entrega';
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
    "action" => Url::toRoute("remision-entrega-prendas/index"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);

$clientes = ArrayHelper::map(Cliente::find()->orderBy ('nombrecorto ASC')->all(), 'idcliente', 'nombrecorto');
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>
	
    <div class="panel-body" id="filtro" style="display:none">
        <div class="row" >
             <?= $formulario->field($form, 'idcliente')->widget(Select2::classname(), [
                'data' => $clientes,
                'options' => ['prompt' => 'Seleccione el cliente...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= $formulario->field($form, 'fecha_entrega')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary btn-sm",]) ?>
            <a align="right" href="<?= Url::toRoute("remision-entrega-prendas/index") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
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
        Registros: <span class="badge"> <?= $pagination->totalCount ?></span>
    </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr style ='font-size:85%;'>                
                <th scope="col" style='background-color:#B9D5CE;'>Nro remisión</th>
                <th scope="col" style='background-color:#B9D5CE;'>Nit/Cedula</th>
                <th scope="col" style='background-color:#B9D5CE;'>Cliente</th>
                <th scope="col" style='background-color:#B9D5CE;'>Unidades</th>
                <th scope="col" style='background-color:#B9D5CE;'>F. Entrega</th>
                <th scope="col" style='background-color:#B9D5CE;'>Usuario</th>
                <th scope="col" style='background-color:#B9D5CE;'>Total</th>
                <th scope="col" style='background-color:#B9D5CE;'>Saldo</th>
                 <th scope="col" style='background-color:#B9D5CE;'><span title="Estado" >Est.</span></th>
                <th scope="col" style='background-color:#B9D5CE;'><span title="Autorizado" >Aut.</span></th>
                <th scope="col" style='background-color:#B9D5CE;'><span title="Facturado" >Fact.</span></th>
                <th scope="col" style='background-color:#B9D5CE;'></th>
                <th scope="col" style='background-color:#B9D5CE;'></th>
              
            </tr>
            </thead>
            <tbody>
            <?php 
             
            foreach ($model as $val):?>
                <tr style='font-size:85%;'>                
                <td><?= $val->nro_remision ?></td>
                 <td><?= $val->cliente->cedulanit ?></td>
                 <td><?= ($val->cliente->nombrecorto)?></td>
                <td><?= $val->cantidad ?></td>
                <td><?= $val->fecha_entrega ?></td>
                <td><?= $val->usuariosistema ?></td>
                <td><?= '$'.number_format($val->valor_total,0)?></td>
                <td><?= '$'.number_format($val->valor_pagar,0)?></td>
                <td><?= $val->estadoRemision?></td>
                <td><?= $val->estadoAutorizado?></td>
                <td><?= $val->estadoFacturado?></td>
                <?php if($val->autorizado == 0){?>
                    <td style= 'width: 25px; height: 25px;'>
                            <a href="<?= Url::toRoute(["remision-entrega-prendas/view", "id" => $val->id_remision, ]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                    </td>
                    <td style= 'width: 25px; height: 25px;'>
                            <a href="<?= Url::toRoute(["remision-entrega-prendas/update", "id" => $val->id_remision, ]) ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                <?php }else{ ?>
                    <td style= 'width: 25px; height: 25px;'>
                            <a href="<?= Url::toRoute(["remision-entrega-prendas/view", "id" => $val->id_remision, ]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                    </td>
                    <td></td>
                        
                <?php }?>    
             
            </tbody>            
            <?php endforeach; ?>
        </table>    
        <div class="panel-footer text-right" >            
                <?= Html::submitButton("<span class='glyphicon glyphicon-export'></span> Excel", ['name' => 'excel','class' => 'btn btn-primary btn-sm ']); ?>                
                <a align="right" href="<?= Url::toRoute("remision-entrega-prendas/create") ?>" class="btn btn-success btn-sm"><span class='glyphicon glyphicon-plus'></span> Nuevo</a>
            <?php $form->end() ?>
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>