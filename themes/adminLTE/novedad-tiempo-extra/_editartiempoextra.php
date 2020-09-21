<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\ConceptoSalarios;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
?>


<?php $form = ActiveForm::begin([
            "method" => "post",
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
                'options' => []
            ],
        ]); ?>
    <?php
//$motivos = ArrayHelper::map(MotivoTerminacion::find()->all(), 'id_motivo_terminacion', 'motivo');
?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">        
        <div class="table table-responsive">
            <div class="panel panel-success ">
                <div class="panel-heading">
                   Editar Novedades(Tiempo extra)
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">  
                        <thead>
                            <tr>                
                                <th scope="col">Código</th>
                                <th scope="col">Concepto salario</th>
                                <th scope="col">%Pago</th>
                                <th scope="col">Nro_Horas</th>

                                                       
                            </tr>
                         </thead>
                        <tbody>
                                <?php foreach ($datos_novedad as $val): ?>
                                  <tr>
                                      <td><input type="hidden" name="codigo_salario[]" value="<?= $val->codigo_salario ?>" readonly="readonly"><?= $val->codigo_salario ?></td>
                                      <td><?= $val->concepto?></td>
                                      <td><?= $val->porcentaje?>%</td>
                                      <td align ="right"><input type="text" style="text-align:right"  name="horas[]" value="<?= $val->nro_horas ?>" size="4"></td>
                                      <td><input type="hidden" name="vlr_hora[]" value="<?= $val->vlr_hora ?>" readonly="readonly"></td>
                                  </tr>

                              <?php endforeach; ?>   
                        </tbody>   
                    </table>    
                        
                </div>                
                <div class="panel-footer text-right">			
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-saved'></span>  Actualizar", ["class" => "btn btn-primary", 'name' => 'editarnovedad']) ?>                    
                </div>
            </div>
        </div>
    </div>
<?php $form->end() ?> 