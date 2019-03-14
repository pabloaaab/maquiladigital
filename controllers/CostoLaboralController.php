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
use app\models\UsuarioDetalle;

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
        $model->no_empleado = 1;
        $model->save();
        return $this->redirect(['costolaboraldetalle', 'id' => 1]);
    }
    
    public function actionEliminar($iddetalle)
    {                                
        $costolaboraldetalle = CostoLaboralDetalle::findOne($iddetalle);
        $costolaboraldetalle->delete();
        $this->redirect(["costo-laboral/costolaboraldetalle",'id' => 1]);
        $this->Totales(1);
    }
    
    public function actionCostolaboraldetalle($id) {                
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',17])->all()){
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
                        $table->no_empleado = $_POST["no_empleado"][$intIndice];
                        $table->save(false);
                        $this->Calculos($table);
                    }
                    $intIndice++;
                }

            }
            $this->totales($id);
            $costolaboral = CostoLaboral::findOne($id);
            $costolaboraldetalle = CostoLaboralDetalle::find()->where(['=', 'id_costo_laboral', $id])->all();
            return $this->render('costolaboraldetalle', [
                        'costolaboral' => $costolaboral,
                        'costolaboraldetalle' => $costolaboraldetalle,
            ]);
        }else{
            return $this->redirect(['site/sinpermiso']);
        }
    }
    
    protected function Calculos($table)
    {
        $parametros = Parametros::findOne(1);
        if ($table->no_empleado == 1) {
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
        }else{
            $table->arl = 0;
            $table->pension = 0;
            $table->caja = 0;
            $table->prestaciones = 0;
            $table->vacaciones = 0;
            $table->ajuste_vac = 0;
            $subtotal = round(($table->salario + $table->auxilio_transporte + $table->tiempo_extra + $table->bonificacion) * $table->nro_empleados);
            $table->subtotal = $subtotal;
            $table->admon = round($subtotal * $parametros->admon / 100);
            $table->total = round($subtotal + $table->admon);
        }        
        $table->update();
    }
    
    protected function Totales($id)
    {
        //$parametros = Parametros::findOne(1);
        //$arl = $table->arl0->arl;
        $detalles = CostoLaboralDetalle::find()->where(['=','id_costo_laboral',$id])->all();
        $operativos = 0;
        $administrativos = 0;
        $no_operativos = 0;
        $no_administrativos = 0;
        $totaloperativo = 0;
        $total_no_operativo = 0;
        $totaladministrativo = 0;
        $total_no_administrativo = 0;        
        $totaladministracion = 0;
        $totalgeneral = 0;
            foreach ($detalles as $val){
                if($val->id_tipo_cargo == 1 && $val->no_empleado == 1){ //1 = operativo, 2 = administrativo, 0 = no es empleado operativo, 1 = si es empleado operativo
                    $totaloperativo = $totaloperativo + $val->total;
                    $operativos = $operativos + $val->nro_empleados;
                }
                if($val->id_tipo_cargo == 1 && $val->no_empleado == 0){ //1 = operativo, 2 = administrativo, 0 = no es empleado operativo, 1 = si es empleado operativo
                    $total_no_operativo = $total_no_operativo + $val->total;
                    $no_operativos = $no_operativos + $val->nro_empleados;
                }
                if($val->id_tipo_cargo == 2 && $val->no_empleado == 1){ //1 = operativo, 2 = administrativo, 0 = no es empleado operativo, 1 = si es empleado operativo
                    $totaladministrativo = $totaladministrativo + $val->total;                    
                    $administrativos = $administrativos + $val->nro_empleados;
                }
                if($val->id_tipo_cargo == 2 && $val->no_empleado == 0){ //1 = operativo, 2 = administrativo, 0 = no es empleado operativo, 1 = si es empleado operativo
                    $total_no_administrativo = $total_no_administrativo + $val->total;                    
                    $no_administrativos = $no_administrativos + $val->nro_empleados;
                }
                $totaladministracion = $totaladministracion + $val->admon;
                $totalgeneral = $totalgeneral + $val->total;
        }        
        $costolaboral = CostoLaboral::findOne($id);
        $costolaboral->empleados_administrativos = $administrativos;
        $costolaboral->empleados_operativos = $operativos;
        $costolaboral->no_empleados_administrativos = $no_administrativos;
        $costolaboral->no_empleados_operativos = $no_operativos;
        $costolaboral->total_operativo = $totaloperativo;
        $costolaboral->total_administrativo = $totaladministrativo;
        $costolaboral->total_operativo_no_empleado = $total_no_operativo;
        $costolaboral->total_administrativo_no_empleado = $total_no_administrativo;
        $costolaboral->total_administracion = $totaladministracion;
        $costolaboral->total_general = $totalgeneral;
        $costolaboral->update();
    }
}
