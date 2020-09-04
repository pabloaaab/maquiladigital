<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamento;
use app\models\TipoDocumento;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
?>

<?php

$this->title = 'Detalle Control Acceso Covid';
$this->params['breadcrumbs'][] = ['label' => 'Control Acceso Covid', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$view = 'Control Acceso Covid';
?>

<p>
    <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>    
</p>

<div class="panel panel-success">
    <div class="panel-heading">
        Información Detalle Control Acceso
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <th>Código:</th>
                <td><?= $table->id ?></td>
                <th>Tipo Identificación:</th>
                <td><?= $table->registroPersonal->tipoDocumento->descripcion ?></td>
                <th>N° Identificación:</th>
                <td><?= $table->documento ?></td> 
                <th>Nombre:</th>
                <td><?= $table->registroPersonal->nombrecompleto ?></td>
            </tr>
            <tr>
                
                <th>Fecha Ingreso:</th>
                <td><?= $table->fecha_ingreso ?></td>
                <th>Fecha Salida:</th>
                <td><?= $table->fecha_salida ?></td>                    
                <th>Temperatura Inicial:</th>
                <td><?= $table->temperatura_inicial ?></td>
                <th>Temperatura Final:</th>
                <td><?= $table->temperatura_final ?></td>
            </tr>
            <tr>
                <th>Tipo Personal:</th>
                <td><?= $table->tipo_personal ?></td>
                <th>Tiene Sintomas:</th>
                <td><?= $table->tieneSintomas ?></td>
                <th></th>
                <td></td>
                <th ></th>
                <td></td>
            </tr>            
        </table>
    </div>
</div>    
    <div class="table-responsive">
        <div class="panel panel-success ">
            <div class="panel-heading">
                Detalles
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Sintoma</th>
                        <th scope="col">Acceso</th>                        
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($modeldetalles as $val): ?>
                    <tr>
                        <td><?= $val->id ?></td>
                        <td><?= $val->idSintomaCov->sintoma ?></td>
                        <td><?= $val->acceso ?></td>                                                                                                                                                
                    </tr>
                    </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>


