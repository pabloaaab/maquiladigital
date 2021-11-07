<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\Session;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\AccessControl;


/* @var $this yii\web\View */
/* @var $model app\models\Empleado */

$this->title = 'Preparación';
$this->params['breadcrumbs'][] = ['label' => 'Preparación', 'url' => ['view_balanceo','id' =>$id]];
$this->params['breadcrumbs'][] = $detalletallas->iddetalleorden;
$view = 'orden-produccion/recoger_prenda_preparada';
$orden = app\models\Ordenproduccion::findOne($id);
?>
<div class="operarios-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['view_balanceo', 'id' => $detalletallas->idordenproduccion], ['class' => 'btn btn-primary btn-sm']) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Detalle
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($detalletallas, 'Id') ?>:</th>
                    <td><?= Html::encode($detalletallas->iddetalleorden) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($detalletallas, 'Producto_Talla') ?>:</th>
                    <td><?= Html::encode($detalletallas->productodetalle->prendatipo->prenda.' / '.$detalletallas->productodetalle->prendatipo->talla->talla) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($detalletallas, 'Unidades') ?>:</th>
                    <td><?= Html::encode($detalletallas->cantidad) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($detalletallas, 'Orden_Produccion') ?>:</th>
                    <td><?= Html::encode($detalletallas->idordenproduccion)?> - OP cliente (<?= Html::encode($orden->ordenproduccion)?>)</td>
                </tr>
                
            </table>
        </div>
    </div>
   
      <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
                'options' => []
            ],
            ]); ?>
    <div class="table-responsive">
        <div class="panel panel-success ">
            <div class="panel-heading">
                Registros:<span class="badge"><?= count($detalle_balanceo) ?></span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead >
                        <tr style='font-size: 85%;'>
                             <td scope="col" style='background-color:#B9D5CE;'><b>Código</b></td> 
                            <td scope="col" style='background-color:#B9D5CE;'><b>Operación</b></td>                        
                            <td scope="col" style='background-color:#B9D5CE;'><b>Operario</b></td>
                            <td scope="col" style='background-color:#B9D5CE;'><span title="Numero de operarios"><b># Operario</b></span></td>
                            <td scope="col" style='background-color:#B9D5CE;'><b>Fecha_entrada</b></td>
                            <th scope="col" style='background-color:#B9D5CE;'>Cantidad</th>
                            <th scope="col" style='background-color:#B9D5CE;'>Observación</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(count($detalle_balanceo) > 0){
                            $total_operaciones = 0;
                            $total_operaciones = count($detalle_balanceo) * $detalletallas->cantidad;
                            foreach ($detalle_balanceo as $val):?>
                                   <tr style='font-size: 85%;'>
                                        <td><?= $val->id_proceso ?></td>
                                        <td><?= $val->proceso->proceso ?></td>
                                        <td><?= $val->operario->nombrecompleto ?></td>
                                        <td ><input type="text" name="nro_operario[]" value="1" readonly="true"></td>
                                        <td><input type="date" name="fecha_entrada[]" value="<?php echo date("Y-m-d");?>" size="10" required></td>
                                        <td ><input type ="text"  name="cantidad[]" value="0"></td>
                                        <td><input type="text" name="observacion[]"  value="" size = "40" maxlength="25" ></td>
                                        <!-- varibales-->
                                         <input type="hidden" name="id_proceso[]" value="<?= $val->id_proceso ?>">
                                        <input type="hidden" name="id_operario[]" value="<?= $val->id_operario ?>">
                                        <input type="hidden" name="id_balanceo[]" value="<?= $modulo ?>">
                                        <input type="hidden" name="iddetalleorden[]" value="<?= $iddetalleorden ?>">
                                        <input type="hidden" name="total_operaciones[]" value="<?= $total_operaciones ?>">
                                  </tr>

                       <?php
                        endforeach; 
                        }else{
                           Yii::$app->getSession()->setFlash('info', 'La orden de produccion No '.$detalletallas->idordenproduccion .', no se le ha generado modulo de preparación.'); 
                        }
                        ?>
                    </tbody>
                </table>
                <div class="panel-footer text-right">
                   <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Enviar", ["class" => "btn btn-success btn-sm"]) ?>
                </div>
            </div>            
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
