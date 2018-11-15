<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Ordenproduccion;
?>


<?php $form = ActiveForm::begin([

    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
]); ?>
    <?php $model = Ordenproduccion::findOne($id); ?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body">
        <div class="panel panel-success">
            <div class="panel-heading">
                Operaciones
            </div>
            <div class="panel-body">
                <table class="table table-responsive">
                    <tr>
                        <th><?= Html::activeLabel($model, 'idordenproduccion') ?></th>
                        <td><?= Html::encode($model->idordenproduccion) ?></td>
                        <th><?= Html::activeLabel($model, 'tipo') ?></th>
                        <td><?= Html::encode($model->tipo->tipo) ?></td>
                        <th><?= Html::activeLabel($model, 'ordenproduccion') ?></th>
                        <td><?= Html::encode($model->ordenproduccion) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'fechallegada') ?></th>
                        <td><?= Html::encode($model->fechallegada,'Y-m-d') ?></td>
                        <th><?= Html::activeLabel($model, 'fechaprocesada') ?></th>
                        <td><?= Html::encode($model->fechaprocesada) ?></td>
                        <th><?= Html::activeLabel($model, 'fechaentrega') ?></th>
                        <td><?= Html::encode($model->fechaentrega) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="table table-responsive">
            <div class="panel panel-success ">
                <div class="panel-heading">
                   Operacion de producción
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Proceso</th>
                            <th scope="col">Duración</th>
                            <th scope="col">Ponderación</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($procesos as $val): ?>
                        <tr>
                            <td><?= $val->idproceso ?></td>
                            <td><?= $val->proceso ?></td>
                            <td><input type="text" name="duracion[]" value="0" required></td>
                            <td><input type="text" name="ponderacion[]" value="0" required></td>
                            <td><input type="hidden" name="proceso[]" value="<?= $val->proceso ?>"></td>
                            <td><input type="hidden" name="idproceso[]" value="<?= $val->idproceso ?>"></td>
                        </tr>
                        </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="panel-footer text-right">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Guardar", ["class" => "btn btn-success",]) ?>
                </div>

            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>