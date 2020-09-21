<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Facturaventa;
use app\models\Matriculaempresa;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FacturaventaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Factura de venta';
$this->params['breadcrumbs'][] = $this->title;
$empresa = \app\models\Matriculaempresa::findOne(1);
        
?>
<div class="facturaventa-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?=  $this->render('_search', ['model' => $searchModel]); ?>

    <?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']), ['create'], ['class' => 'btn btn-success btn-sm']);?>
    <?php if ($empresa->factura_venta_libre == 0){ ?>
        <?php $newButton2 = ''; ?>
    <?php }else{ ?>
        <?php $newButton2 = Html::a('Nuevo Libre ' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']), ['createlibre'], ['class' => 'btn btn-success btn-sm']);?>
    <?php } ?>
    
    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,        
        'columns' => [                  
            [
                'attribute' => 'nrofactura',
                'contentOptions' => ['class' => 'col-lg-1'],                
            ],
            [
                'attribute' => 'nrofacturaelectronica',
                'contentOptions' => ['class' => 'col-lg-1'],                
            ],
            [
                'attribute' => 'idcliente',
                'value' => function($model){
                    $clientes = Cliente::findOne($model->idcliente);
                    return "{$clientes->nombrecorto} - {$clientes->cedulanit}";
                },
                'filter' => ArrayHelper::map(Cliente::find()->all(),'idcliente','nombreClientes'),
                'contentOptions' => ['class' => 'col-lg-3'],
            ],
           
            [               
                'attribute' => 'fechainicio',
                'contentOptions' => ['class' => 'col-lg-1 '],
            ],
            [
                'attribute' => 'subtotal',
                'value' => function($model) {
                    $factura = Facturaventa::findOne($model->idfactura);
                    $subtotal = "$ ".number_format($factura->subtotal);
                    return "{$subtotal}";
                },
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'label' => 'Total',
                'attribute' => 'totalpagar',
                'value' => function($model) {
                    $factura = Facturaventa::findOne($model->idfactura);
                    $total = "$ ".number_format($factura->totalpagar);
                    return "{$total}";
                },
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'autorizado',
                'value' => function($model){
                    $factura = Facturaventa::findOne($model->idfactura);                    
                    return $factura->autorizar;
                },
                'filter' => ArrayHelper::map(Facturaventa::find()->all(),'autorizado','autorizar'),
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'estado',
                'value' => function($model){
                    $factura = Facturaventa::findOne($model->idfactura);                    
                    return $factura->estados;
                },
                'filter' => ArrayHelper::map(Facturaventa::find()->all(),'estado','estados'),
                'contentOptions' => ['class' => 'col-lg-1.2'],
            ],                     
            [
                'class' => 'yii\grid\ActionColumn',                
            ],
			
        ],
        'tableOptions' => ['class' => 'table table-bordered table-success'],
        'summary' => '<div class="panel panel-success "><div class="panel-heading">Registros:<span class="badge">{totalCount}</span></div>',        
        'layout' => '{summary}{items}</div><div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">' . $newButton2 .' ' . $newButton .'</div></div>',                                
        'pager' => [
            'nextPageLabel' => '<i class="fa fa-forward"></i>',
            'prevPageLabel'  => '<i class="fa fa-backward"></i>',
            'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
            'firstPageLabel'  => '<i class="fa fa-fast-backward"></i>'
        ],
        
    ]); ?>
    <?php Pjax::end(); ?>
</div>
