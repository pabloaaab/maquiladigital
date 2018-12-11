<?php

namespace app\controllers;

use Yii;
use app\models\CostoLaboralHora;
use app\models\CostoLaboralHoraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $detallescostolaboral = \app\models\CostoLaboralDetalle::find()->all();
            $totaldetalle = 0;
            $totalpersonal = 0;
            foreach ($detallescostolaboral as $val){
                $totaldetalle = $totaldetalle + $val->total - $val->bonificacion - $val->tiempo_extra;
                $totalpersonal = $totalpersonal + $val->nro_empleados;
            }
            $subtotal = $totaldetalle / $totalpersonal;
            $model->valor_dia = round($subtotal / $model->dia_mes, 1);
            $model->valor_hora = round($model->valor_dia / $model->dia, 1);
            $model->valor_minuto = round($model->valor_hora / $model->minutos, 1);
            $model->valor_segundo = round($model->valor_minuto / $model->segundos, 1);
            $model->update();
        }

        return $this->render('costolaboralhora', [
            'model' => $model,
        ]);
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
