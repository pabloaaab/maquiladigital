<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\CantidadPrendaTerminadas;
use app\models\Balanceo;
use app\models\Horario;
use app\models\Ordenproduccion;

$cantidad_prendas= CantidadPrendaTerminadas::find()->where(['=','id_balanceo', $id_balanceo])->all(); 
$unidades= CantidadPrendaTerminadas::find()->where(['=','id_balanceo', $id_balanceo])->groupBy('fecha_entrada')->all(); 
$balanceo = Balanceo::find()->where(['=','id_balanceo', $id_balanceo])->one();
$horario = Horario::findOne(1);
$calculo = 0;
$calculo = round((60/$balanceo->tiempo_balanceo) *($horario->total_horas));
$orden_produccion = Ordenproduccion::findOne($orden->idordenproduccion); 
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
   
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">
        <div class="panel panel-success">
            <div class="panel-heading">
               Modulo
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <tr style ='font-size:95%;'>
                        <th><?= Html::activeLabel($balanceo, 'Nro_Balanceo') ?>:</th>
                        <td><?= Html::encode($balanceo->id_balanceo) ?></td>
                        <th><?= Html::activeLabel($balanceo, 'fecha_inicio') ?>:</th>
                        <td><?= Html::encode($balanceo->fecha_inicio) ?></td>
                         <th><?= Html::activeLabel($balanceo, 'fecha_terminacion') ?></th>
                        <td><?= Html::encode($balanceo->fecha_terminacion) ?></td>
                        <th><?= Html::activeLabel($balanceo, 'Minutos_Proveedor') ?>:</th>
                        <td><?= Html::encode($orden_produccion->duracion) ?></td>
                        </tr>   
                    <tr style ='font-size:95%;'>
                           <th><?= Html::activeLabel($balanceo, 'Minutos_Confección') ?>:</th>
                        <td><?= Html::encode($balanceo->total_minutos) ?></td>
                         <th><?= Html::activeLabel($balanceo, 'Minutos_Balanceo') ?>:</th>
                        <td><?= Html::encode($balanceo->tiempo_balanceo) ?></td>
                        <th><?= Html::activeLabel($balanceo, 'Tiempo_Operario') ?>:</th>
                         <td><?= Html::encode($balanceo->tiempo_operario) ?></td>
                        <th><?= Html::activeLabel($balanceo, 'Usuario') ?>:</th>
                        <td colspan="5"><?= Html::encode($balanceo->usuariosistema) ?></td>
                    </tr>   
                </table>
            </div>
        </div>
    </div>
   <!-- COMIENZA EL TAB-->
  
</div>   
<?php $form->end() ?> 

    


