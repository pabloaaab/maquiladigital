<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso */

$this->title = $model->id_comprobante_egreso;
$this->params['breadcrumbs'][] = ['label' => 'Comprobante Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comprobante-egreso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_comprobante_egreso], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_comprobante_egreso], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_comprobante_egreso',
            'id_municipio',
            'fecha',
            'fecha_comprobante',
            'numero',
            'id_comprobante_egreso_tipo',
            'valor',
            'id_proveedor',
            'observacion:ntext',
            'usuariosistema',
            'estado',
            'autorizado',
            'libre',
            'id_banco',
        ],
    ]) ?>

</div>
