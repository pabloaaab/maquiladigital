<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoEquivalenteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documento Equivalentes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-equivalente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Documento Equivalente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'consecutivo',
            'identificacion',
            'nombre_completo',
            'fecha',
            'idmunicipio',
            //'descripcion',
            //'valor',
            //'subtotal',
            //'retencion_fuente',
            //'porcentaje',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
