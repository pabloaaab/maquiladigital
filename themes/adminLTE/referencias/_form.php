<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Proveedor;
use app\models\Bodega;
use kartik\select2\Select2;
use kartik\date\DatePicker;
$this->title = 'Referencia';
$this->params['breadcrumbs'][] = ['label' => 'Referencias', 'url' => ['index']];
?>
<?php
$form = ActiveForm::begin([
            "method" => "post",
            'id' => 'formulario',
            'enableClientValidation' => false,
            'enableAjaxValidation' => false,
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
            'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'options' => []
        ],
        ]);
$proveedor = ArrayHelper::map(Proveedor::find()->where(['=','genera_moda', 1])->orderBy ('nombrecorto ASC')->all(), 'idproveedor', 'nombrecorto');
$bodega = ArrayHelper::map(Bodega::find()->where(['=','estado', 1])->orderBy ('descripcion ASC')->all(), 'id_bodega', 'descripcion');
?>
        <div class="panel panel-success">
            <div class="panel-heading">
                Datos de la referencia
            </div>
            <div class="panel-body">
                
                <div class="row">
                     <?= $form->field($model, 'id_producto')->widget(Select2::classname(), [
                    'data' => $producto,
                    'options' => ['placeholder' => 'Seleccione...'],
                    'pluginOptions' => [
                        'allowClear' => true ]]);
                    ?>
                    <?= $form->field($model, 'existencias')->textInput(['maxlength' => true]) ?>
               
                </div>
                <div class="row">
                    <?= $form->field($model, 'porcentaje_mayorista')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'porcentaje_deptal')->textInput(['maxlength' => true]) ?>
                  
                </div>
                 <div class="row">
                      <?= $form->field($model, 'idproveedor')->widget(Select2::classname(), [
                    'data' => $proveedor,
                    'options' => ['placeholder' => 'Seleccione...'],
                    'pluginOptions' => [
                        'allowClear' => true ]]);
                    ?>
                      <div class="row">
                      <?= $form->field($model, 'id_bodega')->widget(Select2::classname(), [
                    'data' => $bodega,
                    'options' => ['placeholder' => 'Seleccione...'],
                    'pluginOptions' => [
                        'allowClear' => true ]]);
                    ?>
                </div>
               
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Tallas:
                    </div>
                    <div class="panel-body">
                       <table class="table table-responsive"> 
                           <tr>
                               <td  style="padding-left: 1;padding-right: 1; "><b>T 2:</b><input type="text" name="t2" value="0" style="text-align:right"  value="<?= $model->t2 ?>" size="3"></td>
                               <td  style="padding-left: 1;padding-right: 1;"><b>T 4:</b><input type="text" name="t4" value="0" style="text-align:right" value="<?= $model->t4 ?>" size="3"></td>   
                                <td style="padding-left: 1;padding-right: 1; "><b>T 6:</b><input type="text" name="t6" value="0" style="text-align:right" value="<?= $model->t6 ?>" size="3" ></td> 
                                <td style="padding-left: 1;padding-right: 1; "><b>T 8:</b><input type="text" name="t8"  value="0" style="text-align:right" value="<?= $model->t8 ?>" size="3" ></td> 
                                <td style="padding-left: 1;padding-right: 1; "><b>T 10:</b><input type="text" name="t10" value="0" style="text-align:right" value="<?= $model->t10 ?>" size="3" ></td> 
                                <td style="padding-left: 1;padding-right: 1; "><b>T 12:</b><input type="text" name="t12" value="0" style="text-align:right" value="<?= $model->t12 ?>" size="3" ></td> 
                                <td style="padding-left: 1;padding-right: 1; "><b>T 14:</b><input type="text" name="t14" value="0" style="text-align:right" value="<?= $model->t14 ?>" size="3" ></td> 
                                <td style="padding-left: 1;padding-right: 1; "><b>T 16:</b><input type="text" name="t16" value="0" style="text-align:right" value="<?= $model->t16 ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T 18:</b><input type="text" name="t18" value="0"  style="text-align:right" value="<?= $model->t18 ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T 20:</b><input type="text" name="t20" value="0" style="text-align:right" value="<?= $model->t20 ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T 22:</b><input type="text" name="t22" value="0" style="text-align:right" value="<?= $model->t22 ?>" size="3"></td>
                                
                           </tr>
                           <tr>
                                <td style="padding-left: 1;padding-right: 1; "><b>T 24:</b><input type="text" name="t24" value="0" style="text-align:right" value="<?= $model->t24 ?>" size="3"></td>  
                                <td style="padding-left: 1;padding-right: 1; "><b>T 26:</b><input type="text" name="t26" value="0" style="text-align:right" value="<?= $model->t26 ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T 28:</b><input type="text" name="t28" value="0" style="text-align:right" value="<?= $model->t28 ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1;"><b>T 30:</b><input type="text" name="t30" value="0" style="text-align:right" value="<?= $model->t30 ?>" size="3"></td>
                               <td style="padding-left: 1;padding-right: 1; "><b>T 32:</b><input type="text" name="t32" value="0" style="text-align:right" value="<?= $model->t32 ?>" size="3"></td> 
                               <td style="padding-left: 1;padding-right: 1; "><b>T 34:</b><input type="text" name="t34" value="0" style="text-align:right" value="<?= $model->t34 ?>" size="3"></td>
                               <td style="padding-left: 1;padding-right: 1; "><b>T 36:</b><input type="text" name="t36" value="0" style="text-align:right" value="<?= $model->t36 ?>" size="3"></td>
                               <td style="padding-left: 1;padding-right: 1; "><b>T 38:</b><input type="text" name="t38" value="0" style="text-align:right" value="<?= $model->t38 ?>" size="3"></td>
                               <td style="padding-left: 1;padding-right: 1; "><b>T 40:</b><input type="text" name="t40" value="0" style="text-align:right" value="<?= $model->t40 ?>" size="3"></td>
                               <td style="padding-left: 1;padding-right: 1; "><b>T 42:</b><input type="text" name="t42" value="0" style="text-align:right" value="<?= $model->t42 ?>" size="3"></td>
                               <td style="padding-left: 1;padding-right: 1; "><b>T 44:</b><input type="text" name="t44" value="0" style="text-align:right" value="<?= $model->t44 ?>" size="3"></td>
                           </tr>
                           <tr>
                                <td style="padding-left: 1;padding-right: 1; "><b>T xs:</b><input type="text" name="txs" value="0" style="text-align:right" value="<?= $model->xs ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T s:</b><input type="text" name="ts" value="0" style="text-align:right" value="<?= $model->s ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T m:</b><input type="text" name="tm" value="0" style="text-align:right" value="<?= $model->m ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T l:</b><input type="text" name="tl" value="0" style="text-align:right" value"<?= $model->l ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T xl:</b><input type="text" name="txl" value="0" style="text-align:right" value="<?= $model->xl ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T xxl:</b><input type="text" name="txxl" value="0" style="text-align:right" value="<?= $model->xxl ?>" size="3"></td>
                                <td style="padding-left: 1;padding-right: 1; "><b>T_unica:</b><input type="text" name="t_unica" value="0" style="text-align:right" value="<?= $model->t_unica ?>" size="3"></td>
                               
                           </tr>
                           
                       </table>    

                    </div>
                </div>   
                <div class="panel-footer text-right">			
                    <a href="<?= Url::toRoute("referencias/index") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success btn-sm",]) ?>
                </div>
            </div>
        </div>
<?php $form->end() ?>     
