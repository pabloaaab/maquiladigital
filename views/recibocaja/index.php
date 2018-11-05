<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReciboCajaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recibocajas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibocaja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Recibocaja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idrecibo',
            'fecharecibo',
            'fechapago',
            'idtiporecibo',
            'idmunicipio',
            //'valorpagado',
            //'valorletras:ntext',
            //'idcliente',
            //'observacion:ntext',
            //'usuariosistema',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
