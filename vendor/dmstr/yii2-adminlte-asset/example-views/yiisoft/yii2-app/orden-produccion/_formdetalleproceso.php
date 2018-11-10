<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>


<?php $form = ActiveForm::begin([

    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
]); ?>
<?php
if ($mensaje != ""){
    ?> <div class="alert alert-danger"><?= $mensaje ?></div> <?php
}
?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nuevo Detalle Procesos</h4>
    </div>
    <div class="modal-body">
        <div class="table table-responsive">
            <div class="panel panel-success ">
                <div class="panel-heading">
                   Procesos
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Proceso</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($procesos as $val): ?>
                        <tr>
                            <td><?= $val->idproceso ?></td>
                            <td><?= $val->proceso ?></td>
                            <td><input type="checkbox" name="idproceso[]" value="<?= $val->idproceso ?>"></td>
                        </tr>
                        </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="panel-footer text-right">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Editar", ["class" => "btn btn-success", 'name' => 'editar']) ?>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Eliminar", ["class" => "btn btn-success", 'name' => 'eliminar']) ?>
                </div>

            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>