<?php

namespace app\controllers;

use Yii;
use app\models\Fichatiempo;
use app\models\Fichatiempodetalle;
use app\models\FichatiempoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UsuarioDetalle;

/**
 * FichatiempoController implements the CRUD actions for Fichatiempo model.
 */
class FichatiempoController extends Controller
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
     * Lists all Fichatiempo models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',32])->all()){
            $searchModel = new FichatiempoSearch();
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
     * Displays a single Fichatiempo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $fichatiempodetalle = Fichatiempodetalle::find()->where(['=', 'id_ficha_tiempo', $id])->all();
        if (isset($_POST["id_ficha_tiempo_detalle"])) {
            $intIndice = 0;
            foreach ($_POST["id_ficha_tiempo_detalle"] as $intCodigo) {
                
                $table = Fichatiempodetalle::findOne($intCodigo);
                $table->dia = $_POST["dia"][$intIndice];
                $table->desde = $_POST["horadesde"][$intIndice];
                $table->hasta = $_POST["horahasta"][$intIndice];
                $table->total_segundos = $_POST["totalsegundos"][$intIndice];
                $table->realizadas = $_POST["realizadas"][$intIndice];                
                $table->save(false);
                $this->Calculos($table);
                
                $intIndice++;
            }
            $this->totales($id);
            return $this->redirect(['view', 'id' => $id]);
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'fichatiempodetalle' => $fichatiempodetalle
        ]);
    }

    /**
     * Creates a new Fichatiempo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fichatiempo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fichatiempo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fichatiempo model.
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
     * Finds the Fichatiempo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fichatiempo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fichatiempo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionNuevodetalle($id)
    {
        $ficha = Fichatiempo::findOne($id);
        $model = new Fichatiempodetalle();
        $model->id_ficha_tiempo = $ficha->id_ficha_tiempo;                
        $model->dia = date('Y-m-d');
        $model->desde = time();
        $model->hasta = time();
        $model->total_segundos = 0;
        $model->total_operacion = 0;
        $model->realizadas = 0;
        $model->cumplimiento = 0;
        $model->observacion = '';        
        $model->save();
        return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionEliminar($id,$iddetalle)
    {                                
        $detalle = Fichatiempodetalle::findOne($iddetalle);
        $detalle->delete();
        $this->redirect(["view",'id' => $id]);
        $this->Totales($id);
    }
    
    protected function Calculos($table)
    {                
        $totalsegundos = $table->total_segundos;
        if ($totalsegundos == 0){
            $totalsegundos = 1;
        }
        $table->total_operacion = round((60 /$totalsegundos) * 60);
        $table->cumplimiento = round(($table->realizadas * 100) / $table->total_operacion);
        if ($table->cumplimiento < 80){
            $table->observacion = 'No cumple con el perfil de la empresa'; 
        }
        if ($table->cumplimiento > 80 && $table->cumplimiento < 90){
            $table->observacion = 'Cumple con el perfil de la empresa'; 
        }
        if ($table->cumplimiento > 90 && $table->cumplimiento < 100){
            $table->observacion = 'Gana bonificacion de 15000 pesos mensual'; 
        }
        if ($table->cumplimiento > 100){
            $table->observacion = 'Su Salario es 850,000 mil pesos mensuales'; 
        }
        $table->update();
    }
    
    protected function Totales($id)
    {        
        $detalles = Fichatiempodetalle::find()->where(['=','id_ficha_tiempo',$id])->all();
        $sumacumplimiento = 0;
        $cont = 0;
        foreach ($detalles as $val){
            $sumacumplimiento = $sumacumplimiento + $val->cumplimiento;
            $cont++;
        }        
        $table = Fichatiempo::findOne($id);
        $table->cumplimiento = round($sumacumplimiento / $cont);
        if ($table->cumplimiento < 80){
            $table->observacion = 'No cumple con el perfil de la empresa'; 
        }
        if ($table->cumplimiento > 80 && $table->cumplimiento < 90){
            $table->observacion = 'Cumple con el perfil de la empresa'; 
        }
        if ($table->cumplimiento > 90 && $table->cumplimiento < 100){
            $table->observacion = 'Gana bonificacion de 15000 pesos mensual'; 
        }
        if ($table->cumplimiento > 100){
            $table->observacion = 'Su Salario es 850,000 mil pesos mensuales'; 
        }
        $table->update();
    }
}
