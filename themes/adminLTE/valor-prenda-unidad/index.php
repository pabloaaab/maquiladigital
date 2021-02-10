<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FichatiempoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Valor de prenda';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valor-prenda-unidad-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?=  $this->render('_search', ['model' => $searchModel]); ?>

    <?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']), ['create'], ['class' => 'btn btn-success']);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            [                
                'attribute' => 'id_valor',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
             [                
                'attribute' => 'idordenproduccion',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
             [                
             'attribute' => 'idtipo',
                'value' => function($model){
                    $servicio = \app\models\Ordenproducciontipo::findOne($model->idtipo);                    
                    return $servicio->tipo;
                },
                'filter' => ArrayHelper::map(\app\models\Ordenproducciontipo::find()->all(),'idtipo','tipo'),
                'contentOptions' => ['class' => 'col-lg-2'],
                        
            ],
            [                
                'attribute' => 'vlr_vinculado',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
             [                
                'attribute' => 'vlr_contrato',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
             [                
                'attribute' => 'total_pagar',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'estado_valor',
                'value' => function($model){
                    $estado = \app\models\ValorPrendaUnidad::findOne($model->id_valor);                    
                    return $estado->estadovalor;
                },
                'filter' => ArrayHelper::map(\app\models\ValorPrendaUnidad::find()->all(),'estado_valor','estadovalor'),
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'autorizado',
                'value' => function($model){
                    $autorizado = \app\models\ValorPrendaUnidad::findOne($model->id_valor);                    
                    return $autorizado->autorizadoPago;
                },
                'filter' => ArrayHelper::map(\app\models\ValorPrendaUnidad::find()->all(),'autorizado','autorizadoPago'),
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
             [
                'attribute' => 'cerrar_pago',
                'value' => function($model){
                    $cerrar = \app\models\ValorPrendaUnidad::findOne($model->id_valor);                    
                    return $cerrar->cerradoPago;
                },
                'filter' => ArrayHelper::map(\app\models\ValorPrendaUnidad::find()->all(),'cerrar_pago','cerradoPago'),
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [                
                'attribute' => 'usuariosistema',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',              
            ],
			
        ],
        //'tableOptions' => ['class' => 'table table-success'],
        'tableOptions'=>['class'=>'table table-bordered table-success'],        
        'summary' => '<div class="panel panel-success "><div class="panel-heading">Registros: <span class="badge">{totalCount}</span></div>',

        'layout' => '{summary}{items}</div><div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">' . $newButton . '</div></div>',
        'pager' => [
            'nextPageLabel' => '<i class="fa fa-forward"></i>',
            'prevPageLabel'  => '<i class="fa fa-backward"></i>',
            'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
            'firstPageLabel'  => '<i class="fa fa-fast-backward"></i>'
        ],
        
    ]); ?>
</div>
