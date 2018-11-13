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

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detalle Procesos</h4>
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
                            <th scope="col">Duración (Seg)</th>
                            <th scope="col">Ponderación (Seg)</th>
                            <th scope="col">Total (Seg)</th>
                            <th scope="col">Estado</th>
                            <th scope="col"><input type="checkbox" name="todos[]" value=""></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $totalsegundos = 0; ?>
                        <?php foreach ($procesos as $val): ?>
                        <tr>
                            <td><?= $val->iddetalleproceso ?></td>
                            <td><?= $val->proceso ?></td>
                            <td><input type="text" name="duracion[]" value="<?= $val->duracion ?>" required></td>
                            <td><input type="text" name="ponderacion[]" value="<?= $val->ponderacion ?>" required></td>
                            <td><?= $val->total ?></td>

                            <td><select name="estado[]">
                                    <?php if ($val->estado == 0){echo $estado = "Abierto";}else{echo $estado ="Cerrado";}?>
                                    <option value="<?= $val->estado ?>"><?= $estado ?></option>
                                    <option value="0">Abierto</option>
                                    <option value="1">Cerrado</option>
                                </select></td>
                            <td><input type="checkbox" name="iddetalleproceso2[]" value="<?= $val->iddetalleproceso ?>"></td>
                            <td><input type="hidden" name="iddetalleproceso1[]" value="<?= $val->iddetalleproceso ?>"></td>
                        </tr>
                        </tbody>
                        <?php
                        $totalsegundos = $totalsegundos + $val->total;
                        endforeach; ?>
                        <tr>
                            <td scope="col" colspan="4" align="right"><b>Total Duración:</b></td>
                            <th scope="col"><?= $totalsegundos.'(Seg) - '. (number_format($totalsegundos / 60,2)) .'(Min)' ?></th>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer text-right">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-transfer'></span> Abrir/Cerrar", ["class" => "btn btn-success", 'name' => 'ac']) ?>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Editar", ["class" => "btn btn-primary", 'name' => 'editar']) ?>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-trash'></span> Eliminar", ["class" => "btn btn-danger", 'name' => 'eliminar']) ?>
                </div>

            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>