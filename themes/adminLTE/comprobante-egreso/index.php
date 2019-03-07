<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComprobanteEgresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comprobante Egresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comprobante-egreso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Comprobante Egreso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_comprobante_egreso',
            'id_municipio',
            'fecha',
            'fecha_comprobante',
            'numero',
            //'id_comprobante_egreso_tipo',
            //'valor',
            //'id_proveedor',
            //'observacion:ntext',
            //'usuariosistema',
            //'estado',
            //'autorizado',
            //'libre',
            //'id_banco',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
