<?php

namespace app\controllers;

use app\models\Producto;
use Yii;
use app\models\Ordenproduccion;
use app\models\Ordenproducciondetalle;
use app\models\OrdenproduccionSearch;
use app\models\Cliente;
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

use NumeroALetras;

/**
 * OrdenProduccionController implements the CRUD actions for Ordenproduccion model.
 */
class OrdenProduccionController extends Controller
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
     * Lists all Ordenproduccion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdenproduccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ordenproduccion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modeldetalles = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $id])->all();
        $modeldetalle = new Ordenproducciondetalle();
		return $this->render('view', [
            'model' => $this->findModel($id),
            'modeldetalle' => $modeldetalle,
            'modeldetalles' => $modeldetalles,

        ]);
    }

    /**
     * Creates a new Ordenproduccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ordenproduccion();
		$clientes = Cliente::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->totalorden = 0;
            $model->estado = 0;
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->update();
            return $this->redirect(['view', 'id' => $model->idordenproduccion]);
        }

        return $this->render('create', [
            'model' => $model,
			'clientes' => ArrayHelper::map($clientes, "idcliente", "nombrecorto"),
        ]);
    }

    /**
     * Updates an existing Ordenproduccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$clientes = Cliente::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idordenproduccion]);
        }

        return $this->render('update', [
            'model' => $model,
			'clientes' => ArrayHelper::map($clientes, "idcliente", "nombrecorto"),
        ]);
    }

    /**
     * Deletes an existing Ordenproduccion model.
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
     * Finds the Ordenproduccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ordenproduccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */



	public function actionNuevodetalle($idordenproduccion,$idcliente)
        {

            $productosCliente = Producto::find()->where(['=', 'idcliente', $idcliente])->all();
            //$idproducto =  ($_POST["idproducto"]);
            //$cantidad = ($_POST["cantidad"]);
            //$codigoproducto = ($_POST["codigoproducto"]);
            //$costo =  ($_POST["costoconfeccion"]);

            if (isset($_POST["idproducto"])) {
                $intIndice = 0;
                foreach ($_POST["idproducto"] as $intCodigo) {
                    if($_POST["idproducto"][$intIndice] > 0 ){
                        //$intCantidad = $arrControles['TxtCantidad'][$intIndice];
                        $table = new Ordenproducciondetalle();
                        $table->idproducto = $_POST["idproducto"][$intIndice];
                        $table->cantidad = $_POST["cantidad"][$intIndice];
                        $table->vlrprecio = $_POST["costoconfeccion"][$intIndice];
                        $table->codigoproducto = $_POST["codigoproducto"][$intIndice];
                        $table->subtotal = 100;
                        $table->idordenproduccion = $idordenproduccion;
                        $table->insert();
                    }
                    $intIndice++;
                }
            }
            return $this->render('_formdetalle', [
                'productosCliente' => $productosCliente,
                'idordenprodcuccion' => $idordenproduccion,

            ]);


        }
		
	public function actionEditardetalle()
        {			
			if(Yii::$app->request->post()){
				$iddetalleorden = Html::encode($_POST["iddetalleorden"]);
                if((int) $iddetalleorden)
                {
                    $table = Ordenproducciondetalle::find()->where(['iddetalleorden' => $iddetalleorden])->one();
					$idproducto = Html::encode($_POST["idproducto"]);
					$cantidad = Html::encode($_POST["cantidad"]);
					$vlrprecio = Html::encode($_POST["vlrprecio"]);
					$subtotal = Html::encode($_POST["subtotal"]);
					$idordenproduccion = Html::encode($_POST["idordenproduccion"]);
                    if ($table) {
                        $table->idproducto = $idproducto;
						$table->cantidad = $cantidad;
						$table->vlrprecio = $vlrprecio;
						$table->subtotal = $subtotal;
                        $table->update();
                        $this->redirect(["orden-produccion/view",'id' => $idordenproduccion]);
                        
                        
                    } else {
                        $msg = "El registro seleccionado no ha sido encontrado";
                        $tipomsg = "danger";
                    }
                } else {
                    $table->getErrors();
                }
            }
			//return $this->render("_formeditardetalle", ["iddetallerecibo" => $iddetallerecibo,]);
        }	
		
	public function actionEliminardetalle()
        {
            if(Yii::$app->request->post())
            {
                $iddetalleorden = Html::encode($_POST["iddetalleorden"]);
				$idordenproduccion = Html::encode($_POST["idordenproduccion"]);
                if((int) $iddetalleorden)
                {
                    $ordenProduccionDetalle = OrdenProduccionDetalle::findOne($iddetalleorden);
                    $subtotal = $ordenProduccionDetalle->subtotal;
                    if(OrdenProduccionDetalle::deleteAll("iddetalleorden=:iddetalleorden", [":iddetalleorden" => $iddetalleorden]))
                    {
                        $ordenProduccion = OrdenProduccion::findOne($idordenproduccion);
                        $ordenProduccion->totalorden = $ordenProduccion->totalorden - $subtotal;
                        $ordenProduccion->update();
                        $this->redirect(["orden-produccion/view",'id' => $idordenproduccion]);
                    }
                    else
                    {                       
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("orden-produccion/index")."'>";
                    }
                }
                else
                {                   
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("orden-produccion/index")."'>";
                }
            }
            else
            {
                return $this->redirect(["orden-produccion/index"]);
            }
        }	
	
    protected function findModel($id)
    {
        if (($model = Ordenproduccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
