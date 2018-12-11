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

$this->title = 'Costo Producción Diaria';
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
                'options' => ['prompt' => 'Seleccione una orden de produccion'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-list-alt'></span> Generar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute("costo-produccion-diaria/costodiario") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>


<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Costo de producción diarios
    </div>
        <table class="table table-hover">
            <thead>
            <tr>                
                <th scope="col">Cliente</th>
                <th scope="col">Orden Producción</th>
                <th scope="col" title="CANTIDAD POR HORA">Cant X Hora</th>
                <th scope="col" title="CANTIDAD DIARIA">Cant Diaria</th>
                <th scope="col" title="TIEMPO ENTREGA DIAS">Tiempo Ent Días</th>
                <th scope="col">N° Horas</th>
                <th scope="col">Días Entrega</th>
                <th scope="col" title="COSTO MUESTRA OPERARIA">Costo M. Operaria</th>
                <th scope="col" title="COSTO POR HORA">Costo X Hora</th>                
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr>                
                <?php $cliente = app\models\Cliente::findOne($val->idcliente); ?>
                <td><?= $cliente->nombrecorto ?></td>
                <td><?= $val->ordenproduccion ?></td>
                <td><?= $val->cantidad_x_hora ?></td>
                <td><?= $val->cantidad_diaria ?></td>
                <td><?= $val->tiempo_entrega_dias ?></td>
                <td><?= $val->nro_horas ?></td>
                <td><?= $val->dias_entrega ?></td>
                <td><?= $val->costo_muestra_operaria ?></td>
                <td><?= $val->costo_x_hora ?></td>
                <td><?= Html::a('<span class="glyphicon glyphicon-export"></span>', ['excel', 'id' => $val->id_costo_produccion_diaria]); ?></td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>        
    </div>
</div>


<?php $formulario->end() ?>





