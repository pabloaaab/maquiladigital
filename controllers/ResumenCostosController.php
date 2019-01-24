<?php

namespace app\controllers;

use app\models\CostoLaboral;
use app\models\CostoLaboralHora;
use app\models\CostoFijo;
use app\models\CostoFijoDetalle;
use app\models\ResumenCostos;
use app\models\FormResumenCostos;
use Codeception\Lib\HelperModule;
use yii;
use yii\base\Model;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Session;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use app\models\UsuarioDetalle;


class ResumenCostosController extends Controller {

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
    public function actionResumencostos($id)
    {
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',22])->all()){
            $model = $this->findModel($id);
            $costolaboralhora = CostoLaboralHora::findOne($id);
            $costofijo = CostoFijo::findOne($id);
            $costolaboral = CostoLaboral::findOne($id);  

            $model->costo_laboral = $costolaboral->total_general;
            $model->costo_fijo = $costofijo->valor;
            $model->total_costo = $model->costo_laboral + $model->costo_fijo;
            $model->costo_diario = round($model->total_costo / $costolaboralhora->dia_mes,0);
            $model->update(); 
            return $this->render('resumencostos', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect(['site/sinpermiso']);
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
        if (($model = ResumenCostos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
        
}
