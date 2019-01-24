<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Detalle Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['users']];
$this->params['breadcrumbs'][] = $model->codusuario;
?>

<?php
$form = ActiveForm::begin([

            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
                'options' => []
            ],
        ]);
?>

<div class="users-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['users'], ['class' => 'btn btn-primary']) ?>
	<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['editar', 'id' => $model->codusuario], ['class' => 'btn btn-success']) ?>        
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
<div class="table table-responsive">
    <div class="panel panel-success ">
        <div class="panel-heading">
            Permisos
        </div>
        <div class="panel-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Menú Operación</th>
                        <th scope="col">Permiso</th>
                        
                        <th scope="col"><input type="checkbox" onclick="marcar(this);"/></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($usuariodetalles as $val): ?>
                        <tr>                                                
                            <td><?= $val->codusuario_detalle ?></td>
                            <td><?= $val->permiso->menu_operacion ?></td>
                            <td><?= $val->permiso->permiso ?></td>                            
                            <td><input type="checkbox" name="codusuario_detalle[]" value="<?= $val->codusuario_detalle ?>"></td>                                                               
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="panel-footer text-right">                        
            <?= Html::a('Nuevo', ['site/newpermiso','id' => $model->codusuario], ['class' => 'btn btn-primary']) ?>
            <?= Html::submitButton("<span class='glyphicon glyphicon-trash'></span> Eliminar", ["class" => "btn btn-danger", 'name' => 'eliminar']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>