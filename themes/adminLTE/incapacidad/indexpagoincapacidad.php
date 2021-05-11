<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\models\EntidadSalud;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FichatiempoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pago incapacidad';
$this->params['breadcrumbs'][] = $this->title;
?>
<script language="JavaScript">
    function mostrarfiltro() {
        divC = document.getElementById("filtro");
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>

<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("incapacidad/indexpagoincapacidad"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);

$eps = ArrayHelper::map(EntidadSalud::find()->orderBy('entidad ASC')->all(), 'id_entidad_salud', 'entidad');
?>
<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>
	
    <div class="panel-body" id="filtro" style="display:none">
        <div class="row" >
            <?= $formulario->field($form, 'id_entidad_salud')->widget(Select2::classname(), [
                'data' => $eps,
                'options' => ['prompt' => 'Seleccione la entidad'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= $formulario->field($form, "nro_pago")->input("search") ?>
            <?= $formulario->field($form, 'fecha_desde')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
               <?= $formulario->field($form, 'fecha_hasta')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
            
    
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary btn-sm",]) ?>
            <a align="right" href="<?= Url::toRoute("incapacidad/indexpagoincapacidad") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
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
                <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                <th scope="col" style='background-color:#B9D5CE;'>Nro Pago</th>
                <th scope="col" style='background-color:#B9D5CE;'>Eps</th>
                <th scope="col" style='background-color:#B9D5CE;'>Fecha Pago</th>
                <th scope="col" style='background-color:#B9D5CE;'>Fecha Registro</th>
                 <th scope="col" style='background-color:#B9D5CE;'>Forma Pago</th>
                <th scope="col" style='background-color:#B9D5CE;'>Vr. Pago</th>
                <th scope="col" style='background-color:#B9D5CE;'>Usuario</th>
                <th scope="col" style='background-color:#B9D5CE;'><span title="Autorizado">Aut.</span></th>
                <th scope="col" style='background-color:#B9D5CE;'>Observación</th>
                <th scope="col" style='background-color:#B9D5CE;'></th>
                <th scope="col" style='background-color:#B9D5CE;'></th>
              
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($modelo as $val):?>
                <tr style='font-size:85%;'>  
                    <td><?= $val->id_pago?></td>
                    <td><?= $val->nro_pago ?></td>
                    <td><?= $val->entidadSalud->entidad ?></td>
                    <td><?= $val->fecha_pago_entidad ?></td>
                    <td><?= $val->fecha_registro?></td>
                    <td><?= $val->banco->entidad?></td>
                    <td align="right"><?= ''.number_format($val->valor_pago,0) ?></td>
                    <td><?= $val->usuariosistema?></td>
                     <td><?= $val->autorizadoPago?></td>
                    <td><?= $val->observacion?></td>
                    <td style= 'width: 25px; height: 25px;'>
                                <a href="<?= Url::toRoute(["incapacidad/viewdetallepago", "id_pago" => $val->id_pago]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                     </td>
                    <?php if($val->autorizado == 0){?>
                        <td style= 'width: 25px; height: 25px;'>
                            <a href="<?= Url::toRoute(["incapacidad/editarpagoincapacidad", "id_pago" => $val->id_pago, ]) ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                    <?php }else{?>
                        <td></td>
                    <?php }?>    
                    
                </tr>
                    
            <?php endforeach; ?>
             </tbody>           
        </table>    
    
        <div class="panel-footer text-right" >            
                <?= Html::submitButton("<span class='glyphicon glyphicon-export'></span> Excel", ['name' => 'excel','class' => 'btn btn-primary btn-sm ']); ?>                
                <a align="right" href="<?= Url::toRoute("incapacidad/nuevopagoincapacidad") ?>" class="btn btn-success btn-sm"><span class='glyphicon glyphicon-plus'></span> Nuevo</a>
            <?php $form->end() ?>
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
