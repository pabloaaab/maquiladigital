<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Detalle Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['users']];
$this->params['breadcrumbs'][] = $model->codusuario;
?>
<div class="users-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['users'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->codusuario], ['class' => 'btn btn-success']) ?>        
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Usuario
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'codusuario') ?>:</th>
                    <td><?= Html::encode($model->codusuario) ?></td>
                    <th><?= Html::activeLabel($model, 'username') ?>:</th>
                    <td><?= Html::encode($model->username) ?></td>
                    <th><?= Html::activeLabel($model, 'fechaproceso') ?>:</th>
                    <td><?= Html::encode($model->fechaproceso) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'documentousuario') ?>:</th>
                    <td><?= Html::encode($model->documentousuario) ?></td>
                    <th><?= Html::activeLabel($model, 'nombrecompleto') ?>:</th>
                    <td><?= Html::encode($model->nombrecompleto) ?></td>
                    <th><?= Html::activeLabel($model, 'activo') ?>:</th>
                    <td><?= Html::encode($model->estado) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'role') ?>:</th>
                    <td><?= Html::encode($model->perfil) ?></td>
                    <th><?= Html::activeLabel($model, 'emailusuario') ?>:</th>
                    <td><?= Html::encode($model->emailusuario) ?></td>
                    <th></th>
                    <td></td>
                </tr>                                
            </table>
        </div>
    </div>
</div>
