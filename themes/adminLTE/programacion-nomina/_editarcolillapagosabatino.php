<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\ProgramacionNominaDetalle;
use app\models\Empleado;
use app\models\GrupoPago;
use app\models\PeriodoPagoNomina;
use app\models\TipoNomina;
use app\models\ConceptoSalarios;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
?>

<?php $form = ActiveForm::begin([

    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
]); ?>
<div class="programacion-nomina-view">

 <!--<h1><?= Html::encode($this->title) ?></h1>-->
    
<?php $empleado = Empleado::findOne($model->id_empleado); ?>
<?php $detalle_nomina = ProgramacionNominaDetalle::find()->where(['=','id_programacion', $model->id_programacion])->orderBy('vlr_deduccion ASC')->all();?>    
<?php $grupo_pago = GrupoPago::findOne($model->id_grupo_pago); ?>
<?php $periodo_pago = PeriodoPagoNomina::findOne($model->id_periodo_pago_nomina); ?>
<?php $tipo_pago = app\models\TipoNomina::findOne($periodo_pago->id_tipo_nomina); ?>
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">
        <div class="panel panel-success">
            <div class="panel-heading">
               Comprobante de pago.
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover" WIDTH="80%">
                    <tr style ='font-size:85%;'>
                        <th><?= Html::activeLabel($model, 'id_programacion') ?></th>
                        <td><?= Html::encode($model->id_programacion) ?></td>
                        <th><?= Html::activeLabel($model, 'nro_pago') ?></th>
                        <td><?= Html::encode($model->nro_pago) ?></td>
                         <th><?= Html::activeLabel($model, 'fecha_desde') ?></th>
                        <td><?= Html::encode($model->fecha_desde) ?></td>
                          <th><?= Html::activeLabel($model, 'fecha_hasta') ?></th>
                        <td><?= Html::encode($model->fecha_hasta) ?></td>
                        <th><?= Html::activeLabel($model, 'salario_contrato') ?></th>
                        <td><?= Html::encode('$'. number_format($model->salario_contrato,0)) ?></td>

                    </tr>   
                    <tr style ='font-size:85%;'>
                        <th><?= Html::activeLabel($model, 'cedula_empleado') ?></th>
                        <td><?= Html::encode($model->cedula_empleado) ?></td>
                        <th><?= Html::activeLabel($model, 'id_empleado') ?></th>
                        <td colspan="3"><?= Html::encode($empleado->nombrecorto) ?></td>
                        <th><?= Html::activeLabel($model, 'id_contrato') ?></th>
                        <td><?= Html::encode($model->id_contrato) ?></td>
                         <th><?= Html::activeLabel($model, 'salario_promedio') ?></th>
                        <td><?= Html::encode('$'. number_format($model->salario_promedio,0)) ?></td>

                    </tr>   
                    <tr style ='font-size:85%;'>
                          <th><?= Html::activeLabel($model, 'Tipo_pago') ?>:</th>
                        <td><?= Html::encode($tipo_pago->tipo_pago) ?></td>
                        <th><?= Html::activeLabel($model, 'id_grupo_pago') ?></th>
                        <td colspan="3"><?= Html::encode($grupo_pago->grupo_pago) ?></td>
                        <th><?= Html::activeLabel($model, 'dias_pago') ?></th>
                        <td><?= Html::encode($model->dias_pago) ?></td>
                         <th><?= Html::activeLabel($model, 'total_devengado') ?></th>
                        <td><?= Html::encode('$'. number_format($model->total_devengado,0)) ?></td>

                    </tr>   
                     <tr style ='font-size:85%;'>
                        <th><?= Html::activeLabel($model, 'fecha_inicio_contrato') ?></th>
                        <td><?= Html::encode($model->fecha_inicio_contrato) ?></td>
                        <th><?= Html::activeLabel($model, 'id_periodo_pago_nomina') ?></th>
                        <td colspan="3"><?= Html::encode($model->id_periodo_pago_nomina) ?></td>
                        <th><?= Html::activeLabel($model, 'dia_real_pagado') ?></th>
                        <td><?= Html::encode($model->dia_real_pagado) ?></td>
                         <th><?= Html::activeLabel($model, 'total_deduccion') ?></th>
                        <td><?= Html::encode('$'. number_format($model->total_deduccion,0)) ?></td>
                     </tr>   
                     <tr style ='font-size:85%;'>
                         <th><?= Html::activeLabel($model, 'fecha_creacion') ?></th>
                        <td><?= Html::encode($model->fecha_creacion) ?></td>
                        <th><?= Html::activeLabel($model, 'Usuario') ?>:</th>
                        <td  colspan="3"><?= Html::encode($model->usuariosistema) ?></td>
                        <th><?= Html::activeLabel($model, 'tipo_salario') ?>:</th>
                        <td><?= Html::encode($model->tipo_salario) ?></td>
                         <th><?= Html::activeLabel($model, 'total_pagar') ?></th>
                        <td><?= Html::encode('$'. number_format($model->total_pagar,0)) ?></td>

                    </tr>   
                </table>
            </div>
        </div>
    </div>
    
    <div>
        <div class="modal-body">
            <div class="panel panel-success">
                <div class="panel-heading">
                   Detalle del pago.
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover" WIDTH="80%">
                        <thead>
                            <tr align="center" >
                                <th scope="col">Id</th> 
                                <th scope="col">Código</th>  
                                <th scope="col">Concepto</th>
                                <th scope="col">Vr. Hora</th>
                                <th scope="col">Vr. Día</th>  
                                 <th scope="col">Deducción</th>   
                                 <th scope="col">Devengado</th>   
                                  <th scope="col">Nro_Horas</th>
                                 <th scope="col">Nro_Dias</th>   
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($detalle_nomina as $val):
                                   // foreach ($concepto as $salario):
                                   $codigo_salario = 0;
                                   $codigo_salario = $val->codigo_salario;
                                   $concepto = ConceptoSalarios::find()->where(['=','codigo_salario', $codigo_salario])->one();
                                        if($concepto->auxilio_transporte == 1){
                                            ?>
                                           <tr style ='font-size:80%;'>
                                               <td><input type="hidden" name="id_detalle[]" value="<?= $val->id_detalle ?>" readonly="readonly"><?= $val->id_detalle ?></td>
                                               <td><?= $val->codigo_salario ?></td>  
                                               <td ><?= $concepto->nombre_concepto ?></td>
                                               <input type="hidden" name="vlr_hora[]" value="<?= $val->vlr_hora ?>" readonly="readonly">
                                               <td align="right"><?= ''.number_format($val->vlr_hora, 2) ?></td>
                                                <input type="hidden" name="vlr_dia[]" value="<?= $val->vlr_dia ?>" readonly="readonly">
                                               <td align="right"><?= ''.number_format($val->vlr_dia, 2) ?></td>
                                               <td align="right"><?= '$'.number_format($val->vlr_deduccion,0) ?></td>
                                               <td align="right"><?= '$'.number_format($val->auxilio_transporte,0) ?></td>
                                               <td align ="right"><input type="text" style="text-align:right"  name="horas_periodo_reales[]" value="<?= $val->horas_periodo_reales ?>" size="5"></td>
                                               <td align ="right"><input type="text" style="text-align:right"  name="dias_transporte[]" value="<?= $val->dias_transporte ?>" size="5"></td>
                                               <input type="hidden" name="dias_reales[]" value="" readonly="readonly">
                                               <input type="hidden" name="porcentaje[]" value="<?= $val->porcentaje ?>" readonly="readonly">
                                          </tr>
                                        <?php
                                        }else{
                                            if ($concepto->inicio_nomina == 1){
                                                ?>
                                                <tr style ='font-size:80%;'>
                                                  <td><input type="hidden" name="id_detalle[]" value="<?= $val->id_detalle ?>" readonly="readonly"><?= $val->id_detalle ?></td>
                                                  <td><?= $val->codigo_salario ?></td>  
                                                  <td ><?= $concepto->nombre_concepto ?></td>
                                                   <input type="hidden" name="vlr_hora[]" value="<?= $val->vlr_hora ?>" readonly="readonly">
                                                   <td align="right"><?= ''.number_format($val->vlr_hora, 2) ?></td>
                                                   <input type="hidden" name="vlr_dia[]" value="<?= $val->vlr_dia ?>" readonly="readonly">
                                                  <td align="right"><?= ''.number_format($val->vlr_dia, 2) ?></td>
                                                  <td align="right"><?= '$'.number_format($val->vlr_deduccion,0) ?></td>
                                                  <td align="right"><?= '$'.number_format($val->vlr_devengado,0) ?></td>
                                                   <td align ="right"><input type="text" style="text-align:right"  name="horas_periodo_reales[]" value="<?= $val->horas_periodo_reales ?>" size="5"></td>
                                                  <td align ="right"><input type="text" style="text-align:right"  name="dias_reales[]" value="<?= $val->dias_reales ?>" size="5"></td>
                                                  <input type="hidden" name="dias_transporte[]" value="" readonly="readonly">
                                                  <input type="hidden" name="porcentaje[]" value="<?= $val->porcentaje ?>" readonly="readonly">

                                                </tr>
                                            <?php
                                            }else{
                                                if ($concepto->concepto_pension == 1 or $concepto->concepto_salud == 1 ){
                                                    ?>
                                                    <tr style ='font-size:80%;'>
                                                        <td><input type="hidden" name="id_detalle[]" value="<?= $val->id_detalle ?>" readonly="readonly"><?= $val->id_detalle ?></td>
                                                        <td><?= $val->codigo_salario ?></td>  
                                                        <td ><?= $concepto->nombre_concepto ?></td>
                                                         <input type="hidden" name="vlr_hora[]" value="<?= $val->vlr_hora ?>" readonly="readonly">
                                                         <td align="right"><?= ''.number_format($val->vlr_hora, 2) ?></td>
                                                         <input type="hidden" name="vlr_dia[]" value="<?= $val->vlr_dia ?>" readonly="readonly">
                                                        <td align="right"><?= ''.number_format($val->vlr_dia, 2) ?></td>
                                                        <td align="right"><?= '$'.number_format($val->vlr_deduccion,0) ?></td>
                                                        <td align="right"><?= '$'.number_format($val->vlr_devengado,0) ?></td>
                                                         <td align ="right"><input type="text" style="text-align:right"  name="horas_periodo_reales[]" value="<?= $val->horas_periodo_reales ?>" size="5"></td>
                                                        <td align ="right"><input type="text" style="text-align:right"  name="dias_reales[]" value="<?= $val->dias_reales ?>" size="5"></td>
                                                        <input type="hidden" name="dias_transporte[]" value="" readonly="readonly">
                                                        <input type="hidden" name="porcentaje[]" value="<?= $val->porcentaje ?>" readonly="readonly">
                                                   </tr> 
                                                <?php }   
                                            }
                                        }
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer text-right">			
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-saved'></span>  Actualizar", ["class" => "btn btn-primary"]) ?>                     
                </div>
            </div>
        </div>    
    </div>  
    <?php ActiveForm::end(); ?>
</div>      