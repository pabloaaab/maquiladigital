<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Ordenproduccion;
use app\models\Ordenproducciontipo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdenProduccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista Ordenes de Producción';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenproduccion-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?=  $this->render('_search', ['model' => $searchModel]); ?>

    <?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']), ['create'], ['class' => 'btn btn-success']);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'idordenproduccion',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'codigoproducto',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'ordenproduccion',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            /*[
                'attribute' => 'ordenproduccionext',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],*/
            [
                'attribute' => 'idcliente',
                'value' => function($model){
                    $clientes = Cliente::findOne($model->idcliente);
                    return "{$clientes->nombrecorto} - {$clientes->cedulanit}";
                },
                'filter' => ArrayHelper::map(Cliente::find()->all(),'idcliente','nombreClientes'),
                'contentOptions' => ['class' => 'col-lg-2'],
            ],                    
            [               
            'attribute' => 'fechaentrega',
            'value' => function($model){
                $ordenp = Ordenproduccion::findOne($model->idordenproduccion);
                return date("Y-m-d", strtotime("$ordenp->fechaentrega"));
            },
            'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'label' => 'Total',
                'attribute' => 'totalorden',
                'value' => function($model) {
                    $ordenp = Ordenproduccion::findOne($model->idordenproduccion);
                    $total = "$ ".number_format($ordenp->totalorden);
                    return "{$total}";
                },
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'autorizado',
                'value' => function($model){
                    $orden = Ordenproduccion::findOne($model->idordenproduccion);                    
                    return $orden->autorizar;
                },
                'filter' => ArrayHelper::map(Ordenproduccion::find()->all(),'autorizado','autorizar'),
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'facturado',
                'value' => function($model){
                    $orden = Ordenproduccion::findOne($model->idordenproduccion);                    
                    return $orden->facturar;
                },
                'filter' => ArrayHelper::map(Ordenproduccion::find()->all(),'facturado','facturar'),
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'idtipo',
                'value' => function($model){
                    $ordentipo = Ordenproducciontipo::findOne($model->idtipo);
                    return $ordentipo->tipo;
                },
                'filter' => ArrayHelper::map(Ordenproducciontipo::find()->all(),'idtipo','tipo'),
                'contentOptions' => ['class' => 'col-lg-1'],
            ],            
            [
                'class' => 'yii\grid\ActionColumn',              
            ],
			
        ],
        'tableOptions' => ['class' => 'table table-bordered table-success'],
        'summary' => '<div class="panel panel-success "><div class="panel-heading">Registros: {totalCount}</div>',

        'layout' => '{summary}{items}</div><div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">' . $newButton . '</div></div>',
        'pager' => [
            'nextPageLabel' => '<i class="fa fa-forward"></i>',
            'prevPageLabel'  => '<i class="fa fa-backward"></i>',
            'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
            'firstPageLabel'  => '<i class="fa fa-fast-backward"></i>'
        ],
        
    ]); ?>
</div>


