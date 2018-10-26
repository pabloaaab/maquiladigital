<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TallaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tallas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talla-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Talla', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idtalla',
            'talla',
            'sexo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
