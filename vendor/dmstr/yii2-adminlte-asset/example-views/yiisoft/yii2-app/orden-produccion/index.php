<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Ordenproduccion;

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
                'attribute' => 'idcliente',
                'value' => function($model){
                    $clientes = Cliente::findOne($model->idcliente);
                    return "{$clientes->nombrecorto} - {$clientes->cedulanit}";
                },
                'filter' => ArrayHelper::map(Cliente::find()->all(),'idcliente','nombreClientes'),
                'contentOptions' => ['class' => 'col-lg-2.5'],
            ],
            [               
                'attribute' => 'fechallegada',
                'value' => function($model){
                    $ordenp = Ordenproduccion::findOne($model->idordenproduccion);
                    return date("Y-m-d", strtotime("$ordenp->fechallegada"));
                },
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [               
                'attribute' => 'fechaprocesada',
                'value' => function($model){
                    $ordenp = Ordenproduccion::findOne($model->idordenproduccion);
                    return date("Y-m-d", strtotime("$ordenp->fechaprocesada"));
                },
                'contentOptions' => ['class' => 'col-lg-1'],
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
                'contentOptions' => ['class' => 'col-lg-2'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',              
            ],
			
        ],
        'tableOptions' => ['class' => 'table table-success'],
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


