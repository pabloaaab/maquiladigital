<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use app\models\Empleado;
use app\models\TipoEstudios;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;

$this->title = 'Estudios';
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
    "action" => Url::toRoute("estudio-empleado/index"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);

$empleado = ArrayHelper::map(Empleado::find()->orderBy('nombrecorto ASC')->all(), 'id_empleado', 'nombrecorto');
$tipo_estudio = ArrayHelper::map(TipoEstudios::find()->orderBy('id_tipo_estudio ASC')->all(), 'id_tipo_estudio', 'estudio');
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>
	
    <div class="panel-body" id="filtro" style="display:none">
        <div class="row" >
            <?= $formulario->field($form, "documento")->input("search") ?>
             <?= $formulario->field($form, 'id_empleado')->widget(Select2::classname(), [
                'data' => $empleado,
                'options' => ['prompt' => 'Seleccione el empleado...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= $formulario->field($form, 'id_tipo_estudio')->widget(Select2::classname(), [
              'data' => $tipo_estudio,
              'options' => ['prompt' => 'Seleccione el empleado...'],
              'pluginOptions' => [
                  'allowClear' => true
              ],
          ]); ?>
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary btn-sm",]) ?>
            <a align="right" href="<?= Url::toRoute("estudio-empleado/index") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
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
                <th scope="col">Código</th>
                <th scope="col">Documento</th>
                <th scope="col">Empleado</th>
                <th scope="col">Tipo estudio</th>
                <th scope="col">Municipio</th>
                <th scope="col">institución</th>
                <th scope="col">Titulo obtenido</th>                
                <th scope="col"><span title="Graduado" >Grad.</span></th>
                <th scope="col"><span title="Validar vencimiento" >Val.</span></th>
                <th scope="col">Usuario</th>  
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
              
            </tr>
            </thead>
            <tbody>
            <?php foreach ($modelo as $val): ?>
                <tr style='font-size:85%;'>                
                <td><?= $val->id ?></td>
                <td><?= $val->documento?></td>
                <td><?= mb_strtoupper($val->empleado->nombrecorto)?></td>
                <td><?= $val->tipoEstudio->estudio ?></td>
                <td><?= $val->municipio->municipio?></td>
                 <td><?= $val->institucion_educativa ?></td>
                <td><?= $val->titulo_obtenido ?></td>
                <td><?= $val->graduadoEstudio ?></td>
                <td><?= $val->validar ?></td>
                <td><?= $val->usuariosistema ?></td>
                <td style= 'width: 25px; height: 25px;'>
                        <a href="<?= Url::toRoute(["estudio-empleado/view", "id" => $val->id, ]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                </td>    
                <td style= 'width: 25px; height: 25px;'>
                        <a href="<?= Url::toRoute(["estudio-empleado/update", "id" => $val->id, ]) ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                </td>
                 <td style= 'width: 25px;'>
                        <?= Html::a('', ['delete', 'id' => $val->id], [
                            'class' => 'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => 'Esta seguro de eliminar el registro?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
            </tbody>            
            <?php endforeach; ?>
        </table>    
        <div class="panel-footer text-right" >            
                <?= Html::submitButton("<span class='glyphicon glyphicon-export'></span> Excel", ['name' => 'excel','class' => 'btn btn-primary btn-sm ']); ?>                
                <a align="right" href="<?= Url::toRoute("estudio-empleado/create") ?>" class="btn btn-success btn-sm"><span class='glyphicon glyphicon-plus'></span> Nuevo</a>
            <?php $form->end() ?>
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>


