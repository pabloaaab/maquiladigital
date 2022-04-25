<?php
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

/* @var $this yii\web\View */
/* @var $searchModel app\models\FichatiempoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
 $listado_operarios = \app\models\PagoNominaServicios::find()->where(['=','fecha_inicio', $fecha_inicio])
                         ->andWhere(['=','fecha_corte', $fecha_corte])->orderBy('operario ASC')->all();
$this->title = 'Resume de pago';
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
                'options' => []
            ],
        ]);
?>
<p>
  <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['indexsoporte'], ['class' => 'btn btn-primary btn-sm']) ?>
  <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Generar nomina", ['name' => 'generarnomina', "class" => "btn btn-info btn-sm",]) ?>
  <?php
   echo Html::a('<span class="glyphicon glyphicon-save-file"></span> Actualizar saldo', ['actualizarsaldo', 'fecha_inicio' => $fecha_inicio, 'fecha_corte' => $fecha_corte], ['class' => 'btn btn-default btn-sm'])?>
</p> 


<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Registros: <span class="badge"> <?= count($listado_operarios) ?></span>
    </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr style ='font-size:85%;'>                
                <th scope="col" style='background-color:#B9D5CE;'>No Pago</th>
                <th scope="col" style='background-color:#B9D5CE;'>Documento</th>
                <th scope="col" style='background-color:#B9D5CE;'>Operario</th>
                <th scope="col" style='background-color:#B9D5CE;'>Fecha inicio</th>
                <th scope="col" style='background-color:#B9D5CE;'>Fecha corte</th>
                <th scope="col" style='background-color:#B9D5CE;'>Dias</th>
                <th scope="col" style='background-color:#B9D5CE;'>Usuario</th>
                <th scope="col" style='background-color:#B9D5CE;'>Devengado</th>
                <th scope="col" style='background-color:#B9D5CE;'>Deducción</th>
                <th scope="col" style='background-color:#B9D5CE;'>Total pagado</th>
                <th scope="col" style='background-color:#B9D5CE;'>Observacion</th>
                <th scope="col" style='background-color:#B9D5CE;'></th>
                  <th scope="col" style='background-color:#B9D5CE;'></th>
            </tr>
            </thead>
            <tbody>
                <?php 
                     foreach ($listado_operarios as $val):?>
                        <tr style='font-size:85%;'>  
                           <td><?= $val->id_pago ?></td> 
                           <td><?= $val->documento ?></td>
                           <td><?= $val->operario ?></td>
                           <td><?= $val->fecha_inicio ?></td>
                           <td><?= $val->fecha_corte?></td>
                             <td><?= $val->total_dias?></td>
                           <td><?= $val->usuario ?></td>
                           <td align="right"><?= ''.number_format($val->devengado,0) ?></td>
                           <td align="right"><?= ''.number_format($val->deduccion,0) ?></td>
                           <td align="right"><?= ''.number_format($val->Total_pagar,0) ?></td>
                           <td><?= $val->observacion?></td>
                           <td style=' width: 25px;'>
                              <a href="<?= Url::toRoute(["valor-prenda-unidad/vistadetallepago",'id_pago'=>$val->id_pago, 'fecha_inicio' => $fecha_inicio, 'fecha_corte' => $fecha_corte]) ?>" ><span class="glyphicon glyphicon-eye-open "></span></a>
                           </td>
                           <td style="width: 25px;">				
                               <a href="<?= Url::toRoute(["imprimircolillaconfeccion",'id_pago'=>$val->id_pago, 'fecha_inicio' => $fecha_inicio, 'fecha_corte' => $fecha_corte]) ?>" ><span class="glyphicon glyphicon-print" title="Imprimir "></span></a>
                           </td>
                           <input type="hidden" name="pago_servicio_confeccion[]" value="<?= $val->id_operario ?>">
                           <input type="hidden" name="id_pago[]" value="<?= $val->id_pago ?>">
                       </tr>    
                <?php endforeach; ?>
            </body>       
        </table> 
    
        <div class="panel-footer text-right" >            
                <?= Html::submitButton("<span class='glyphicon glyphicon-export'></span> Excel", ['name' => 'excel','class' => 'btn btn-primary btn-sm ']); ?>                
                <?= Html::submitButton("<span class='glyphicon glyphicon-check'></span> Cerrar-Abrir",['name' => 'cerrar_abrir', 'class' => 'btn btn-success btn-sm']);?>          
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
