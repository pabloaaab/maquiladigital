<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;
use kartik\select2\Select2;

$this->title = 'Balanceo x operarios';
$this->params['breadcrumbs'][] = $this->title;

?>
<script language="JavaScript">
    function mostrarfiltro() {
        divC = document.getElementById("filtroproceso");
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>

<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("balanceo/indexbalanceoperario"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-4 form-group">{input}</div>',
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'options' => [ 'tag' => false,]
    ],

]);
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>

<div class="panel-body" id="filtroproceso" style="display:none">
        <div class="row">
             <?= $formulario->field($form, 'id_operario')->widget(Select2::classname(), [
                'data' => $operarios,
                'options' => ['prompt' => 'Seleccione el operario...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= $formulario->field($form, 'id_proceso')->widget(Select2::classname(), [
                'data' => $operaciones,
                'options' => ['prompt' => 'Seleccione la operación...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= $formulario->field($form, 'id_tipo')->widget(Select2::classname(), [
                'data' => $maquinas,
                'options' => ['prompt' => 'Seleccione la maquina...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= $formulario->field($form, "id_balanceo")->input("search") ?>
        </div>
        
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary btn-sm",]) ?>
            <a align="right" href="<?= Url::toRoute("balanceo/indexbalanceoperario") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>

<?php $formulario->end() ?>

<div class="table-responsive">
    <div class="panel panel-success ">
        <div class="panel-heading">
            Registros: <span class="badge"><?= $pagination->totalCount ?></span>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col" style='background-color:#B9D5CE;'>Código</th>  
                <th scope="col" style='background-color:#B9D5CE;'>Operación</th>
                <th scope="col" style='background-color:#B9D5CE;'>Maquina</th>
                <th scope="col" style='background-color:#B9D5CE;'>Balanceo</th>
                <th scope="col" style='background-color:#B9D5CE;'>Op</th>
                <th scope="col" style='background-color:#B9D5CE;'>Cliente</th>
                <th scope="col" style='background-color:#B9D5CE;'>Operario</th>
                <th scope="col" style='background-color:#B9D5CE;'>Segundos</th>
                <th scope="col" style='background-color:#B9D5CE;'>Minutos</th>
                <th scope="col" style='background-color:#B9D5CE;'>Asignados</th>
                <th scope="col" style='background-color:#B9D5CE;'><span title="Sobrante/Faltante">S/F</span></th>
                <th scope="col" style='background-color:#B9D5CE;'>Fecha Creación</th>
                 <th scope="col" style='background-color:#B9D5CE;'></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
                <tr style="font-size: 85%;">
                <td><?= $val->id_proceso ?></td>
               <td><?= $val->proceso->proceso ?></td>
                <td><?= $val->tipo->descripcion ?></td>
                 <td><?= $val->id_balanceo ?></td>
                <td><?= $val->balanceo->ordenproduccion->ordenproduccion ?></td>
                <td><?= $val->balanceo->cliente->nombrecorto ?></td>
                 <td><?= $val->operario->nombrecompleto ?></td>
                <td><?= $val->segundos ?></td>
                <td><?= $val->minutos ?></td>
                <td><?= $val->total_minutos ?></td>
                <?php if($val->sobrante_faltante >= 0){?>
                    <td style="background: #088A85;"><?= $val->sobrante_faltante ?></td>
                <?php }else{ ?>
                    <td style="background: #F5BCA9;"><?= $val->sobrante_faltante ?></td>
                <?php }?>      
                <td><?= $val->fecha_creacion ?></td>
                <td>
                    <a href="<?= Url::toRoute(["balanceo/viewconsultabalanceo", "id" => $val->id_balanceo, 'idordenproduccion' => $val->balanceo->ordenproduccion->idordenproduccion]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                    
                </td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <div class="panel-footer text-right" >            
            <?php
                $form = ActiveForm::begin([
                            "method" => "post",                            
                        ]);
                ?>    
                <?= Html::submitButton("<span class='glyphicon glyphicon-export'></span> Excel", ['name' => 'excel','class' => 'btn btn-primary btn-sm']); ?>
            <?php $form->end() ?>
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
