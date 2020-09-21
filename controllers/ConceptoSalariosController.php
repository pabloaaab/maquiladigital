<?php

namespace app\controllers;

use Yii;
use app\models\ConceptoSalarios;
use app\models\ConceptoSalariosSearch;
use app\models\UsuarioDetalle;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConceptoSalariosController implements the CRUD actions for ConceptoSalarios model.
 */
class ConceptoSalariosController extends Controller
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
     * Lists all ConceptoSalarios models.
     * @return mixed
     */
    public function actionIndex()
    {
       if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',71])->all()){
                $searchModel = new ConceptoSalariosSearch();
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
     * Displays a single ConceptoSalarios model.
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
     * Creates a new ConceptoSalarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ConceptoSalarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['index', 'id' => $model->codigo_salario]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ConceptoSalarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->codigo_salario]);
           
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ConceptoSalarios model.
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
            $this->redirect(["concepto-salarios/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["concepto-salarios/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el registro, tiene registros asociados en otros procesos');
            $this->redirect(["concepto-salarios/index"]);
        }
    }
    /**
     * Finds the ConceptoSalarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ConceptoSalarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
   protected function findModel($id)
    {
        if (($model = ConceptoSalarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
