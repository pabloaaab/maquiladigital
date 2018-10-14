<?php
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\RecibocajaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista Recibos Cajas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibocaja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?=  $this->render('_search', ['model' => $searchModel]); ?>

    <?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']), ['create'], ['class' => 'btn btn-success']);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [                
                'attribute' => 'idrecibo',
                'contentOptions' => ['class' => 'col-lg-2'],                
            ],
            [                
                'attribute' => 'fecharecibo',
                'contentOptions' => ['class' => 'col-lg-2'],                
            ],
            [               
                'attribute' => 'fechapago',
                'contentOptions' => ['class' => 'col-lg-2 '],                
            ],
            [               
                'attribute' => 'valorpagado',
                'contentOptions' => ['class' => 'col-lg-2 '],                
            ],
			[               
                'attribute' => 'idcliente',
                'contentOptions' => ['class' => 'col-lg-2 '],                
            ],			
            [
                'class' => 'yii\grid\ActionColumn',              
            ],
			
        ],
        'tableOptions' => ['class' => 'table table-success'],
        'summary' => '<div class="panel panel-success "><div class="panel-heading">Registros: {totalCount}</div>',
		
        'layout' => '{summary}{items}<div class="panel panel-footer" ><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">' . $newButton . '</div></div>',
        'pager' => [
            'nextPageLabel' => '<i class="fa fa-forward"></i>',
            'prevPageLabel'  => '<i class="fa fa-backward"></i>',
            'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
            'firstPageLabel'  => '<i class="fa fa-fast-backward"></i>'
        ],
        
    ]); ?>
</div>


