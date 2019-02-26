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
    public function actionUpdate($id) {
        //$matriculaempresa = Matriculaempresa::findOne(901189320);
        $model = new FormEmpleado();
        $msg = null;
        $tipomsg = null;
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {            
            if ($model->validate()) {
                $table = Empleado::find()->where(['id_empleado' => $id])->one();
                if ($table) {
                    $table->id_empleado_tipo = $model->id_empleado_tipo;
                    $table->identificacion = $model->identificacion;
                    $table->dv = $model->dv;
                    $table->nombre1 = $model->nombre1;
                    $table->nombre2 = $model->nombre2;
                    $table->apellido1 = $model->apellido1;
                    $table->apellido2 = $model->apellido2;
                    $table->nombrecorto = $table->nombre1.' '.$table->nombre2.' '.$table->apellido1.' '.$table->apellido2;
                    $table->direccion = $model->direccion;
                    $table->telefono = $model->telefono;
                    $table->celular = $model->celular;
                    $table->email = $model->email;
                    $table->iddepartamento = $model->iddepartamento;
                    $table->idmunicipio = $model->idmunicipio;
                    $table->contrato = $model->contrato;
                    $table->observacion = $model->observacion;
                    $table->fechaingreso = $model->fechaingreso;
                    $table->fecharetiro = $model->fecharetiro;                                                            
                    if ($table->update()) {
                        $msg = "El registro ha sido actualizado correctamente";
                        $this->redirect(["empleado/index"]);
                    } else {
                        $msg = "El registro no sufrio ningun cambio";
                        $tipomsg = "danger";
                    }
                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                    $tipomsg = "danger";
                }
            } else {
                $model->getErrors();
            }
        }


        if (Yii::$app->request->get("id")) {
            $table = Empleado::find()->where(['id_empleado' => $id])->one();
            //$municipio = Municipio::find()->Where(['=', 'iddepartamento', $table->iddepartamento])->all();
            //$municipio = ArrayHelper::map($municipio, "idmunicipio", "municipio");
            if ($table) {
                $model->id_empleado = $table->id_empleado;
                $model->id_empleado_tipo = $table->id_empleado_tipo;
                $model->identificacion = $table->identificacion;
                $model->dv = $table->dv;
                $model->nombre1 = $table->nombre1;
                $model->nombre2 = $table->nombre2;
                $model->apellido1 = $table->apellido1;
                $model->apellido2 = $table->apellido2;
                $model->direccion = $table->direccion;
                $model->telefono = $table->telefono;
                $model->celular = $table->celular;
                $model->email = $table->email;
                $model->iddepartamento = $table->iddepartamento;
                $model->idmunicipio = $table->idmunicipio;
                $model->contrato = $table->contrato;                                                
                $model->observacion = $table->observacion;
                $model->fechaingreso = $table->fechaingreso;
                $model->fecharetiro = $table->fecharetiro;
            } else {
                return $this->redirect(["empleado/index"]);
            }
        } else {
            return $this->redirect(["empleado/index"]);
        }
        return $this->render("update", ["model" => $model, "msg" => $msg, "tipomsg" => $tipomsg]);
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
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
            $this->redirect(["empleado/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["empleado/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el empleado, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar el empleado, tiene registros asociados en otros procesos');
            $this->redirect(["empleado/index"]);
        }
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
