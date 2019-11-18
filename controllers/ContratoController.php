<?php

namespace app\controllers;

use Yii;
use app\models\Empleado;
use app\models\Contrato;
use app\models\ContratoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FormContratoNuevo;
use app\models\FormContratoNuevoEmpleado;
use app\models\FormFiltroContrato;
use app\models\FormCerrarContrato;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use app\models\UsuarioDetalle;
use yii\helpers\Url;
use yii\web\Response;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\bootstrap\Modal;

/**
 * EmpleadoController implements the CRUD actions for Empleado model.
 */
class ContratoController extends Controller
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
    public function actionIndex() {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',64])->all()){
                $form = new FormFiltroContrato;
                $identificacion = null;
                $activo = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $identificacion = Html::encode($form->identificacion);
                        $activo = Html::encode($form->activo);
                        $table = Contrato::find()
                                ->andFilterWhere(['like', 'identificacion', $identificacion])
                                ->andFilterWhere(['=', 'contrato_activo', $activo])
                                ->orderBy('id_contrato desc');
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 10,
                            'totalCount' => $count->count()
                        ]);
                        $model = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                    } else {
                        $form->getErrors();
                    }
                } else {
                    $table = Contrato::find()
                            ->orderBy('id_contrato desc');
                    $count = clone $table;
                    $pages = new Pagination([
                        'pageSize' => 10,
                        'totalCount' => $count->count(),
                    ]);
                    $model = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                }
                $to = $count->count();
                return $this->render('index', [
                            'model' => $model,
                            'form' => $form,
                            'pagination' => $pages,
                ]);
            }else{
                return $this->redirect(['site/sinpermiso']);
            }
        }else{
            return $this->redirect(['site/login']);
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
    public function actionCreate($id = null)
    {
        if ($id == null){
            $model = new FormContratoNuevo();
        }else{
            $model = new FormContratoNuevoEmpleado();
        }        
        $msg = "";
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            //$dv = Html::encode($_POST["dv"]);
            if ($model->validate()) {                
                if ($id == null){
                   $empleado = Empleado::findOne($model->id_empleado); 
                   $identificacion = $empleado->identificacion;                   
                   $id_empleado = $model->id_empleado;
                }else{
                   $empleado = Empleado::findOne($id);
                   $identificacion = $empleado->identificacion;
                   $id_empleado = $id;
                }
                $table = new Contrato();
                $table->id_tipo_contrato = $model->id_tipo_contrato;
                $table->tiempo_contrato = $model->tiempo_contrato;
                $table->id_cargo = $model->id_cargo;
                $table->identificacion = $identificacion;
                $table->id_empleado = $id_empleado;
                $table->descripcion = $model->descripcion;
                $table->fecha_inicio = $model->fecha_inicio;
                $table->fecha_final = $model->fecha_final;
                $table->tipo_salario = $model->tipo_salario;
                $table->salario = $model->salario;                
                $table->auxilio_transporte = $model->auxilio_transporte;
                $table->horario_trabajo = $model->horario_trabajo;
                $table->comentarios = $model->comentarios;
                $table->funciones_especificas = $model->funciones_especificas;
                $table->id_tipo_cotizante = $model->id_tipo_cotizante;
                $table->id_subtipo_cotizante = $model->id_subtipo_cotizante;                
                $table->tipo_salud = $model->tipo_salud;
                $table->id_entidad_salud = $model->id_entidad_salud;
                $table->tipo_pension = $model->tipo_pension;
                $table->id_entidad_pension = $model->id_entidad_pension;                
                $table->id_caja_compensacion = $model->id_caja_compensacion;
                $table->id_cesantia = $model->id_cesantia;
                $table->id_arl = $model->id_arl;
                $table->ciudad_laboral = $model->ciudad_laboral;
                $table->ciudad_contratado = $model->ciudad_contratado;
                $table->contrato_activo = 1;
                $table->id_centro_trabajo = $model->id_centro_trabajo;
                $contratado = Contrato::find()
                        ->where(['id_empleado' => $id])
                        ->andWhere(['=','contrato_activo',1])
                        ->all();
                if (!$contratado){
                    if ($table->save(false)) {
                        $empleado->fechaingreso = $table->fecha_inicio;
                        $empleado->fecharetiro = $table->fecha_final;
                        $empleado->contrato = $table->contrato_activo;
                        $empleado->save(false);
                        $this->redirect(["contrato/index"]);
                    } else {
                        $msg = "error";
                    }
                }else{
                    $msg = "Ya tiene un contrato activo en el sistema, no se puede crear";
                }                
            } else {
                $model->getErrors();
            }                        
        }
        
        return $this->render('create', [
            'model' => $model,
            'msg' => $msg,
            'id' => $id,
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
        //$matriculaempresa = Matriculaempresa::findOne(1);
        $model = new FormContratoNuevoEmpleado();
        $msg = null;
        $tipomsg = null;
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {            
            if ($model->validate()) {
                $table = Contrato::find()->where(['id_contrato' => $id])->one();
                if ($table) {
                    $table->id_tipo_contrato = $model->id_tipo_contrato;
                    $table->tiempo_contrato = $model->tiempo_contrato;
                    $table->id_cargo = $model->id_cargo;
                    $table->descripcion = $model->descripcion;
                    $table->fecha_inicio = $model->fecha_inicio;
                    $table->fecha_final = $model->fecha_final;
                    $table->tipo_salario = $model->tipo_salario;
                    $table->salario = $model->salario;                
                    $table->auxilio_transporte = $model->auxilio_transporte;
                    $table->horario_trabajo = $model->horario_trabajo;
                    $table->comentarios = $model->comentarios;
                    $table->funciones_especificas = $model->funciones_especificas;
                    $table->id_tipo_cotizante = $model->id_tipo_cotizante;
                    $table->id_subtipo_cotizante = $model->id_subtipo_cotizante;                
                    $table->tipo_salud = $model->tipo_salud;
                    $table->id_entidad_salud = $model->id_entidad_salud;
                    $table->tipo_pension = $model->tipo_pension;
                    $table->id_entidad_pension = $model->id_entidad_pension;                
                    $table->id_caja_compensacion = $model->id_caja_compensacion;
                    $table->id_cesantia = $model->id_cesantia;
                    $table->id_arl = $model->id_arl;
                    $table->ciudad_laboral = $model->ciudad_laboral;
                    $table->ciudad_contratado = $model->ciudad_contratado;
                    $table->id_centro_trabajo = $model->id_centro_trabajo;
                    if ($table->save(false)) {
                        $msg = "El registro ha sido actualizado correctamente";
                        $this->redirect(["contrato/index"]);
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
            $table = Contrato::find()->where(['id_contrato' => $id])->one();            
            if ($table) {                                
                $model->id_contrato = $table->id_contrato;
                $model->id_tipo_contrato = $table->id_tipo_contrato;
                $model->tiempo_contrato = $table->tiempo_contrato;
                $model->id_cargo = $table->id_cargo;
                $model->descripcion = $table->descripcion;
                $model->fecha_inicio = $table->fecha_inicio;
                $model->fecha_final = $table->fecha_final;
                $model->tipo_salario = $table->tipo_salario;
                $model->salario = $table->salario;                
                $model->auxilio_transporte = $table->auxilio_transporte;
                $model->horario_trabajo = $table->horario_trabajo;
                $model->comentarios = $table->comentarios;
                $model->funciones_especificas = $table->funciones_especificas;
                $model->id_tipo_cotizante = $table->id_tipo_cotizante;
                $model->id_subtipo_cotizante = $table->id_subtipo_cotizante;                
                $model->tipo_salud = $table->tipo_salud;
                $model->id_entidad_salud = $table->id_entidad_salud;
                $model->tipo_pension = $table->tipo_pension;
                $model->id_entidad_pension = $table->id_entidad_pension;                
                $model->id_caja_compensacion = $table->id_caja_compensacion;
                $model->id_cesantia = $table->id_cesantia;
                $model->id_arl = $table->id_arl;
                $model->ciudad_laboral = $table->ciudad_laboral;
                $model->ciudad_contratado = $table->ciudad_contratado;
                $model->id_centro_trabajo = $table->id_centro_trabajo;
            } else {
                return $this->redirect(["contrato/index"]);
            }
        } else {
            return $this->redirect(["contrato/index"]);
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
        if (($model = Contrato::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionImprimir($id)
    {
                                
        return $this->render('../formatos/contrato', [
            'model' => $this->findModel($id),
            
        ]);
    }
    
    public function actionCerrarcontrato($id) {                
        $model = new FormCerrarContrato();
        $msg = null;
        $tipomsg = null;
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {            
            if ($model->validate()) {
                $contrato = Contrato::findOne($id);
                if (isset($_POST["actualizar"])) {                                                                                  
                        $contrato->fecha_final = $model->fecha_final;
                        $contrato->id_motivo_terminacion = $model->id_motivo_terminacion;
                        $contrato->contrato_activo = 0;
                        $contrato->save(false);
                        $empleado = Empleado::findOne($contrato->id_empleado);
                        $empleado->contrato = 0;
                        $empleado->fecharetiro = $model->fecha_final;
                        $empleado->save(false);
                        $this->redirect(["contrato/view", 'id' => $id]);                                                     
                }
            }
        }
        if (Yii::$app->request->get("id")) {
            $table = Contrato::find()->where(['id_contrato' => $id])->one();            
            if ($table) {                                
                $model->id_contrato = $table->id_contrato;                
            }
        }
        
        return $this->renderAjax('_cerrarcontrato', ['model' => $model, 'id' => $id]);
    }
    
}
