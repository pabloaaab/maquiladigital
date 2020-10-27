<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use kartik\select2\Select2;

$this->title = 'Producción diaria';
$this->params['breadcrumbs'][] = $this->title;


?>

<!--<h1>Lista Clientes</h1>-->
<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("costo-produccion-diaria/costodiario"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    
	'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],
    

]);
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading">
        Parametros de entrada
    </div>
	
    <div class="panel-body" id="costodiario">
        <div class="row" >
            <?= $formulario->field($form, "operarias")->input("search") ?>
            <?= $formulario->field($form, "horaslaboradas")->input("search") ?>
            <?= $formulario->field($form, "minutoshora")->input("search",array('value' => '60', 'readonly' => true)) ?>
            <?= $formulario->field($form, 'idordenproduccion')->widget(Select2::classname(), [
                'data' => $ordenesproduccion,
                'options' => ['prompt' => 'Seleccione la orden de produccion'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-list-alt'></span> Generar", ["class" => "btn btn-primary btn-sm",]) ?>
            <a align="right" href="<?= Url::toRoute("costo-produccion-diaria/costodiario") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>


<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
       Detalle del registro
    </div>
        <table class="table table-hover">
            <thead>
            <tr>                
                <th scope="col" style='background-color:#B9D5CE;'>Cliente</th>
                <th scope="col" style='background-color:#B9D5CE;'>Orden Producción</th>
                <th scope="col" title="CANTIDAD POR HORA" style='background-color:#B9D5CE;'>Cant X Hora</th>
                <th scope="col" title="CANTIDAD DIARIA" style='background-color:#B9D5CE;'>Cant Diaria</th>
                <th scope="col" title="TIEMPO ENTREGA DIAS" style='background-color:#B9D5CE;'>Tiempo Ent Días</th>
                <th scope="col" style='background-color:#B9D5CE;'>N° Horas</th>
                <th scope="col" style='background-color:#B9D5CE;'>Días Entrega</th>
                <th scope="col" title="COSTO MUESTRA OPERARIA" style='background-color:#B9D5CE;'>Costo M. Operaria</th>
                <th scope="col" title="COSTO POR HORA" style='background-color:#B9D5CE;'>Costo X Hora</th>                
                <th scope="col" style='background-color:#B9D5CE;'></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
                <tr style="font-size: 85%;">                
                <?php $cliente = app\models\Cliente::findOne($val->idcliente); ?>
                <td><?= $cliente->nombrecorto ?></td>
                <td><?= $val->ordenproduccion ?></td>
                <td align = "right"><?= $val->cantidad_x_hora ?></td>
                <td align = "right"><?= $val->cantidad_diaria ?></td>
                <td align = "right"><?= $val->tiempo_entrega_dias ?></td>
                <td align = "right"><?= $val->nro_horas ?></td>
                <td align = "right"><?= $val->dias_entrega ?></td>
                <td align = "right"><?= $val->costo_muestra_operaria ?></td>
                <td align = "right"><?= $val->costo_x_hora ?></td>
                <td><?= Html::a('<span class="glyphicon glyphicon-export"></span>', ['excel', 'id' => $val->id_costo_produccion_diaria]); ?></td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>        
    </div>
</div>


<?php $formulario->end() ?>





