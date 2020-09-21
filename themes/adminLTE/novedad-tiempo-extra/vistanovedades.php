<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
$this->title = 'Tiempo extra';
$this->params['breadcrumbs'][] = ['label' => 'Novedades de nomina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $id;
?>

<div class="programacion-nomina-view">
   
 <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
    ]);
    $contador = count($detalle); 
    ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            Informacion: Periodo de pago
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_grupo_pago') ?>:</th>
                   <td><?= Html::encode($model->grupoPago->grupo_pago) ?></td>  
                 
                   <th><?= Html::activeLabel($model, 'fecha_desde') ?>:</th>
                   <td><?= Html::encode($model->fecha_desde) ?></td>  
                    <th><?= Html::activeLabel($model, 'fecha_hasta') ?>:</th>
                   <td><?= Html::encode($model->fecha_hasta) ?></td> 
                   <th><?= Html::activeLabel($model, 'dias_pago') ?>:</th>
                   <td><?= Html::encode($model->dias_pago) ?></td> 
                </tr>               
            </table>
        </div>
    </div>
    <div class="table-responsive">
        <div class="panel panel-success ">
            <div class="panel-heading">
                Listado de empleados:<span class="badge"> <?= $contador?></span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Documento</th>                        
                        <th scope="col">Empleado</th>                        
                        <th scope="col">Desde</th>                        
                        <th scope="col">Hasta</th>                        
                        <th scope="col">Inicio Contrato</th> 
                        <th scope="col">Contrato</th> 
                        <th scope="col">Tipo_salario</th>
                        <th scope="col">Salario</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($detalle as $val): ?>
                    <tr>
                        <td><?= $val->cedula_empleado ?></td>
                        <td><?= $val->empleado->nombrecorto ?></td>
                        <td><?= $val->fecha_desde ?></td>
                        <td><?= $val->fecha_hasta ?></td>
                        <td><?= $val->fecha_inicio_contrato ?></td>
                        <td><?= $val->id_contrato ?></td>
                        <td><?= $val->tipo_salario ?></td>
                        <td><?= '$'.number_format($val->salario_contrato,0) ?></td>
                        <td>
                            <?php
                               if($val->tipo_salario == 'VARIABLE'){?>
                                    <?= Html::a('<span class="glyphicon glyphicon-book"></span>',            
                                    ['/novedad-tiempo-extra/creartiempoextra','id' => $val->id_periodo_pago_nomina, 'id_programacion'=>$val->id_programacion, 'tipo_salario' => $val->tipo_salario],
                                        [
                                            'title' => 'Crear novedades',
                                            'data-toggle'=>'modal',
                                            'data-target'=>'#modalcreartiempoextra'.$val->id_periodo_pago_nomina,
                                            'class' => 'btn btn-info btn-xs'
                                        ]
                                    );
                                    ?>
                                     <div class="modal remote fade" id="modalcreartiempoextra<?= $val->id_periodo_pago_nomina ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content"></div>
                                        </div>
                                     </div>
                                <?php }?>    
                       </td>
                      
                       <td>
                            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>',            
                            ['/novedad-tiempo-extra/editartiempoextra','id_empleado' => $val->id_empleado, 'id' => $val->id_periodo_pago_nomina],
                                [
                                    'title' => 'Editar novedades',
                                    'data-toggle'=>'modal',
                                    'data-target'=>'#modaleditartiempoextra'.$val->id_empleado,
                                    'class' => 'btn btn-primary btn-xs'
                                ]
                            );
                            ?>
                            <div class="modal remote fade" id="modaleditartiempoextra<?= $val->id_empleado ?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content"></div>
                                </div>
                          </div>
                       </td>   
                    </tbody>
                    <?php endforeach; ?>
                </table>
            </div>            
       
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

