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

<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Registros: <?= $pagination->totalCount ?>
    </div>
        <table class="table table-hover">
            <thead>
            <tr>                
                <th scope="col">Id</th>
                <th scope="col">Código</th>
                <th scope="col">Número</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Tipo</th>
                <th scope="col">Tamaño</th>
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr>                
                <td><?= $val->idarchivodir ?></td>
                <td><?= $val->iddocumentodir ?></td>
                <td><?= $val->numero ?></td>
                <td><?= $val->nombre ?></td>
                <td><?= $val->descripcion ?></td>
                <td><?= $val->tipo ?></td>
                <td><?= $val->tamaño ?></td>
                <td>
                    <a href="<?= Url::toRoute(["archivodir/descargar", "id" => $val->idarchivodir, 'numero' => $numero, 'codigo' => $codigo]) ?>" ><span class="glyphicon glyphicon-download"></span></a>                                        
                    <a href="#" data-toggle="modal" data-target="#id<?= $val->idarchivodir ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <!-- Editar modal detalle -->
                                <div class="modal fade" role="dialog" aria-hidden="true" id="id<?= $val->idarchivodir ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Editar Archivo <?= $val->idarchivodir ?></h4>
                                            </div>
                                            <?= Html::beginForm(Url::toRoute("archivodir/editar"), "POST") ?>
                                            <div class="modal-body">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        <h4>Información Archivo</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <label id="descripcion" for="descripcion" class="col-sm-3 control-label">Descripción</label>
                                                            <div class="col-sm-5 form-group">
                                                                <?= Html::textInput('descripcion', $val->descripcion, ['id' => 'descripcion', 'aria-required' => true, 'aria-invalid' => 'false', 'maxlength' => 120, 'class' => 'form-control', 'style' => 'width:100%', 'required' => true]) ?>                        
                                                            </div>   
                                                        </div>                                                        
                                                        <input type="hidden" name="idarchivodir" value="<?= $val->idarchivodir ?>">
                                                        <input type="hidden" name="numero" value="<?= $numero ?>">
                                                        <input type="hidden" name="codigo" value="<?= $codigo ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Guardar</button>
                                            </div>
                                            <?= Html::endForm() ?>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                    <a href="<?= Url::toRoute(["archivodir/borrar", "id" => $val->idarchivodir, 'numero' => $numero, 'codigo' => $codigo]) ?>" ><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <div class="panel-footer text-right" >
            <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['notacredito/view', 'id' => $codigo], ['class' => 'btn btn-primary']); ?>
            <?= Html::a('<span class="glyphicon glyphicon-upload"></span> Subir Archivo', ['archivodir/subir','numero' => $numero, 'codigo' => $codigo], ['class' => 'btn btn-success']); ?>            
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>







