<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\TipoRecibo;
use app\models\Recibocaja;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReciboCajaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recibocajas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibocaja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?=  $this->render('_search', ['model' => $searchModel]); ?>

    <?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']), ['create'], ['class' => 'btn btn-success']);?>
    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'idrecibo',
                'contentOptions' => ['class' => 'col-lg-1 '],
            ],
            [
                'attribute' => 'fecharecibo',
                'contentOptions' => ['class' => 'col-lg-2 '],
            ],
            [
                'attribute' => 'fechapago',
                'contentOptions' => ['class' => 'col-lg-1 '],
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
                'attribute' => 'idtiporecibo',
                'value' => function($model){
                    $tiporecibos = TipoRecibo::findOne($model->idtiporecibo);
                    return $tiporecibos->concepto;
                },
                'filter' => ArrayHelper::map(TipoRecibo::find()->all(),'idtiporecibo','concepto'),
                'contentOptions' => ['class' => 'col-lg-2.2'],
            ],
            [
                'attribute' => 'valorpagado',
                'value' => function($model) {
                    $recibocaja = Recibocaja::findOne($model->idrecibo);
                    $valor = "$ ".number_format($recibocaja->valorpagado);
                    return "{$valor}";
                },
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
    <?php Pjax::end(); ?>
</div>

