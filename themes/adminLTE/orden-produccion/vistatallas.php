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

$this->title = 'Detalle de cantidad';
$this->params['breadcrumbs'][] = ['label' => 'Detalle', 'url' => ['view_balanceo']];
$this->params['breadcrumbs'][] = $detalletallas->iddetalleorden;
$view = 'orden-produccion/vistatallas';
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
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($detalletallas, 'Cantidad') ?>:</th>
                    <td><?= Html::encode($detalletallas->cantidad) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($detalletallas, 'Operario') ?>:</th>
                    <td><?= Html::encode($detalletallas->idordenproduccion) ?></td>
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
                Registros:<span class="badge"><?= count($cantidad) ?></span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead >
                        <tr style='font-size: 85%;'>
                            <td scope="col" style='background-color:#B9D5CE;'><b>Id</b></td>                        
                            <td scope="col" style='background-color:#B9D5CE;'><b>Nro Balanceo</b></td>                        
                            <th scope="col" style='background-color:#B9D5CE;'>Op</th>                        
                            <th scope="col" style='background-color:#B9D5CE;'>F. Entrada</th>
                            <th scope="col" style='background-color:#B9D5CE;'>F. Registro</th>
                            <td scope="col"  style='background-color:#B9D5CE;'><b>Nro prendas</b></td>   
                            <th scope="col" style='background-color:#B9D5CE;'>Observación</th>
                            <th scope="col" style='background-color:#B9D5CE;'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_c =0;
                        foreach ($cantidad as $val):
                            $total_c += $val->cantidad_terminada;
                            ?>
                        <tr style='font-size: 85%;'>
                            <td><?= $val->id_entrada ?></td>
                            <td><?= $val->id_balanceo ?></td>
                            <td><?= $val->idordenproduccion ?></td>
                            <td><?= $val->fecha_entrada ?></td>
                            <td><?= $val->fecha_procesada ?></td>
                            <td align = "right"><?= $val->cantidad_terminada ?></td>
                             <td><?= $val->observacion ?></td>
                            <td style=' width: 25px;'>
                               <a href="<?= Url::toRoute(["orden-produccion/editarentrada",'id_entrada'=>$val->id_entrada, "iddetalleorden" => $detalletallas->iddetalleorden]) ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                            </td>                            
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                     <td colspan="5"></td><td style="font-size: 85%; width: 140px; text-align: right; background: #4B6C67; color: #FFFFFF;"><b>Total:</b> <?= $total_c ?> <td colspan="2"></td>
                </table>
            </div>            
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
