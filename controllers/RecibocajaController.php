<?php

namespace app\controllers;

use Yii;
use app\models\Recibocaja;
use app\models\Recibocajadetalle;
use app\models\RecibocajaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

/**
 * RecibocajaController implements the CRUD actions for Recibocaja model.
 */
class RecibocajaController extends Controller
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
     * Lists all Recibocaja models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecibocajaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Recibocaja model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $ReciboCajaDetalle = Recibocajadetalle::find()->Where(['=', 'idrecibo', $id])->all();
		return $this->render('view', [
            'model' => $this->findModel($id),
			'ReciboCajaDetalle' => $ReciboCajaDetalle,
					
        ]);
    }

    /**
     * Creates a new Recibocaja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Recibocaja();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrecibo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Recibocaja model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrecibo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Recibocaja model.
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
     * Finds the Recibocaja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recibocaja the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	 
	public function actionNuevodetalle()
        {
        if(Yii::$app->request->post())
            {
                $idrecibo = Html::encode($_POST["idrecibo"]);
				$nrofactura = Html::encode($_POST["nrofactura"]);
				$vlrabono = Html::encode($_POST["vlrabono"]);
				$vlrsaldo = Html::encode($_POST["vlrsaldo"]);
				$retefuente = Html::encode($_POST["retefuente"]);
				$reteiva = Html::encode($_POST["reteiva"]);
				$reteica = Html::encode($_POST["reteica"]);
				$observacion = Html::encode($_POST["observacion"]);
                if((int) $idrecibo)
                {                    
                    $table = new ReciboCajaDetalle();
                    $table->nrofactura = $nrofactura;
                    $table->idrecibo = $idrecibo;
                    $table->vlrabono = $vlrabono;
                    $table->vlrsaldo = $vlrsaldo;
                    $table->retefuente = $retefuente;
                    $table->reteiva = $reteiva;
                    $table->reteica = $reteica;                    
                    $table->observacion = $observacion;
					$table->insert();
					$this->redirect(["recibocaja/view",'id' => $idrecibo]);
                }
                else
                {
                   // echo "Ha ocurrido un error al eliminar el cliente, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("recibocaja/index")."'>";
                }
            }
            else
            {
                return $this->redirect(["recibocaja/index"]);
            }
        }
		
	public function actionEditardetalle()
        {			
			if(Yii::$app->request->post()){
				$iddetallerecibo = Html::encode($_POST["iddetallerecibo"]);
                if((int) $iddetallerecibo)
                {
                    $table = ReciboCajaDetalle::find()->where(['iddetallerecibo' => $iddetallerecibo])->one();
					$nrofactura = Html::encode($_POST["nrofactura"]);
					$vlrabono = Html::encode($_POST["vlrabono"]);
					$vlrsaldo = Html::encode($_POST["vlrsaldo"]);
					$retefuente = Html::encode($_POST["retefuente"]);
					$reteiva = Html::encode($_POST["reteiva"]);
					$reteica = Html::encode($_POST["reteica"]);
					$observacion= Html::encode($_POST["observacion"]);					
					$idrecibo = $table->idrecibo;
                    if ($table) {
                        $table->nrofactura = $nrofactura;
						$table->vlrabono = $vlrabono;
						$table->vlrsaldo = $vlrsaldo;
						$table->retefuente = $retefuente;
						$table->reteiva = $reteiva;
						$table->reteica = $reteica;
						$table->observacion = $observacion;
                        $table->update();
                        $this->redirect(["recibocaja/view",'id' => $idrecibo]);
                        
                        
                    } else {
                        $msg = "El registro seleccionado no ha sido encontrado";
                        $tipomsg = "danger";
                    }
                } else {
                    $model->getErrors();
                }
            }
			//return $this->render("_formeditardetalle", ["iddetallerecibo" => $iddetallerecibo,]);
        }	
		
	public function actionEliminardetalle()
        {
            if(Yii::$app->request->post())
            {
                $iddetallerecibo = Html::encode($_POST["iddetallerecibo"]);
				$idrecibo = Html::encode($_POST["idrecibo"]);
                if((int) $iddetallerecibo)
                {
                    if(ReciboCajaDetalle::deleteAll("iddetallerecibo=:iddetallerecibo", [":iddetallerecibo" => $iddetallerecibo]))
                    {                        
                        $this->redirect(["recibocaja/view",'id' => $idrecibo]);
                    }
                    else
                    {                       
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("recibocaja/index")."'>";
                    }
                }
                else
                {                   
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("recibocaja/index")."'>";
                }
            }
            else
            {
                return $this->redirect(["recibocaja/index"]);
            }
        }	
	
    protected function findModel($id)
    {
        if (($model = Recibocaja::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
		
}
