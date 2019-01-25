<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Ordenproduccion;
use app\models\Ordenproducciondetalle;
?>


<?php $form = ActiveForm::begin([

    'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'options' => []
    ],
]); ?>
<?php $model = Ordenproduccion::findOne($idordenproduccion); ?>
<?php $modeldetalle = Ordenproducciondetalle::findOne($iddetalleorden); ?>
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
                        <th><?= Html::activeLabel($model, 'orden') ?></th>
                        <td><?= Html::encode($model->idordenproduccion) ?></td>
                        <th><?= Html::activeLabel($model, 'tipo') ?></th>
                        <td><?= Html::encode($model->tipo->tipo) ?></td>
                        <th><?= Html::activeLabel($model, 'ordenproduccion') ?></th>
                        <td><?= Html::encode($model->ordenproduccion) ?></td>
                    </tr>
                    <tr>
                        <th><?= Html::activeLabel($model, 'Producto') ?></th>
                        <td><?= Html::encode($modeldetalle->productodetalle->prendatipo->prenda.' / '.$modeldetalle->productodetalle->prendatipo->talla->talla) ?></td>
                        <th><?= Html::activeLabel($model, 'codigo') ?></th>
                        <td><?= Html::encode($modeldetalle->codigoproducto) ?></td>
                        <th><?= Html::activeLabel($model, 'cantidad') ?></th>
                        <td><?= Html::encode($modeldetalle->cantidad) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="table table-responsive">
            <div class="panel panel-success ">
                <div class="panel-heading">
                    Operacion de producción: <?php echo $cont; ?>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td align="center"><b>Id</td>
                            <td align="center"><b>Proceso</td>
                            <td align="center"><b>Duración (Seg)</td>
                            <td align="center"><b>Ponderación (Seg)</td>
                            <td align="center"><b>Total (Seg)</td>
                            <td align="center"><b>Total Proceso (Seg)</td>
                            <td align="center"><b>% proceso </b></td>
                            <td align="center"><b>Cant Operada </td>
                            <td align="center"><b>Estado</td>
                            <td align="center"><input type="checkbox" onclick="marcar(this);"/></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $totalsegundos = 0; ?>
                        <?php foreach ($procesos as $val): ?>
                        <tr>
                            <td align="center"><?= $val->iddetalleproceso ?></td>
                            <td align="center"><?= $val->proceso ?></td>
                            <td align="center"><input type="text" name="duracion[]" value="<?= $val->duracion ?>" size="2" required></td>
                            <td align="center"><input type="text" name="ponderacion[]" value="<?= $val->ponderacion ?>" size="2" required></td>
                            <td align="center"><?= number_format($val->total,1) ?></td>
                            <td align="center"><?= number_format($val->totalproceso,1) ?></td>
                            <td align="center"><?= number_format($val->porcentajeproceso,1) ?></td>
                            <td align="center"><input type="text" name="cantidad_operada[]" value="<?= $val->cantidad_operada ?>" size="2" required></td>
                            <td align="center"><select name="estado[]">
                                    <?php if ($val->estado == 0){echo $estado = "Abierto";}else{echo $estado ="Cerrado";}?>
                                    <option value="<?= $val->estado ?>"><?= $estado ?></option>
                                    <option value="0">Abierto</option>
                                    <option value="1">Cerrado</option>
                                </select></td>
                            <td align="center"><input type="checkbox" name="iddetalleproceso2[]" value="<?= $val->iddetalleproceso ?>"></td>
                            <td align="center"><input type="hidden" name="iddetalleproceso1[]" value="<?= $val->iddetalleproceso ?>"></td>
                        </tr>
                        </tbody>
                        <?php
                        $totalsegundos = $totalsegundos + $val->total;
                        endforeach; ?>                        
                        <tr>
                            <td scope="col" colspan="4" align="right"><b>Total Segundos:</b></td>
                            <th scope="col"><?= number_format($totalsegundos,1) ?></th>
                        </tr>
                        <tr>
                            <td scope="col" colspan="4" align="right"><b>Total Minutos:</b></td>
                            <th scope="col"><?= (number_format($totalsegundos / 60 ,1)) ?></th>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer text-right">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                    <?= Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', ['imprimirficha', 'id' => $model->idordenproduccion], ['class' => 'btn btn-primary']) ?>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-transfer'></span> Abrir/Cerrar", ["class" => "btn btn-success", 'name' => 'ac']) ?>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Editar", ["class" => "btn btn-primary", 'name' => 'editar']) ?>
                    <?= Html::submitButton("<span class='glyphicon glyphicon-trash'></span> Eliminar", ["class" => "btn btn-danger", 'name' => 'eliminar']) ?>
                </div>

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