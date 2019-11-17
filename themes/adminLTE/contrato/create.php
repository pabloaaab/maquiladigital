<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */

$this->title = 'Nuevo Contrato';
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-create">
    
    <h3 class="alert-danger"><?= $msg ?></h3>    
    <?php 
        if ($id == null){
            echo $this->render('_formnuevocontrato', [
            'model' => $model,]);
        }else{
            echo $this->render('_formnuevocontratoempleado', [
            'model' => $model,]);
        }
    ?>    

</div>
