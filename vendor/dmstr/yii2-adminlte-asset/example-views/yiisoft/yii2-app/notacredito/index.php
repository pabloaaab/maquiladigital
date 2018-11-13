<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Conceptonota;
use app\models\Cliente;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotacreditoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notas Créditos';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<h1><?= Html::encode($this->title) ?></h1>-->
<?=  $this->render('_search', ['model' => $searchModel]); ?>

<?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']), ['create'], ['class' => 'btn btn-success']);?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'idnotacredito',
            'contentOptions' => ['class' => 'col-lg-1'],
        ],

        [
            'attribute' => 'idcliente',
            'value' => function($model){
                $clientes = Cliente::findOne($model->idcliente);
                return "{$clientes->nombrecorto} - {$clientes->cedulanit}";
            },
            'filter' => ArrayHelper::map(Cliente::find()->all(),'idcliente','nombreClientes'),
            'contentOptions' => ['class' => 'col-lg-4'],
        ],
        [
            'attribute' => 'idconceptonota',
            'value' => function($model){
                $conceptos = Conceptonota::findOne($model->idconceptonota);
                return "{$conceptos->concepto}";
            },
            'filter' => ArrayHelper::map(Conceptonota::find()->all(),'idconceptonota','concepto'),
            'contentOptions' => ['class' => 'col-lg-3'],
        ],
        [
            'attribute' => 'fecha',
            'contentOptions' => ['class' => 'col-lg-2'],
        ],
        [
            'attribute' => 'fechapago',
            'contentOptions' => ['class' => 'col-lg-1'],
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
