<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Empleado;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BancoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista Empleados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleados-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?=  $this->render('_search', ['model' => $searchModel]); ?>

    <?php $newButton = Html::a('Nuevo ' . Html::tag('i', '', ['class' => 'glyphicon glyphicon-plus']), ['create'], ['class' => 'btn btn-success']);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            [                
                'attribute' => 'id_empleado',
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [                
                'attribute' => 'identificacion',
                'contentOptions' => ['class' => 'col-lg-1'],                
            ],
            [                
                'attribute' => 'nombrecorto',
                'contentOptions' => ['class' => 'col-lg-3'],                
            ],
            [               
            'attribute' => 'fechaingreso',
            'value' => function($model){
                $empleado = Empleado::findOne($model->id_empleado);
                return date("Y-m-d", strtotime("$empleado->fechaingreso"));
            },
            'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [               
            'attribute' => 'fecharetiro',
            'value' => function($model){
                $empleado = Empleado::findOne($model->id_empleado);
                return date("Y-m-d", strtotime("$empleado->fecharetiro"));
            },
            'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [
                'attribute' => 'contrato',
                'value' => function($model){
                    $empleado = Empleado::findOne($model->id_empleado);                   
                    return $empleado->contratado;
                },
                'filter' => ArrayHelper::map(Empleado::find()->all(),'contrato','contratado'),
                'contentOptions' => ['class' => 'col-lg-1'],
            ],
            [               
                'attribute' => 'telefono',
                'contentOptions' => ['class' => 'col-lg-1'],                
            ],
            [               
                'attribute' => 'celular',
                'contentOptions' => ['class' => 'col-lg-1'],                
            ],
            [
                'class' => 'yii\grid\ActionColumn',              
            ],
			
        ],
        //'tableOptions' => ['class' => 'table table-success'],
        'tableOptions'=>['class'=>'table table-bordered table-success'],        
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


