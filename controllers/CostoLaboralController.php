<?php

namespace app\controllers;

use Yii;
use app\models\CostoLaboral;
use app\models\Parametros;
use app\models\CostoLaboralDetalle;
use app\models\CostoLaboralSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CostoLaboralController implements the CRUD actions for CostoLaboral model.
 */
class CostoLaboralController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionNuevodetalle()
    {
        $parametros = Parametros::findOne(1);
        $model = new CostoLaboralDetalle();
        $model->id_costo_laboral = 1;        
        $model->nro_empleados = 0;
        $model->salario = $parametros->salario_minimo;
        $model->auxilio_transporte = $parametros->auxilio_transporte;
        $model->tiempo_extra = 0;
        $model->bonificacion = 0;
        $model->arl = 0;
        $model->pension = 0;
        $model->caja = 0;
        $model->prestaciones = 0;
        $model->vacaciones = 0;
        $model->ajuste_vac = 0;
        $model->subtotal = 0;
        $model->admon = 0;
        $model->total = 0;
        $model->id_tipo_cargo = 1;
        $model->save();
        return $this->redirect(['costolaboraldetalle', 'id' => 1]);
    }
    
    public function actionCostolaboraldetalle($id) {                
        if (isset($_POST["nro_empleados"])) {
            $intIndice = 0;
            foreach ($_POST["id_costo_laboral_detalle"] as $intCodigo) {
                if ($_POST["nro_empleados"][$intIndice] > 0) {
                    $table = CostoLaboralDetalle::findOne($intCodigo);
                    $table->nro_empleados = $_POST["nro_empleados"][$intIndice];
                    $table->id_tipo_cargo = $_POST["id_tipo_cargo"][$intIndice];
                    $table->id_arl = $_POST["id_arl"][$intIndice];
                    $table->salario = $_POST["salario"][$intIndice];
                    $table->auxilio_transporte = $_POST["auxilio_transporte"][$intIndice];
                    $table->tiempo_extra = $_POST["tiempo_extra"][$intIndice];
                    $table->bonificacion = $_POST["bonificacion"][$intIndice];
                    $table->update();
                    $this->Calculos($table);
                }
                $intIndice++;
            }
            
        }
        $costolaboral = CostoLaboral::findOne($id);
        $costolaboraldetalle = CostoLaboralDetalle::find()->where(['=', 'id_costo_laboral', $id])->all();
        return $this->render('costolaboraldetalle', [
                    'costolaboral' => $costolaboral,
                    'costolaboraldetalle' => $costolaboraldetalle,
        ]);
    }
    
    protected function Calculos($table)
    {
        $parametros = Parametros::findOne(1);
        $arl = $table->arl0->arl;
        $table->arl = round(($table->salario + $table->tiempo_extra) * $arl / 100);
        $table->pension = round(($table->salario + $table->tiempo_extra) * $parametros->pension / 100);
        $table->caja = round(($table->salario + $table->tiempo_extra) * $parametros->caja / 100);
        $table->prestaciones = round(($table->salario + $table->tiempo_extra + $table->auxilio_transporte) * $parametros->prestaciones / 100);
        $table->vacaciones = round(($table->salario) * $parametros->vacaciones / 100);
        $table->ajuste_vac = round(($table->vacaciones) * $parametros->ajuste / 100);
        $subtotal = round(($table->salario + $table->auxilio_transporte + $table->tiempo_extra + $table->bonificacion + $table->arl + $table->pension + $table->caja + $table->prestaciones + $table->vacaciones + $table->ajuste_vac) * $table->nro_empleados);
        $table->subtotal = $subtotal;
        $table->admon = round($subtotal * $parametros->admon / 100);
        $table->total = round($subtotal + $table->admon);
        $table->update();
    }
}
