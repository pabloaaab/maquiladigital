<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;


$this->title = 'Lista de Archivos';
$this->params['breadcrumbs'][] = $this->title;


?>


<h1>Lista Archivos</h1>

<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Registros: <?= $pagination->totalCount ?>
    </div>
        <table class="table table-hover">
            <thead>
            <tr>                
                <th scope="col">Id</th>
                <th scope="col">numero</th>
                <th scope="col">nombre</th>
                <th scope="col">tipo</th>
                <th scope="col">tamaño</th>
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr>                
                <td><?= $val->iddocumentodir ?></td>
                <td><?= $val->numero ?></td>
                <td><?= $val->nombre ?></td>
                <td><?= $val->tipo ?></td>
                <td><?= $val->tamaño ?></td>
                <td>				

                </td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <div class="panel-footer text-right" >
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Archivos', ['archivodir/subir','numero' => $numero, 'codigo' => $codigo], ['class' => 'btn btn-success']); ?>
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>







