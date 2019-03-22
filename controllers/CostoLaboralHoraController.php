<?php

namespace app\controllers;

use Yii;
use app\models\CostoLaboralHora;
use app\models\CostoLaboralHoraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UsuarioDetalle;

/**
 * ArlController implements the CRUD actions for Arl model.
 */
class CostoLaboralHoraController extends Controller
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

    
    /**
     * Updates an existing Arl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCostolaboralhora($id)
    {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',18])->all()){
                $model = $this->findModel($id);
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    $detallescostolaboral = \app\models\CostoLaboralDetalle::find()->all();
                    $totaldetalle = 0;
                    $totalpersonal = 0;
                    $valorarl = 0;
                    $valorpension = 0;
                    $valorprestaciones = 0;
                    $valorvacaciones = 0;
                    $valorajustevac = 0;
                    $subtotal = 0;
                    $admon = 0;
                    $total = 0;
                    foreach ($detallescostolaboral as $val){
                        $arl = \app\models\Arl::findOne($val->id_arl);
                        $parametros = \app\models\Parametros::findOne(1);
                        $valorarl = ($val->salario) * $arl->arl / 100;
                        $valorpension = ($val->salario) * $parametros->pension / 100;
                        $valorcaja = ($val->salario) * $parametros->caja / 100;
                        $valorprestaciones = ($val->salario + $val->auxilio_transporte) * $parametros->prestaciones / 100;
                        $valorvacaciones = $val->salario * $parametros->vacaciones / 100;
                        $valorajustevac = $valorvacaciones * $parametros->ajuste / 100;
                        $subtotal = $val->salario + $val->auxilio_transporte + $valorarl + $valorpension + $valorcaja + $valorprestaciones + $valorvacaciones + $valorajustevac;
                        $admon = ($subtotal * $parametros->admon) / 100;
                        $total = ($subtotal + $admon) * $val->nro_empleados;
                        $totaldetalle = $totaldetalle + $total;

                        $totalpersonal = $totalpersonal + $val->nro_empleados;
                    }
                    $totaldetalle = $totaldetalle / $totalpersonal;
                    $model->valor_dia = round($totaldetalle / $model->dia_mes, 1);
                    $model->valor_hora = round($model->valor_dia / $model->dia, 1);
                    $model->valor_minuto = round($model->valor_hora / $model->minutos, 1);
                    $model->valor_segundo = round($model->valor_minuto / $model->segundos, 1);
                    $model->update();
                }

                return $this->render('costolaboralhora', [
                    'model' => $model,
                ]);
            }else{
                return $this->redirect(['site/sinpermiso']);
            }
        }else{
            return $this->redirect(['site/login']);
        }
    }
    
    
    

    /**
     * Finds the Arl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Arl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \app\models\CostoLaboralHora::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
