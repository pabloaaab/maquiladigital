<?php

namespace app\controllers;

use Yii;
use app\models\Facturaventa;
use app\models\Facturaventadetalle;
use app\models\FacturaventaSearch;
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
 * FacturaventaController implements the CRUD actions for Facturaventa model.
 */
class FacturaventaController extends Controller
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
     * Lists all Facturaventa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FacturaventaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Facturaventa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $Facturaventadetalle = Facturaventadetalle::find()->Where(['=', 'nrofactura', $id])->all();
		return $this->render('view', [
            'model' => $this->findModel($id),
			'Facturaventadetalle' => $Facturaventadetalle,
        ]);
    }

    /**
     * Creates a new Facturaventa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Facturaventa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->nrofactura]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Facturaventa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->nrofactura]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Facturaventa model.
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
     * Finds the Facturaventa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Facturaventa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	 
	public function actionNuevodetalle()
        {
        if(Yii::$app->request->post())
            {
                $nrofactura = Html::encode($_POST["nrofactura"]);
				$idproducto = Html::encode($_POST["idproducto"]);
				$codigoproducto = Html::encode($_POST["codigoproducto"]);
				$cantidad = Html::encode($_POST["cantidad"]);
				$preciounitario = Html::encode($_POST["preciounitario"]);
				$total = Html::encode($_POST["total"]);				
                if((int) $nrofactura)
                {                    
                    $table = new Facturaventadetalle();
					$table->nrofactura = $nrofactura;
                    $table->idproducto = $idproducto;
					$table->codigoproducto = $codigoproducto;
                    $table->cantidad = $cantidad;
                    $table->preciounitario = $preciounitario;
                    $table->total = $total;
                    
					$table->insert();
					$this->redirect(["facturaventa/view",'id' => $nrofactura]);
                }
                else
                {
                   // echo "Ha ocurrido un error al eliminar el cliente, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("facturaventa/view")."'>";
                }
            }
            else
            {
                return $this->redirect(["facturaventa/index"]);
            }
        }
		
	public function actionEditardetalle()
        {			
			if(Yii::$app->request->post()){
				$iddetallefactura = Html::encode($_POST["iddetallefactura"]);
                if((int) $iddetallefactura)
                {
                    $table = Facturaventadetalle::find()->where(['iddetallefactura' => $iddetallefactura])->one();					
					$idproducto = Html::encode($_POST["idproducto"]);					
					$codigoproducto = Html::encode($_POST["codigoproducto"]);
					$cantidad = Html::encode($_POST["cantidad"]);
					$preciounitario = Html::encode($_POST["preciounitario"]);
					$total = Html::encode($_POST["total"]);
					$nrofactura = Html::encode($_POST["nrofactura"]);	
                    if ($table) {
                        $table->idproducto = $idproducto;
						$table->codigoproducto = $codigoproducto;
						$table->cantidad = $cantidad;
						$table->preciounitario = $preciounitario;
						$table->total = $total;
                        $table->update();
                        $this->redirect(["facturaventa/view",'id' => $nrofactura]);
                        
                        
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
                $iddetallefactura = Html::encode($_POST["iddetallefactura"]);
				$nrofactura = Html::encode($_POST["nrofactura"]);
                if((int) $iddetallefactura)
                {
                    if(Facturaventadetalle::deleteAll("iddetallefactura=:iddetallefactura", [":iddetallefactura" => $iddetallefactura]))
                    {                        
                        $this->redirect(["facturaventa/view",'id' => $nrofactura]);
                    }
                    else
                    {                       
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("facturaventa/index")."'>";
                    }
                }
                else
                {                   
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("facturaventa/index")."'>";
                }
            }
            else
            {
                return $this->redirect(["facturaventa/index"]);
            }
        }	
	
    protected function findModel($id)
    {
        if (($model = Facturaventa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
