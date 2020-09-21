<?php

use yii\helpers\Html;

/* @var $this yii\web\View */ 
/* @var $model app\models\PagoAdicionalPermanente */

$this->title = 'Actualizar Adición: ' . $model->id_pago_permanente;
$this->params['breadcrumbs'][] = ['label' => 'Adicional Permanentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pago_permanente, 'url' => ['view', 'id' => $model->id_pago_permanente, 'view', 'tipoadicion'=>$tipoadicion]];
$this->params['breadcrumbs'][] = 'Editar';
?>

<div class="pago-adicional-permanente-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    
 <?php  if($tipoadicion == 1) {
          echo $this->render('_form', [
            'model' => $model,
            'tipoadicion' => $tipoadicion,  
           ]);
        }else{         
           echo $this->render('_formdescuento', [
            'model' => $model,
            'tipoadicion' => $tipoadicion,   
           ]);  
        }
         ?>

</div>
