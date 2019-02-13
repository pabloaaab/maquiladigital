<?php

namespace app\controllers;

use Yii;
use app\models\Empleado;
use app\models\EmpleadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FormEmpleado;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use app\models\UsuarioDetalle;
use yii\helpers\Url;
use yii\web\Response;
use yii\helpers\Html;

/**
 * EmpleadoController implements the CRUD actions for Empleado model.
 */
class EmpleadoController extends Controller
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
     * Lists all Empleado models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',31])->all()){
            $searchModel = new EmpleadoSearch();
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
     * Displays a single Empleado model.
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
     * Creates a new Empleado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FormEmpleado();        
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            //$dv = Html::encode($_POST["dv"]);
            if ($model->validate()) {
                $table = new Empleado();
                $table->id_empleado_tipo = $model->id_empleado_tipo;
                $table->identificacion = $model->identificacion;
                $table->dv = $model->dv;
                $table->nombre1 = $model->nombre1;
                $table->nombre2 = $model->nombre2;
                $table->apellido1 = $model->apellido1;
                $table->apellido2 = $model->apellido2;                
                $table->direccion = $model->direccion;
                $table->telefono = $model->telefono;
                $table->celular = $model->celular;
                $table->email = $model->email;
                $table->iddepartamento = $model->iddepartamento;
                $table->idmunicipio = $model->idmunicipio;
                $table->fechaingreso = $model->fechaingreso;
                $table->fecharetiro = $model->fecharetiro;
                $table->contrato = $model->contrato;
                $table->observacion = $model->observacion;
                $table->nombrecorto = $model->nombre1.' '.$model->nombre2.' '.$model->apellido1.' '.$model->apellido2;                
                if ($table->insert()) {
                    $this->redirect(["empleado/index"]);
                } else {
                    $msg = "error";
                }
            } else {
                $model->getErrors();
            }                        
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Empleado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->nombrecorto = $model->nombre1.' '.$model->nombre2.' '.$model->apellido1.' '.$model->apellido2;
            $model->save(false);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Empleado model.
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
     * Finds the Empleado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empleado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empleado::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionMunicipio($id) {
        $rows = Municipio::find()->where(['iddepartamento' => $id])->all();

        echo "<option required>Seleccione...</option>";
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                echo "<option value='$row->idmunicipio' required>$row->municipio</option>";
            }
        }
    }
}
