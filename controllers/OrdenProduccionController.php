<?php

namespace app\controllers;


use app\models\Ordenproducciondetalleproceso;
use app\models\ProcesoProduccion;
use Yii;
use app\models\Ordenproduccion;
use app\models\Ordenproducciondetalle;
use app\models\OrdenproduccionSearch;
use app\models\Ordenproducciontipo;
use app\models\Cliente;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FormFiltroOrdenProduccionProceso;
use app\models\Producto;
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
        $mensaje = "";
		return $this->render('view', [
            'model' => $this->findModel($id),
            'modeldetalle' => $modeldetalle,
            'modeldetalles' => $modeldetalles,
            'mensaje' => $mensaje,

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
        $ordenproducciontipos = Ordenproducciontipo::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->totalorden = 0;
            $model->estado = 0;
            $model->autorizado = 0;
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->update();
            return $this->redirect(['view', 'id' => $model->idordenproduccion]);

        }

        return $this->render('create', [
            'model' => $model,
			'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
            'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),

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
        $ordenproducciontipos = Ordenproducciontipo::find()->all();
        if(Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $id])->all() or $model->facturado == 1){            
            Yii::$app->getSession()->setFlash('warning', 'No se puede modificar la información, tiene detalles asociados');
        }else{                       
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idordenproduccion]);
            }
        }        
        return $this->render('update', [
            'model' => $model,
	    'clientes' => ArrayHelper::map($clientes, "idcliente", "nombreClientes"),
            'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
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
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', 'Registro Eliminado.');
            $this->redirect(["orden-produccion/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["orden-produccion/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar la orden de producción, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar la orden de producción, tiene registros asociados en otros procesos');
            $this->redirect(["orden-produccion/index"]);
        }
    }

    public function actionAutorizado($id)
    {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->autorizado == 0){
            $detalles = Ordenproducciondetalle::find()
                ->where(['=', 'idordenproduccion', $id])
                ->all();
            $reg = count($detalles);
            if ($reg <> 0) {
                $model->autorizado = 1;
                $model->update();
                $this->redirect(["orden-produccion/view",'id' => $id]);
            }else{
                Yii::$app->getSession()->setFlash('error', 'Para autorizar el registro, debe tener productos relacionados en la orden de producción.');
                $this->redirect(["orden-produccion/view",'id' => $id]);
            }
        } else {
            $model->autorizado = 0;
            $model->update();
            $this->redirect(["orden-produccion/view",'id' => $id]);
        }
    }

    public function actionNuevodetalles($idordenproduccion,$idcliente)
    {
        $productosCliente = Producto::find()->where(['=', 'idcliente', $idcliente])->all();
        $ponderacion = 0;
        $error = 0;
        if (isset($_POST["idproducto"])) {
            $intIndice = 0;
            foreach ($_POST["idproducto"] as $intCodigo) {
                if($_POST["cantidad"][$intIndice] > 0 ){
                    $detalles = Ordenproducciondetalle::find()
                        ->where(['=', 'idordenproduccion', $idordenproduccion])
                        ->andWhere(['=', 'idproducto', $intCodigo])
                        ->all();
                    $reg = count($detalles);
                    if ($reg == 0) {
                        $producto = Producto::findOne($intCodigo);
                        if($_POST["cantidad"][$intIndice] <= $producto->cantidad){//se valida que la cantidad a ingresar no sea mayor a la cantidad disponible
                            $ordenProduccion = Ordenproduccion::findOne($idordenproduccion);
                            $table = new Ordenproducciondetalle();
                            $table->idproducto = $_POST["idproducto"][$intIndice];
                            $table->cantidad = $_POST["cantidad"][$intIndice];
                            $table->vlrprecio = $_POST["vlrventa"][$intIndice];
                            $table->codigoproducto = $_POST["codigoproducto"][$intIndice];
                            $table->subtotal = $_POST["cantidad"][$intIndice] * $_POST["vlrventa"][$intIndice];
                            $table->idordenproduccion = $idordenproduccion;
                            $table->ponderacion = $ordenProduccion->ponderacion;
                            $table->insert();
                            $ordenProduccion->totalorden = $ordenProduccion->totalorden + $table->subtotal;
                            $ordenProduccion->update();
                        }else{
                            $error = 1;                            
                        }                        
                    }
                }
                $intIndice++;
            }
            if($error == 1){
                Yii::$app->getSession()->setFlash('error', 'El valor de la cantidad no puede ser mayor a la cantidad disponible');                
            }else{
                $this->redirect(["orden-produccion/view",'id' => $idordenproduccion]);
            }            
        }

        return $this->render('_formnuevodetalles', [
            'productosCliente' => $productosCliente,
            'idordenproduccion' => $idordenproduccion,
        ]);
    }

    public function actionEditardetalle()
    {
        $iddetalleorden = Html::encode($_POST["iddetalleorden"]);
        $idordenproduccion = Html::encode($_POST["idordenproduccion"]);

        if(Yii::$app->request->post()){

            if((int) $iddetalleorden)
            {
                $table = Ordenproducciondetalle::findOne($iddetalleorden);
                $producto = Producto::findOne($table->idproducto);
                if ($table) {

                    $table->cantidad = Html::encode($_POST["cantidad"]);
                    $table->vlrprecio = Html::encode($_POST["vlrprecio"]);
                    $table->subtotal = Html::encode($_POST["cantidad"]) * Html::encode($_POST["vlrprecio"]);
                    $table->idordenproduccion = Html::encode($_POST["idordenproduccion"]);
                    
                    $ordenProduccion = Ordenproduccion::findOne($table->idordenproduccion);
                    
                    $ordenProduccion->totalorden =  $ordenProduccion->totalorden - Html::encode($_POST["subtotal"]);
                    $ordenProduccion->totalorden = $ordenProduccion->totalorden + $table->subtotal;
                    if(Html::encode($_POST["cantidad"]) <= $producto->cantidad){//se valida que la cantidad a ingresar no sea mayor a la cantidad disponible
                       $table->update();
                       $ordenProduccion->update();
                       $this->redirect(["orden-produccion/view",'id' => $idordenproduccion]); 
                    }else{
                       Yii::$app->getSession()->setFlash('error', 'El valor de la cantidad no puede ser mayor a la cantidad disponible');
                       $this->redirect(["orden-produccion/view",'id' => $idordenproduccion]); 
                    }
                    
                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                    $tipomsg = "danger";
                }
            }
        }
        //return $this->render("_formeditardetalle", ["model" => $model,]);
    }

	public function actionEditardetalles($idordenproduccion)
        {
            $mds = Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $idordenproduccion])->all();
            $error = 0;
            if (isset($_POST["iddetalleorden"])) {
                $intIndice = 0;
                foreach ($_POST["iddetalleorden"] as $intCodigo) {
                    if($_POST["cantidad"][$intIndice] > 0 ){                                                
                            $table = Ordenproducciondetalle::findOne($intCodigo);
                            $subtotal = $table->subtotal;
                            $table->cantidad = $_POST["cantidad"][$intIndice];
                            $table->vlrprecio = $_POST["vlrprecio"][$intIndice];

                            $table->subtotal = $_POST["cantidad"][$intIndice] * $_POST["vlrprecio"][$intIndice];
                            
                            $ordenProduccion = Ordenproduccion::findOne($idordenproduccion);
                            $ordenProduccion->totalorden =  $ordenProduccion->totalorden - $subtotal;
                            $ordenProduccion->totalorden = $ordenProduccion->totalorden + $table->subtotal;
                            $producto = Producto::findOne($intCodigo);
                            if($_POST["cantidad"][$intIndice] <= $table->cantidad){//se valida que la cantidad a ingresar no sea mayor a la cantidad disponible
                                $table->update();
                                $ordenProduccion->update();
                            }else{
                                $error = 1;
                            }                        
                    }
                    $intIndice++;
                }
                if($error == 1){
                    Yii::$app->getSession()->setFlash('error', 'El valor de la cantidad no puede ser mayor a la cantidad disponible');                
                }else{
                    $this->redirect(["orden-produccion/view",'id' => $idordenproduccion]);
                }
            }
            return $this->render('_formeditardetalles', [
                'mds' => $mds,
                'idordenproduccion' => $idordenproduccion,
            ]);
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

    public function actionEliminardetalles($idordenproduccion)
    {
        $mds = Ordenproducciondetalle::find()->where(['=', 'idordenproduccion', $idordenproduccion])->all();
        $mensaje = "";
        if(Yii::$app->request->post())
        {
            $intIndice = 0;

            if (isset($_POST["seleccion"])) {
                foreach ($_POST["seleccion"] as $intCodigo) {
                    $ordenProduccionDetalle = OrdenProduccionDetalle::findOne($intCodigo);
                    $subtotal = $ordenProduccionDetalle->subtotal;
                    if (OrdenProduccionDetalle::deleteAll("iddetalleorden=:iddetalleorden", [":iddetalleorden" => $intCodigo])) {
                        $ordenProduccion = OrdenProduccion::findOne($idordenproduccion);
                        $ordenProduccion->totalorden = $ordenProduccion->totalorden - $subtotal;
                        $ordenProduccion->update();

                    }
                }
                $this->redirect(["orden-produccion/view", 'id' => $idordenproduccion]);
            }else{
                $mensaje = "Debe seleccionar al menos un registro";
            }
        }
        return $this->render('_formeliminardetalles', [
            'mds' => $mds,
            'idordenproduccion' => $idordenproduccion,
            'mensaje' => $mensaje,
        ]);
    }

    public function actionProceso()
    {
        //if (!Yii::$app->user->isGuest) {
        $form = new FormFiltroOrdenProduccionProceso();
        $idcliente = null;
        $ordenproduccion = null;
        $idtipo = null;
        $clientes = Cliente::find()->all();
        $ordenproducciontipos = Ordenproducciontipo::find()->all();
        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
                $idcliente = Html::encode($form->idcliente);
                $ordenproduccion = Html::encode($form->ordenproduccion);
                $idtipo = Html::encode($form->idtipo);
                $table = Ordenproduccion::find()
                    ->andFilterWhere(['=', 'idcliente', $idcliente])
                    ->andFilterWhere(['like', 'ordenproduccion', $ordenproduccion])
                    ->andFilterWhere(['=', 'idtipo', $idtipo])
                    ->orderBy('idordenproduccion desc');
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
            $table = Ordenproduccion::find()
                ->orderBy('idordenproduccion desc');
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

        return $this->render('ordenproduccionproceso', [
            'model' => $model,
            'form' => $form,
            'pagination' => $pages,
            'clientes' => ArrayHelper::map($clientes, "idcliente", "nombrecorto"),
            'ordenproducciontipos' => ArrayHelper::map($ordenproducciontipos, "idtipo", "tipo"),
        ]);
        /* }else{
             return $this->redirect(["site/login"]);
         }*/

    }

    public function actionNuevo_detalle_proceso($id,$iddetalleorden){
        $procesos = ProcesoProduccion::find()->all();
        if (isset($_POST["idproceso"])) {
            $intIndice = 0;
            foreach ($_POST["idproceso"] as $intCodigo) {
                if($_POST["duracion"][$intIndice] > 0 ){
                    $detalles = Ordenproducciondetalleproceso::find()
                        ->where(['=', 'idproceso', $intCodigo])
                        ->andWhere(['=', 'iddetalleorden', $iddetalleorden])
                        ->all();
                    $reg = count($detalles);
                    if ($reg == 0) {
                        $table = new Ordenproducciondetalleproceso();
                        $table->idproceso = $intCodigo;
                        $table->proceso = $_POST["proceso"][$intIndice];
                        $table->duracion = $_POST["duracion"][$intIndice];
                        $table->ponderacion = $_POST["ponderacion"][$intIndice];
                        $table->total = $_POST["duracion"][$intIndice] + ($_POST["duracion"][$intIndice] * $_POST["ponderacion"][$intIndice]/100);
                        $table->iddetalleorden = $iddetalleorden;
                        $table->insert();
                    }
                }
                $intIndice++;
            }
            $detalleorden = Ordenproducciondetalle::findOne($iddetalleorden);
            $this->progresoproceso($iddetalleorden,$detalleorden->idordenproduccion);
            //se replica los procesos a detalles que contengan el mismo codigo de producto, para agilizar la insercion de cada uno de las operaciones por detalle            
            $detallesordenproduccion = Ordenproducciondetalle::find()
                    ->where(['<>','iddetalleorden',$iddetalleorden])
                    ->andWhere(['idordenproduccion' => $detalleorden->idordenproduccion])
                    ->all();            
            foreach ($detallesordenproduccion as $dato){
                if ($dato->codigoproducto == $detalleorden->codigoproducto){
                    $detallesprocesos = Ordenproducciondetalleproceso::find()->where(['iddetalleorden' => $iddetalleorden])->all();
                    foreach ($detallesprocesos as $val){
                        $detallesp = Ordenproducciondetalleproceso::find()
                        ->where(['=', 'idproceso', $val->idproceso])
                        ->andWhere(['=', 'iddetalleorden', $dato->iddetalleorden])
                        ->all();
                    $reg2 = count($detallesp);
                        if($reg2 == 0){
                            $tableprocesos = new Ordenproducciondetalleproceso();
                            $tableprocesos->idproceso = $val->idproceso;
                            $tableprocesos->proceso = $val->proceso;
                            $tableprocesos->duracion = $val->duracion;
                            $tableprocesos->ponderacion = $val->ponderacion;
                            $tableprocesos->total = $val->total;
                            $tableprocesos->iddetalleorden = $dato->iddetalleorden;
                            $tableprocesos->insert();
                        }
                    }
                    $this->progresoproceso($dato->iddetalleorden,$dato->idordenproduccion);
                }
            }
            $this->redirect(["orden-produccion/view_detalle",'id' => $id]);
        }

        return $this->renderAjax('_formnuevodetalleproceso', [
            'procesos' => $procesos,
            'id' => $id,
            'iddetalleorden' => $iddetalleorden,
        ]);
    }

    public function actionDetalle_proceso($idordenproduccion,$iddetalleorden){
        $procesos = Ordenproducciondetalleproceso::find()->Where(['=', 'iddetalleorden', $iddetalleorden])->all();
        if(Yii::$app->request->post()) {
            if (isset($_POST["editar"])) {
                if (isset($_POST["iddetalleproceso1"])) {
                    $intIndice = 0;
                    foreach ($_POST["iddetalleproceso1"] as $intCodigo) {
                        if($_POST["duracion"][$intIndice] > 0 ){
                            $table = Ordenproducciondetalleproceso::findOne($intCodigo);
                            $table->duracion = $_POST["duracion"][$intIndice];
                            $table->ponderacion = $_POST["ponderacion"][$intIndice];
                            $table->total = $_POST["duracion"][$intIndice] + ($_POST["duracion"][$intIndice] * $_POST["ponderacion"][$intIndice]/100);
                            $table->update();
                        }
                        $intIndice++;
                    }
                }
                
                $detalle = Ordenproducciondetalle::findOne($iddetalleorden);
                $cantidad = $detalle->cantidad;
                $cantidad_operada = $_REQUEST['cantidadoperada'];
                $detalle->cantidad_operada = $cantidad_operada;
                $detalle->porcentaje_cantidad = $cantidad_operada * 100 / $cantidad;
                $detalle->update();
            }
            if (isset($_POST["eliminar"])) {
                if (isset($_POST["iddetalleproceso2"])) {
                    foreach ($_POST["iddetalleproceso2"] as $intCodigo) {

                        if (Ordenproducciondetalleproceso::deleteAll("iddetalleproceso=:iddetalleproceso", [":iddetalleproceso" => $intCodigo])) {

                        }
                    }
                }else{
                    Yii::$app->getSession()->setFlash('error', 'Debe seleccionar al menos un registro.');
                    $this->redirect(["orden-produccion/view_detalle",'id' => $idordenproduccion]);
                }
            }
            if (isset($_POST["ac"])) {//abrir/cerrar en la ejecucion del proceso si esta terminado o no ha sido terminado
                if (isset($_POST["iddetalleproceso1"])) {
                    $intIndice = 0;
                    foreach ($_POST["iddetalleproceso1"] as $intCodigo) {
                        if($_POST["estado"][$intIndice] >= 0 ){
                            $table = Ordenproducciondetalleproceso::findOne($intCodigo);
                            $table->estado = $_POST["estado"][$intIndice];
                            $table->update();
                        }
                        $intIndice++;
                    }
                }
            }
            $this->progresoproceso($iddetalleorden,$idordenproduccion);
            $this->redirect(["orden-produccion/view_detalle",'id' => $idordenproduccion]);
        }
        return $this->renderAjax('_formdetalleproceso', [
            'procesos' => $procesos,
            'idordenproduccion' => $idordenproduccion,
            'iddetalleorden' => $iddetalleorden,
        ]);
    }

    public function actionView_detalle($id)
    {
        $modeldetalles = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $id])->all();
        $modeldetalle = new Ordenproducciondetalle();
        return $this->render('view_detalle', [
            'model' => $this->findModel($id),
            'modeldetalle' => $modeldetalle,
            'modeldetalles' => $modeldetalles,
        ]);
    }
	
    protected function findModel($id)
    {
        if (($model = Ordenproduccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function progresoproceso($iddetalleorden,$idordenproduccion){
        $procesos = Ordenproducciondetalleproceso::find()->Where(['=', 'iddetalleorden', $iddetalleorden])->all();
        $totalsegundos = (new \yii\db\Query())->from('ordenproducciondetalleproceso');
        $sum = $totalsegundos->where(['=','iddetalleorden',$iddetalleorden])->sum('total');
        $progreso = 0;
        $totalprogreso = 0;
        if ($sum > 0){
            foreach ($procesos as $val){
                if ($val->estado == 1) {
                    $progreso = ($val->total * 100) / $sum;
                    $totalprogreso = $totalprogreso + $progreso;
                }
                $total = round($totalprogreso,0);
                $tabla = Ordenproducciondetalle::findOne(['=','iddetalleorden',$iddetalleorden]);
                $tabla->porcentaje_proceso = $total;
                $tabla->update();
                $orden = Ordenproduccion::findOne(['=','idordenproduccion',$tabla->idordenproduccion]);
                $detallesorden = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $tabla->idordenproduccion])->all();
                $totalporc = 0;

                //suma de cantidades de los detalles de orden de produccion
                $totalcantidades = (new \yii\db\Query())->from('ordenproducciondetalle');
                $sumcant = $totalcantidades->where(['=','idordenproduccion',$tabla->idordenproduccion])->sum('cantidad');
                foreach ($detallesorden as $dato)
                {
                    //proceso para sacar el procentaje total de la orden de produccion en la parte operacional
                    $porcentajecantidad = $dato->cantidad * 100/ $sumcant;
                    $porcentajetotal = $dato->porcentaje_proceso * $porcentajecantidad /100;
                    $totalporc = $totalporc + $porcentajetotal;
                }
                $orden->porcentaje_proceso = round($totalporc,0) ;
                $orden->update();
                //Yii::$app->getSession()->setFlash('error',$totalporc );
            }
        }else {
            $tabla = Ordenproducciondetalle::findOne(['=','iddetalleorden',$iddetalleorden]);
            $tabla->porcentaje_proceso = 0;
            $tabla->update();
        }
        $totalporcentajecant = 0;
        $ordenDetalles = Ordenproducciondetalle::find()->Where(['=', 'idordenproduccion', $idordenproduccion])->all();
        foreach ($ordenDetalles as $val){
            $totalporcentajecant = $totalporcentajecant + $val->porcentaje_cantidad;
        }
        $ordenp = Ordenproduccion::findOne($idordenproduccion);
        $ordenp->porcentaje_cantidad = $totalporcentajecant / count($ordenDetalles);
        $ordenp->update();
    }

}
