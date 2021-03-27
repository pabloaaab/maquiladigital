<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\RemisionEntregaPrendaDetalles;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;
?>


<?php
$form = ActiveForm::begin([
            "method" => "post",
            'id' => 'formulario',
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
            'template' => '{label}<div class="col-sm-2 form-group">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => []
        ],
        ]);
?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">        
        <div class="table table-responsive">
            <div class="panel panel-success ">
                <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Existencias x talla
                </button>
                <div class="collapse" id="collapseExample">
                      <div class="well" style="font-size: 100%;">
                          <div class="row">
                               <?= $form->field($existencia, 't2')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't4')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't6')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't8')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't10')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't12')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't14')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't16')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't18')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't20')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't22')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't24')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't26')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't28')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't30')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't32')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't34')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't36')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't38')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't40')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't42')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't44')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 'xs')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 's')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 'm')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 'l')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 'xl')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 'xxl')->textInput(['maxlength' => true]) ?>
                               <?= $form->field($existencia, 't_unica')->textInput(['maxlength' => true]) ?>
                              
                          </div>    
                    </div>
                </div>
                <div class="panel-heading">
                   Informacion de entrada 
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?= $form->field($model, 'id_detalle')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
                         <?= $form->field($model, 'cantidad')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'valor_unitario')->textInput(['maxlength' => true]) ?>                        
                    </div>    
                    <div class="row">
                        <?= $form->field($model, 'porcentaje_descuento')->textInput(['maxlength' => true]) ?>                 
                    </div>    
                </div>        
            </div>   
            <div class="panel panel-success align-center">
                <div class="panel-heading ">
                   Tallas
                </div>
                <div class="panel-body"> 
                    <div class="row" >
                         <?php 
                         if ($cantidad_unidad){
                            if($cantidad_unidad->t2 > 0){?>
                                   <?= $form->field($model, 't12')->textInput(['maxlength' => true]) ?>
                            <?php } 
                             if($cantidad_unidad->t4 > 0){?>
                                   <?= $form->field($model, 't4')->textInput(['maxlength' => true]) ?>
                            <?php }
                             if($cantidad_unidad->t6 > 0){?>
                                   <?= $form->field($model, 't6')->textInput(['maxlength' => true]) ?>
                            <?php }
                             if($cantidad_unidad->t8 > 0){?>
                                   <?= $form->field($model, 't8')->textInput(['maxlength' => true]) ?>
                            <?php }
                             if($cantidad_unidad->t10 > 0){?>
                                   <?= $form->field($model, 't10')->textInput(['maxlength' => true]) ?>
                            <?php }
                             if($cantidad_unidad->t12 > 0){?>
                                   <?= $form->field($model, 't12')->textInput(['maxlength' => true]) ?>
                            <?php }
                             if($cantidad_unidad->t14 > 0){?>
                                   <?= $form->field($model, 't14')->textInput(['maxlength' => true]) ?>
                            <?php }
                             if($cantidad_unidad->t16 > 0){?>
                                   <?= $form->field($model, 't16')->textInput(['maxlength' => true]) ?>
                            <?php }
                             if($cantidad_unidad->t18 > 0){?>
                                   <?= $form->field($model, 't18')->textInput(['maxlength' => true]) ?>
                            <?php }
                             if($cantidad_unidad->t20 > 0){?>
                                   <?= $form->field($model, 't20')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t22 > 0){?>
                                   <?= $form->field($model, 't22')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t24 > 0){?>
                                   <?= $form->field($model, 't24')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t26 > 0){?>
                                   <?= $form->field($model, 't26')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t28 > 0){?>
                                   <?= $form->field($model, 't28')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t30 > 0){?>
                                   <?= $form->field($model, 't30')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t32 > 0){?>
                                   <?= $form->field($model, '32')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t34 > 0){?>
                                   <?= $form->field($model, 't34')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t36 > 0){?>
                                   <?= $form->field($model, 't36')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t38 > 0){?>
                                   <?= $form->field($model, 't38')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t40 > 0){?>
                                   <?= $form->field($model, 't40')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t42 > 0){?>
                                   <?= $form->field($model, 't42')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t44 > 0){?>
                                   <?= $form->field($model, 't44')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->xs > 0){?>
                                   <?= $form->field($model, 'xs')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->s > 0){?>
                                    <?= $form->field($model, 's')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->m > 0){?>
                                   <?= $form->field($model, 'm')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->l > 0){?>
                                   <?= $form->field($model, 'l')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->xl > 0){?>
                                   <?= $form->field($model, 'xl')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->xxl > 0){?>
                                   <?= $form->field($model, 'xxl')->textInput(['maxlength' => true]) ?>
                            <?php }
                            if($cantidad_unidad->t_unica > 0){?>
                                   <?= $form->field($model, 't_unica')->textInput(['maxlength' => true]) ?>
                            <?php }

                        }else{ 
                             
                            $mensaje = 'No hay existencias de esta referencia en sistema. Favor comuniquese con el administrador.';?>
                                <tr>
                                    <td colspan="8" style="background-color: #F5F0D8; align-content: center;"><?=  $mensaje?></td>
                                </tr>  
                        <?php }  ?>
                                   
                    </div>  
                </div> 
            </div>   
            <?php
               if ($cantidad_unidad){?>
                    <div class="panel-footer text-right">			
                        <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar", ["class" => "btn btn-primary", 'name' => 'actualizar']) ?>                    
                    </div>
               <?php }?> 
            
            
        </div>
    </div>
<?php $form->end() ?> 