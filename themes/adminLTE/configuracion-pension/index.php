<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ConfiguracionPension;
use app\models\ConceptoSalarios;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConfiguracionpensionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configuración pensión';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuracion-pension-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']), ['create'], ['class' => 'btn btn-success']); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id_pension',
                'contentOptions' => ['class' => 'col-lg-1.5'],
            ],
             [
                'attribute' => 'codigo_salario',
                'value' => function($model){
                   $codigoSalario = ConceptoSalarios::findOne($model->codigo_salario);
                   return $codigoSalario->nombre_concepto;
                }
            ],
            [
                'attribute' => 'concepto',
                'contentOptions' => ['class' => 'col-lg-2'],
            ],
            [
                'attribute' => 'porcentaje_empleado',
                'contentOptions' => ['class' => 'col-lg-1.1'],
            ],
            [
                'attribute' => 'porcentaje_empleador',
                'contentOptions' => ['class' => 'col-lg-1.1'],
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
            'prevPageLabel' => '<i class="fa fa-backward"></i>',
            'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
            'firstPageLabel' => '<i class="fa fa-fast-backward"></i>',
        ],
    ]);
    ?>
</div>