<?php

namespace app\controllers;

use Yii;
use app\models\SintomasCovid;
use app\models\SintomasCovidSearch;
use app\models\UsuarioDetalle;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SintomasCovidController implements the CRUD actions for SintomasCovid model.
 */
class SintomasCovidController extends Controller
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
     * Lists all SintomasCovid models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',92])->all()){
                $searchModel = new SintomasCovidSearch();
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
     * Displays a single SintomasCovid model.
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
     * Creates a new SintomasCovid model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SintomasCovid();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SintomasCovid model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SintomasCovid model.
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
            $this->redirect(["sintomas-covid/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["sintomas-covid/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
            $this->redirect(["sintomas-covid/index"]);
        }
    }

    /**
     * Finds the SintomasCovid model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SintomasCovid the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SintomasCovid::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
