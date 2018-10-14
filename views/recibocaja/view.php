<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */

$this->title = 'Detalle Recibo Caja';
$this->params['breadcrumbs'][] = ['label' => 'Recibos Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idrecibo;
?>
<div class="recibocaja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idrecibo], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idrecibo], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idrecibo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idrecibo',
            'fecharecibo',
            'fechapago',
            'idtiporecibo',
            'idmunicipio',
            'valorpagado',
            'valorletras',
            'idcliente',
            'observacion',
			'usuariosistema',
        ],
    ]) ?>
	
	<?=  $this->render('detalle', ['ReciboCajaDetalle' => $ReciboCajaDetalle]); ?>
</div>
