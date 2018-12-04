<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\CostoLaboral;
use app\models\CostoLaboralDetalle;
use app\models\TipoCargo;
use app\models\Arl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\db\ActiveQuery;

/* @var $this yii\web\View */
/* @var $model app\models\CostoLaboral */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$this->title = 'Costo Laboral';

$this->params['breadcrumbs'][] = $this->title;
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
<?php
$tiposcargo = ArrayHelper::map(TipoCargo::find()->all(), 'id_tipo_cargo', 'tipo');
$arl = ArrayHelper::map(Arl::find()->all(), 'id_arl', 'arl');
?>
<div class="panel panel-success">
    <div class="panel-heading">
        Costo Laboral
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th><?= Html::activeLabel($costolaboral, 'empleados_administrativos') ?>:</th>
                <td><?= Html::encode($costolaboral->empleados_administrativos) ?></td>
                <th><?= Html::activeLabel($costolaboral, 'empleados_operativos') ?>:</th>
                <td><?= Html::encode($costolaboral->empleados_operativos) ?></td>
                <th><?= Html::activeLabel($costolaboral, 'total_administracion') ?>:</th>
                <td><?= Html::encode('$' . number_format($costolaboral->total_administracion)) ?></td>                
            </tr>
            <tr>                
                <th><?= Html::activeLabel($costolaboral, 'total_administrativo') ?>:</th>
                <td><?= Html::encode('$' . number_format($costolaboral->total_administrativo)) ?></td>
                <th><?= Html::activeLabel($costolaboral, 'total_operativo') ?>:</th>
                <td><?= Html::encode('$' . number_format($costolaboral->total_operativo)) ?></td>
                <th><?= Html::activeLabel($costolaboral, 'total_general') ?>:</th>
                <td><?= Html::encode('$' . number_format($costolaboral->total_general)) ?></td>
            </tr>            
        </table>
    </div>
</div>

<div class="panel panel-success ">
    <div class="panel-heading">
        Detalle Costo Laboral
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Tipo Cargo</th>
                    <th scope="col">% Arl</th>
                    <th scope="col">Salario</th>
                    <th scope="col">Transp</th>
                    <th scope="col">T.Extra</th>
                    <th scope="col">Bonific</th>
                    <th scope="col">Arl</th>
                    <th scope="col">Pensión</th>
                    <th scope="col">Caja</th>
                    <th scope="col">Prest</th>
                    <th scope="col">Vac</th>
                    <th scope="col">A.V</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Admon</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($costolaboraldetalle as $val): ?>
                    <tr>                    
                        <td style="padding-left: 0;padding-right: 1;"><input type="text" name="nro_empleados[]" value="<?= $val->nro_empleados ?>" size="1" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 0;padding-right: 1;"><?= Html::dropDownList('id_tipo_cargo[]', $val->id_tipo_cargo, $tiposcargo, ['class' => 'col-sm-13', 'prompt' => 'Opción', 'required' => true]) ?>
                        <td style="padding-left: 0;padding-right: 1;"><?= Html::dropDownList('id_arl[]', $val->id_arl, $arl, ['class' => 'col-sm-13', 'prompt' => 'Opción', 'required' => true]) ?>    
                        <td style="padding-left: 0;padding-right: 1;"><input type="text" name="salario[]" value="<?= $val->salario ?>" size="5" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 0;padding-right: 1;"><input type="text" name="auxilio_transporte[]" value="<?= $val->auxilio_transporte ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 0;padding-right: 1;"><input type="text" name="tiempo_extra[]" value="<?= $val->tiempo_extra ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 0;padding-right: 1;"><input type="text" name="bonificacion[]" value="<?= $val->bonificacion ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td align="right" style="padding-left: 1;padding-right: 0;"><?= '$' . number_format($val->arl) ?></td>
                        <td align="right" style="padding-left: 1;padding-right: 0;"><?= '$' . number_format($val->pension) ?></td>
                        <td align="right" style="padding-left: 1;padding-right: 0;"><?= '$' . number_format($val->caja) ?></td>
                        <td align="right" style="padding-left: 1;padding-right: 0;"><?= '$' . number_format($val->prestaciones) ?></td>
                        <td align="right" style="padding-left: 1;padding-right: 0;"><?= '$' . number_format($val->vacaciones) ?></td>
                        <td align="right" style="padding-left: 1;padding-right: 0;"><?= '$' . number_format($val->ajuste_vac) ?></td>
                        <td align="right" style="padding-left: 1;padding-right: 0;"><?= '$' . number_format($val->subtotal) ?></td>
                        <td align="right" style="padding-left: 1;padding-right: 0;"><?= '$' . number_format($val->admon) ?></td>
                        <td align="right" style="padding-left: 1;padding-right: 0;"><?= '$' . number_format($val->total) ?></td>
                        <td style="padding-left: 0;padding-right: 0;"><input type="hidden" name="id_costo_laboral_detalle[]" value="<?= $val->id_costo_laboral_detalle ?>"></td>
                        <td><?=
                            Html::a('<span class="glyphicon glyphicon-trash"></span> ', ['eliminar', 'id' => $costolaboral->id_costo_laboral, 'iddetalle' => $val->id_costo_laboral_detalle], [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Esta seguro de eliminar el registro?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="panel-footer text-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['nuevodetalle', 'id' => $costolaboral->id_costo_laboral], ['class' => 'btn btn-success']); ?>
        <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar", ["class" => "btn btn-success",]) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">
    function esInteger(e) {
        var charCode
        charCode = e.keyCode
        status = charCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false
        }
        return true
    }
</script>