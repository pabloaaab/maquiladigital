<?php

namespace app\controllers;

use Yii;
use app\models\SeguimientoProduccion;
use app\models\SeguimientoProduccionDetalle;
use app\models\SeguimientoProduccionDetalle2;
use app\models\SeguimientoProduccionSearch;
use app\models\FormGenerarSeguimientoProduccion;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UsuarioDetalle;
use app\models\Cliente;
use app\models\Ordenproduccion;
use yii\helpers\ArrayHelper;
use Codeception\Lib\HelperModule;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
        $model = $this->findModel($id);
        $form = new FormGenerarSeguimientoProduccion();
        $operarias = null;
        $horastrabajar = null;
        $minutos = null;   
        $reales = null;   
        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
                $operarias = Html::encode($form->operarias);
                $horastrabajar = Html::encode($form->horastrabajar);
                $minutos = Html::encode($form->minutos);
                $reales = Html::encode($form->reales);
                if ($minutos){
                    if($operarias > 0 && $horastrabajar > 0 && $minutos > 0 && $reales > 0){
                        $ordenproduccion = Ordenproduccion::findOne($model->idordenproduccion);
                        if ($ordenproduccion->cantidad > 0){
                            if($ordenproduccion->segundosficha > 0){
                                $seguimientodetalletemporal = SeguimientoProduccionDetalle2::findOne(1);
                                $seguimientodetalletemporal->minutos = $minutos;
                                //$calculohora = date('H:i:s') - $model->hora_inicio;
                                $horaInicio = new \DateTime($model->hora_inicio);
                                $horaTermino = new \DateTime(date('H:i:s'));                                
                                $interval = $horaInicio->diff($horaTermino);
                                $interval2 = $interval->format('%h');
                                $interval3 = $interval->format('%s');
                                $interval4 = $interval2.'.'.$interval3;
                                //$interval->format('%H horas %i minutos %s seconds');date.timezone = America/Lima
                                $seguimientodetalletemporal->fecha_inicio = $model->fecha_inicio_produccion;
                                $seguimientodetalletemporal->hora_inicio = $model->hora_inicio;
                                $seguimientodetalletemporal->hora_consulta = date('H:i:s');
                                $seguimientodetalletemporal->cantidad = round(60 / $seguimientodetalletemporal->minutos,2);
                                $seguimientodetalletemporal->horas_a_trabajar = $horastrabajar;
                                $seguimientodetalletemporal->cantidad_por_hora = round($seguimientodetalletemporal->cantidad * $seguimientodetalletemporal->horas_a_trabajar,2);
                                $seguimientodetalletemporal->operarias = $operarias;
                                $seguimientodetalletemporal->total = round($operarias * $seguimientodetalletemporal->cantidad_por_hora,2);
                                $seguimientodetalletemporal->operacion_por_hora = round($seguimientodetalletemporal->total / $seguimientodetalletemporal->horas_a_trabajar,2);
                                $seguimientodetalletemporal->prendas_reales = $reales;
                                $seguimientodetalletemporal->prendas_sistema = round($seguimientodetalletemporal->operacion_por_hora * ($interval4),1);
                                $seguimientodetalletemporal->porcentaje_produccion = round((100 * $reales) / $seguimientodetalletemporal->prendas_sistema,2);
                                $seguimientodetalletemporal->save(false);
                                $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',1])->all();
                                $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
                                /*$seguimiento = SeguimientoProduccion::findOne($id);
                                $seguimiento->minutos = $minutos;
                                $seguimiento->operarias = $operarias;
                                $seguimiento->horas_a_trabajar = $horastrabajar;
                                $seguimiento->prendas_reales = $reales;
                                $seguimiento->save(false);*/
                            }else{
                                Yii::$app->getSession()->setFlash('error', 'La orden de produccion no tiene procesos generados en la ficha de operaciones');                                                        
                                $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                                } 
                        }else{
                            Yii::$app->getSession()->setFlash('error', 'La cantidad de la orden de produccion debe ser mayor a cero');
                            $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                            }    
                    }else{
                        Yii::$app->getSession()->setFlash('error', 'La cantidad de operarias y/o horas a trabajar y/o minutos y/o prendas reales, no pueden ser 0 (cero)');                                                
                        $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
                        }                    
                }else{
                    Yii::$app->getSession()->setFlash('error', 'No se tiene el valor de la orden de producción para generar el informe');
                    $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();                    
                    } 
            }else {
                $form->getErrors();
                }
            if (isset($_POST["idseguimiento"])) {
                $smtodetalletemporal = SeguimientoProduccionDetalle2::findOne($_POST["id"]);        
                $seguimientodetalle = new SeguimientoProduccionDetalle();
                $seguimientodetalle->id_seguimiento_produccion = $_POST["idseguimiento"];
                $seguimientodetalle->fecha_inicio = $smtodetalletemporal->fecha_inicio;
                $seguimientodetalle->minutos = $smtodetalletemporal->minutos;
                $seguimientodetalle->hora_inicio = $smtodetalletemporal->hora_inicio;
                $seguimientodetalle->hora_consulta = $smtodetalletemporal->hora_consulta;
                $seguimientodetalle->cantidad = $smtodetalletemporal->cantidad;
                $seguimientodetalle->horas_a_trabajar = $smtodetalletemporal->horas_a_trabajar;
                $seguimientodetalle->cantidad_por_hora = $smtodetalletemporal->cantidad_por_hora;
                $seguimientodetalle->operarias = $smtodetalletemporal->operarias;
                $seguimientodetalle->total = $smtodetalletemporal->total;
                $seguimientodetalle->operacion_por_hora = $smtodetalletemporal->operacion_por_hora;
                $seguimientodetalle->prendas_reales = $smtodetalletemporal->prendas_reales;
                $seguimientodetalle->prendas_sistema = $smtodetalletemporal->prendas_sistema;
                $seguimientodetalle->porcentaje_produccion = $smtodetalletemporal->porcentaje_produccion;
                $seguimientodetalle->insert();
            }    
        }else{
            $table = SeguimientoProduccionDetalle2::find()->where(['=','id_seguimiento_produccion_detalle',0])->all();
            $table2 = SeguimientoProduccionDetalle::find()->where(['=','id_seguimiento_produccion',$id])->all();
        }
        return $this->render('view', [
            'model' => $model,
            'form' => $form,
            'seguimientodetalletemporal' => $table,
            'seguimientodetalle' => $table2,
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
        $ordenesproduccion = Ordenproduccion::find()->Where(['=', 'idordenproduccion', $model->idordenproduccion])->all();
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
    
    public function actionGuardar($id,$idseguimiento)
    {        
        $seguimientodetalletemporal = SeguimientoProduccionDetalle2::findOne($id);        
        $seguimientodetalle = new SeguimientoProduccionDetalle();
        $seguimientodetalle->id_seguimiento_produccion = $idseguimiento;
        $seguimientodetalle->fecha_inicio = $seguimientodetalletemporal->fecha_inicio;
        $seguimientodetalle->minutos = $seguimientodetalletemporal->minutos;
        $seguimientodetalle->hora_inicio = $seguimientodetalletemporal->hora_inicio;
        $seguimientodetalle->hora_consulta = $seguimientodetalletemporal->hora_consulta;
        $seguimientodetalle->cantidad = $seguimientodetalletemporal->cantidad;
        $seguimientodetalle->horas_a_trabajar = $seguimientodetalletemporal->horas_a_trabajar;
        $seguimientodetalle->cantidad_por_hora = $seguimientodetalletemporal->cantidad_por_hora;
        $seguimientodetalle->operarias = $seguimientodetalletemporal->operarias;
        $seguimientodetalle->total = $seguimientodetalletemporal->total;
        $seguimientodetalle->operacion_por_hora = $seguimientodetalletemporal->operacion_por_hora;
        $seguimientodetalle->prendas_reales = $seguimientodetalletemporal->prendas_reales;
        $seguimientodetalle->prendas_sistema = $seguimientodetalletemporal->prendas_sistema;
        $seguimientodetalle->porcentaje_produccion = $seguimientodetalletemporal->porcentaje_produccion;
        $seguimientodetalle->insert();
        return $this->redirect(['view', 'id' => $idseguimiento]);
    }
    
    public function actionEliminardetalle($id,$idseguimiento)
    {
        $seguimientodetalle = SeguimientoProduccionDetalle::findOne($id);
        $seguimientodetalle->delete();

        return $this->redirect(['view', 'id' => $idseguimiento]);
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
