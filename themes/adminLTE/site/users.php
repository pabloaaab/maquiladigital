<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;


$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;


?>
<script language="JavaScript">
    function mostrarfiltro() {
        divC = document.getElementById("filtrousuario");
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>

<!--<h1>Lista Clientes</h1>-->
<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("site/users"),
    "enableClientValidation" => false,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>
	
    <div class="panel-body" id="filtrousuario" style="display:none">
        <div class="row" >
            <?= $formulario->field($form, "nombreusuario")->input("search") ?>
            <?= $formulario->field($form, "documentousuario")->input("search") ?>
            <?= $formulario->field($form, "nombrecompleto")->input("search") ?>
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute("site/users") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>

<?php $formulario->end() ?>

<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Registros: <?= $pagination->totalCount ?>
    </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>                
                <th scope="col">Código</th>
                <th scope="col">Usuario</th>
                <th scope="col">Nombre Completo</th>
                <th scope="col">Identificación</th>
                <th scope="col">Email</th>
                <th scope="col">Perfil</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr>                
                <td><?= $val->codusuario ?></td>
                <td><?= $val->username ?></td>
                <td><?= $val->nombrecompleto ?></td>
                <td><?= $val->documentousuario ?></td>
                <td><?= $val->emailusuario ?></td>
                <td><?= $val->perfil ?></td>
                <td><?= $val->estado ?></td>
                <td>				
                <a href="<?= Url::toRoute(["site/view", "id" => $val->codusuario]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                <a href="<?= Url::toRoute(["site/editar", "id" => $val->codusuario])?>" ><span class="glyphicon glyphicon-pencil"></span></a>		
                <?= Html::a('Cambio Clave', ["site/changepassword", "id" => $val->codusuario], ['class' => 'btn btn-default']) ?>
                </td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <div class="panel-footer text-right" >
            <a align="right" href="<?= Url::toRoute("site/register") ?>" class="btn btn-success"><span class='glyphicon glyphicon-plus'></span> Nuevo</a>
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>







