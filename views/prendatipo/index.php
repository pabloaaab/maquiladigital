<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrendatipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prendatipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prendatipo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Prendatipo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idprendatipo',
            'prenda',
            'idtalla',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
