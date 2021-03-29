<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

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

$this->title = 'Tallas x referencias';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="referencias-view">
     <!--<h1><?= Html::encode($this->title) ?></h1>-->
        <p>
            <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
            <?php if($model->autorizado == 0){?>
               <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Autorizar', ['autorizado', 'id' => $model->id_referencia], ['class' => 'btn btn-default btn-sm']);
             } else {
              echo Html::a('<span class="glyphicon glyphicon-remove"></span> Desautorizar', ['autorizado', 'id' => $model->id_referencia], ['class' => 'btn btn-default btn-sm']);
             } ?>
           
    <div class="panel panel-success">
        <div class="panel-heading">
            Detalle referencia
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                 <tr style= 'font-size:85%;'>
                      <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Id') ?></th>
                    <td><?= Html::encode($model->id_referencia) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Costo') ?></th>
                    <td><?= Html::encode(''.number_format($model->precio_costo,0)) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Porcentaje_mayorista') ?></th>
                    <td><?= Html::encode($model->porcentaje_mayorista) ?>%</td>
                   <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Porcentaje_deptal') ?></th>
                    <td><?= Html::encode($model->porcentaje_deptal) ?>%</td>  
                      <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'precio_venta_mayorista') ?></th>
                      <td style="text-align: right"><?= Html::encode('$'.number_format($model->precio_venta_mayorista,0)) ?></td>
                </tr>   
                <tr style= 'font-size:85%;'>
                      <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Entrada') ?></th>
                    <td><?= Html::encode($model->existencias) ?></td>
                      <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Autorizado') ?></th>
                    <td><?= Html::encode($model->autorizadoreferencia) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'F_creacion') ?></th>
                    <td><?= Html::encode($model->fecha_creacion) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Usuario') ?></th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                      <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'precio_venta_deptal') ?></th>
                      <td style="text-align: right"><?= Html::encode('$'.number_format($model->precio_venta_deptal,0)) ?></td>
                </tr>   
            </table>
        </div>
    </div>    

<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tallas" aria-controls="tallas" role="tab" data-toggle="tab">Tallas</a></li>
       <li role="presentation"><a href="#colores" aria-controls="colores" role="tab" data-toggle="tab">Colores: <span class="badge"><?= 1 ?></span></a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tallas">
            <div class="table-responsive">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr style='font-size:85%;'align="center" >                
                                    <th scope="col" style='background-color:#B9D5CE;'>Codigo</th>
                                     <th scope="col" style='background-color:#B9D5CE;'>Referencia</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>Exist.</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-2</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-4</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-6</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-8</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-10</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-12</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-14</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-16</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-18</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-20</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-22</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-24</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-26</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-28</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-30</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-32</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-34</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-36</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-38</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-40</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-42</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-44</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-xs</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-s</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-m</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-l</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-xl</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>T-xxl</th>
                                     <th scope="col" style='background-color:#B9D5CE;'>T-Unica</th>
                          
                                </tr>
                            </thead>
                            <tbody>
                                <tr style='font-size:85%;'>                
                                   <td><?= $model->codigo_producto?></td>
                                   <td><?= $model->descripcion?></td>
                                   <td><?= $model->total_existencias?></td>
                                   <td><?= $model->t2?></td>
                                   <td><?= $model->t4?></td>
                                   <td><?= $model->t6?></td>
                                   <td><?= $model->t8?></td>
                                   <td><?= $model->t10?></td>
                                   <td><?= $model->t12?></td>
                                   <td><?= $model->t14?></td>
                                   <td><?= $model->t16?></td>
                                   <td><?= $model->t18?></td>
                                   <td><?= $model->t20?></td>
                                   <td><?= $model->t22?></td>
                                   <td><?= $model->t24?></td>
                                   <td><?= $model->t26?></td>
                                   <td><?= $model->t28?></td>
                                   <td><?= $model->t30?></td>
                                   <td><?= $model->t32?></td>
                                   <td><?= $model->t34?></td>
                                   <td><?= $model->t36?></td>
                                   <td><?= $model->t38?></td>
                                   <td><?= $model->t40?></td>
                                   <td><?= $model->t42?></td>
                                   <td><?= $model->t44?></td>
                                   <td><?= $model->xs?></td>
                                   <td><?= $model->s?></td>
                                   <td><?= $model->m?></td>
                                   <td><?= $model->l?></td>
                                   <td><?= $model->xl?></td>
                                   <td><?= $model->xxl?></td>
                                   <td><?= $model->t_unica?></td>
                                </tr>
                                
                            </tbody>        
                        </table>
                    </div>    
                </div>
            </div>    
        </div>
        <!-- TERMINA EL TABS-->
        <div role="tabpanel" class="tab-pane" id="colores">
            <div class="table-responsive">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                               <tr style='font-size:85%;'>                
                                    <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>Id Prog.</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>Tipo pago</th>
                                    <th scope="col" style='background-color:#B9D5CE;'>Documento</th>                
                                    <th scope="col" style='background-color:#B9D5CE;'>Empleado</th>  
                                    <th scope="col" style='background-color:#B9D5CE;'>Pago cesantia</th> 
                                    <th scope="col" style='background-color:#B9D5CE;'>pago interes</th> 
                                    <th scope="col" style='background-color:#B9D5CE;'>% pago</th> 
                                    <th scope="col" style='background-color:#B9D5CE;'>Nro dias</th> 
                                    <th scope="col" style='background-color:#B9D5CE;'>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>        
                        </table>
                    </div>    
                </div>
            </div>    
        </div>
        <!-- TERMINA EL TABS-->
    </div>
  </div>
</div>    










