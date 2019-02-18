<?php

namespace app\controllers;

use Yii;
use app\models\SeguimientoProduccion;
use app\models\SeguimientoProduccionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UsuarioDetalle;
use app\models\Cliente;
use app\models\Ordenproduccion;
use yii\helpers\ArrayHelper;
use Codeception\Lib\HelperModule;

/**
 * SeguimientoProduccionController implements the CRUD actions for SeguimientoProduccion model.
 */
class SeguimientoProduccionController extends Controller
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
     * Lists all SeguimientoProduccion models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',33])->all()){
            $searchModel = new SeguimientoProduccionSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['site/sinpermiso']);
        }
    }

    /**
     * Displays a single SeguimientoProduccion model.
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
     * Creates a new SeguimientoProduccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SeguimientoProduccion();
        $clientes = Cliente::find()->all();
        $ordenesproduccion = Ordenproduccion::find()->Where(['=', 'autorizado', 1])->andWhere(['=', 'facturado', 0])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_seguimiento_produccion]);
        }

        return $this->render('create', [
            'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreclientes"),
            'ordenesproduccion' => ArrayHelper::map($ordenesproduccion, "idordenproduccion", "idordenproduccion"),
        ]);
    }

    /**
     * Updates an existing SeguimientoProduccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $clientes = Cliente::find()->all();
        $ordenesproduccion = Ordenproduccion::find()->Where(['=', 'idordenproduccion', $table->idordenproduccion])->all();
        $ordenesproduccion = ArrayHelper::map($ordenesproduccion, "idordenproduccion", "ordenProduccion");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_seguimiento_produccion]);
        }

        return $this->render('update', [
            'model' => $model,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombrecorto"),
            'ordenesproduccion' => $ordenesproduccion,
        ]);
    }

    /**
     * Deletes an existing SeguimientoProduccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SeguimientoProduccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SeguimientoProduccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeguimientoProduccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
