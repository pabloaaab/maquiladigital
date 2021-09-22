<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\CantidadPrendaTerminadas;
use app\models\Balanceo;
use app\models\Horario;
use app\models\Ordenproduccion;

/*$cantidad_prendas = CantidadPrendaTerminadas::find()->where(['=', 'id_balanceo', $id_balanceo])->all();
$unidades = CantidadPrendaTerminadas::find()->where(['=', 'id_balanceo', $id_balanceo])->groupBy('fecha_entrada')->all();
$balanceo = Balanceo::find()->where(['=', 'id_balanceo', $id_balanceo])->one();
$horario = Horario::findOne(1);
$calculo = 0;
$calculo = round((60 / $balanceo->tiempo_balanceo) * ($horario->total_horas));
$orden_produccion = Ordenproduccion::findOne($orden->idordenproduccion);*/
?>
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
                <table class="table table-bordered table-striped table-hover">
                    
                </table>
            </div>
        </div>
    </div>
   <!-- COMIENZA EL TAB-->
  
</div>   


    


