<?php

namespace app\controllers;

use Yii;
use app\models\Compra;
use app\models\CompraTipo;
use app\models\Proveedor;
use app\models\CompraSearch;
use app\models\UsuarioDetalle;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveQuery;
use yii\base\Model;
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
use Codeception\Lib\HelperModule;

/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller
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
     * Lists all Compra models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',35])->all()){
            $searchModel = new CompraSearch();
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
     * Displays a single Compra model.
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
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Compra();
        $proveedores = Proveedor::find()->all();
        $tipos = CompraTipo::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->usuariosistema = Yii::$app->user->identity->username;            
            $model->update();
            return $this->redirect(['view', 'id' => $model->id_compra]);
        }

        return $this->render('create', [
            'model' => $model,
            'proveedores' => ArrayHelper::map($proveedores, "idproveedor", "nombreProveedores"),
            'tipos' => ArrayHelper::map($tipos, "id_compra_tipo", "tipo"),
        ]);
    }

    /**
     * Updates an existing Compra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $proveedores = Proveedor::find()->all();
        $tipos = CompraTipo::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_compra]);
        }

        return $this->render('update', [
            'model' => $model,
            'proveedores' => ArrayHelper::map($proveedores, "idproveedor", "nombreProveedores"),
            'tipos' => ArrayHelper::map($tipos, "id_compra_tipo", "tipo"),
        ]);
    }

    /**
     * Deletes an existing Compra model.
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
     * Finds the Compra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionAutorizado($id) {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->autorizado == 0) {                        
            $model->autorizado = 1;            
            $model->update();
            $this->redirect(["compra/view", 'id' => $id]);            
        } else {
            $model->autorizado = 0;
            $model->update();
            $this->redirect(["compra/view", 'id' => $id]);
        }
    }
}
