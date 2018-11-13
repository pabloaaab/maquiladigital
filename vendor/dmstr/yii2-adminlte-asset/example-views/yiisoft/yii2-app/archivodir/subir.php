<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;


$this->title = 'Subir Archivos';
$this->params['breadcrumbs'][] = $this->title;


?>
    <h3 class="alert-danger"><?= $msg ?></h3>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


<?= $form->field($model, 'numero')->input("hidden") ?>
<?= $form->field($model, 'codigo')->input("hidden") ?>
<?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="row">
        <div class="col-lg-4">
            <?= Html::submitButton("Subir Archivo", ["class" => "btn btn-primary"])?>

        </div>
    </div>

<?php ActiveForm::end() ?>