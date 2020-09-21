   <?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoContrato */

$this->title = 'Editar tiempo servicio: ' . $model->id_tiempo;
$this->params['breadcrumbs'][] = ['label' => 'Tiempo de servicio', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tiempo, 'url' => ['view', 'id' => $model->id_tiempo]];
$this->params['breadcrumbs'][] = 'Editar Tiempo de servicio';
?>
<div class="tiempo-servicio-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
