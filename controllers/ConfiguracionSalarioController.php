<?php

namespace app\controllers;

use Yii;
use app\models\ConfiguracionSalario;
use app\models\ConfiguracionSalarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UsuarioDetalle;
use app\models\FormConfiguracionSalario;

/**
 * ConfiguracionSalarioController implements the CRUD actions for ConfiguracionSalario model.
 */
class ConfiguracionSalarioController extends Controller
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
     * Lists all ConfiguracionSalario models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',90])->all()){
                $searchModel = new ConfiguracionSalarioSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
        }else{
                return $this->redirect(['site/sinpermiso']);
            }
        }else{
            return $this->redirect(['site/login']);
        }         
    }

    /**
     * Displays a single ConfiguracionSalario model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ConfiguracionSalario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FormConfiguracionSalario();
        $confi = ConfiguracionSalario::find()->where(['=','estado', 1])->one();
      
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {           
             if ($model->validate()) {
                 $table = new ConfiguracionSalario();
                 $table->salario_minimo_actual = $model->salario_minimo_actual;
                 $table->auxilio_transporte_actual = $model->auxilio_transporte_actual;
                 $table->anio = $model->anio;
                 $table->estado = $model->estado;
                 $table->salario_minimo_anterior = $confi->salario_minimo_actual;
                 $table->auxilio_transporte_anterior = $confi->auxilio_transporte_actual;
                 $table->salario_incapacidad = round($model->salario_minimo_actual * $confi->porcentaje_incremento);
                 $table->porcentaje_incremento = $confi->porcentaje_incremento;
                 $table->usuario = Yii::$app->user->identity->username; 
                 $table->insert(false);
                 $confi->estado = 0;
                 $confi->save(false);
                 $this->redirect(["configuracion-salario/index"]);
             } else {
              $model->getErrors();    
             }
        }
        return $this->render('create', [
            'model' => $model,
           
        ]);
    }

    /**
     * Updates an existing ConfiguracionSalario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_salario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ConfiguracionSalario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
            $this->redirect(["configuracion-salario/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["configuracion-salario/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
            $this->redirect(["grupo-pago/index"]);
        }
    }

    /**
     * Finds the ConfiguracionSalario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ConfiguracionSalario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ConfiguracionSalario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
