<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Licencia */

$this->title = 'Licencias';
$this->params['breadcrumbs'][] = ['label' => 'Licencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="licencia-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
