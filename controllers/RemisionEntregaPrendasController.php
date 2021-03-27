<?php

namespace app\controllers;

use Yii;
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


//modelos
use app\models\RemisionEntregaPrendaDetalles;
use app\models\RemisionEntregaPrendasSearch;
use app\models\UsuarioDetalle;
use app\models\FormFiltroCostoProducto;
use app\models\RemisionEntregaPrendas;
use app\models\FormFiltroRemisionEntrega;
use app\models\FormMaquinaBuscar;
use app\models\Consecutivo;
use app\models\FormEditarDetalleRemisionEntrega;

/**
 * RemisionEntregaPrendasController implements the CRUD actions for RemisionEntregaPrendas model.
 */
class RemisionEntregaPrendasController extends Controller
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
     * Lists all RemisionEntregaPrendas models.
     * @return mixed
     */
     public function actionIndex() {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',105])->all()){
                $form = new FormFiltroRemisionEntrega();
                $idcliente = null;
                $fecha_entrega = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {                        
                        $idcliente = Html::encode($form->idcliente);
                        $fecha_entrega = Html::encode($form->fecha_entrega);
                        $table = RemisionEntregaPrendas::find()
                                ->andFilterWhere(['=', 'idcliente', $idcliente])
                                ->andFilterWhere(['>=', 'fecha_entrega', $fecha_entrega]);   
                       $table = $table->orderBy('id_remision DESC');
                        $tableexcel = $table->all();
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 40,
                            'totalCount' => $count->count()
                        ]);
                        $model = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                            if(isset($_POST['excel'])){                            
                                $check = isset($_REQUEST['id_remision DESC']);
                                $this->actionExcelconsulta($tableexcel);
                            }
                } else {
                        $form->getErrors();
                }                    
            } else {
                $table = RemisionEntregaPrendas::find()
                        ->orderBy('id_remision DESC');
                $tableexcel = $table->all();
                $count = clone $table;
                $pages = new Pagination([
                    'pageSize' => 40,
                    'totalCount' => $count->count(),
                ]);
                $model = $table
                        ->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
                if(isset($_POST['excel'])){
                    //$table = $table->all();
                    $this->actionExcelconsulta($tableexcel);
                }
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
     * Displays a single RemisionEntregaPrendas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $mensaje = "";
        $remisiondetalle = RemisionEntregaPrendaDetalles::find()->Where(['=', 'id_remision', $id])->all();
        $modeldetalle = new RemisionEntregaPrendaDetalles();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'mensaje' => $mensaje,
            'remisiondetalle' => $remisiondetalle,
            'modeldetalle' => $modeldetalle,
            
            
        ]);
    }

    /**
     * Creates a new RemisionEntregaPrendas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RemisionEntregaPrendas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->observacion = $model->observacion;
            $model->save();
            return $this->redirect(['index', 'id' => $model->id_remision]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    //actuliza la remision
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           echo $model->observacion = $model->observacion;
            $model->save();
            return $this->redirect(['index', 'id' => $model->id_remision]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    //FUNCION QUE ELIMINA LOS DETALLES DE LA REMISION
    
   public function actionEliminardetalle()
    {
        if(Yii::$app->request->post())
        {
           echo $iddetalle = Html::encode($_POST["iddetalle"]);
            echo $idremision = Html::encode($_POST["idremision"]);
            echo $id_referencia = Html::encode($_POST["id_referencia"]);
            if((int) $iddetalle)
            {
                $sw = 2;
                $id = $idremision;
                $this->ActualizarTallasReferencia($id, $id_referencia, $sw);
                if(RemisionEntregaPrendaDetalles::deleteAll("id_detalle=:id_detalle", [":id_detalle" => $iddetalle]))
                {
                    $this->actualizarSaldo($id);
                   $this->redirect(["remision-entrega-prendas/view",'id' => $idremision]);
                }else{
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("remision-entrega_prendas/index")."'>";
                }
            }else{
                echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("remision-entrega_prendas/index")."'>";
            }
        }else{
          return $this->redirect(["remision-entrega_prendas/index"]);
        }
    }

   //NUEVO DETALLE EN LA REMISION 
    public function actionNuevodetalle($id)
    {
        $referencias = \app\models\Referencias::find()->where(['=','autorizado', 1])->orderBy('descripcion asc')->all();
        $form = new FormMaquinaBuscar();
        $q = null;
        $mensaje = '';
        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
                $q = Html::encode($form->q);                                
                if ($q){
                    $referencias = \app\models\Referencias::find()
                            ->where(['like','descripcion',$q])
                            ->orwhere(['like','codigo_producto',$q])
                            ->orderBy('descripcion asc')
                            ->all();
                }               
            } else {
                $form->getErrors();
            }                    
        } else {
            $referencias = \app\models\Referencias::find()->where(['=','autorizado', 1])->andWhere(['>','total_existencias', 0])->orderBy('descripcion asc')->all();
        }
        if (isset($_POST["id_referencia"])) {
                $intIndice = 0;
                foreach ($_POST["id_referencia"] as $intCodigo) {
                    $table = new RemisionEntregaPrendaDetalles();
                    $referencia = \app\models\Referencias::find()->where(['id_referencia' => $intCodigo])->one();
                    $table->id_referencia = $referencia->id_referencia;
                    $table->codigo_producto = $referencia->codigo_producto;
                    $table->cantidad = 1;
                    $table->valor_unitario = $referencia->precio_venta_deptal;
                    $table->total_linea = round($table->cantidad * $table->valor_unitario,2);
                    $table->id_remision = $id;
                    $table->insert(); 
                    $this->actualizarSaldo($id);
                    
                }
               $this->redirect(["remision-entrega-prendas/view", 'id' => $id]);
            }else{
                
            }
        return $this->render('_formnuevodetalle', [
            'referencias' => $referencias,            
            'mensaje' => $mensaje,
            'id' => $id,
            'form' => $form,

        ]);
    }
    
    //FUNCION QUE EDITA EL DETALLE
    
     public function actionEditardetalleremisiontallas($id_detalle, $id, $id_referencia) {                
        $model = new FormEditarDetalleRemisionEntrega();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {            
            if ($model->validate()) {
                $referencia = \app\models\Referencias::findOne($id_referencia);
                $archivo = RemisionEntregaPrendaDetalles::findOne($id_detalle);
                 $contador = 0;
                if (isset($_POST["actualizar"])) { 
                    if($archivo->cantidad <= $referencia->total_existencias){
                        $descuento = 0; $sw = 1; 
                        $archivo->cantidad = $model->cantidad;
                        $archivo->valor_unitario = $model->valor_unitario;
                        $archivo->porcentaje_descuento = $model->porcentaje_descuento;
                        $descuento = round($model->valor_unitario -($model->valor_unitario * $model->porcentaje_descuento)/100);
                        if($model->porcentaje_descuento > 0){;
                           $archivo->valor_descuento = $descuento;
                        }else{
                            $archivo->valor_descuento = 0;
                        }   
                        $archivo->total_linea = ($descuento * $model->cantidad);
                        $archivo->t2 = $model->t2;
                        $archivo->t4 = $model->t4;
                        $archivo->t6 = $model->t6;
                        $archivo->t8 = $model->t8;
                        $archivo->t10 = $model->t10;
                        $archivo->t12 = $model->t12;
                        $archivo->t14 = $model->t14;
                        $archivo->t16 = $model->t16;
                        $archivo->t18 = $model->t18;
                        $archivo->t20 = $model->t20;
                        $archivo->t22 = $model->t22;
                        $archivo->t24 = $model->t24;
                        $archivo->t26 = $model->t26;
                        $archivo->t28 = $model->t28;
                        $archivo->t30 = $model->t30;
                        $archivo->t32 = $model->t32;
                        $archivo->t34 = $model->t34;
                        $archivo->t36= $model->t36;
                        $archivo->t38 = $model->t38;
                        $archivo->t40 = $model->t40;
                        $archivo->t42 = $model->t42;
                        $archivo->t44 = $model->t44;
                        $archivo->xs = $model->xs;
                        $archivo->s = $model->s;
                        $archivo->m = $model->m;
                        $archivo->l = $model->l;
                        $archivo->xl = $model->xl;
                        $archivo->xxl = $model->xxl;
                        $archivo->t_unica = $model->t_unica;
                        $archivo->save(false);
                        $this->actualizarSaldo($id);
                        $this->ActualizarTallasReferencia($id, $id_referencia, $sw);
                        $this->redirect(["remision-entrega-prendas/view", 'id' => $id]); 
                    }else{
                        $contador = 1; 
                      
                    } 
                    if($contador == 1){
                           $this->redirect(["remision-entrega-prendas/view", 'id' => $id]); 
                            Yii::$app->getSession()->setFlash('success', 'Las existencia de estas referencia son menores que las vendidas. Favor validar con el administrador.');
                    }
                }
            }
        }
        if (Yii::$app->request->get("id_detalle")) {
            $table = RemisionEntregaPrendaDetalles::find()->where(['id_detalle' => $id_detalle])->one(); 
            $cantidad_unidad= \app\models\Referencias::find()->where(['=','id_referencia', $id_referencia])->andWhere(['>','total_existencias', 0])->one();
            $existencia = \app\models\Referencias::find()->where(['=','id_referencia', $id_referencia])->one();
            if ($table) {  
                $mensaje = '';
                $model->cantidad = $table->cantidad;
                $model->id_detalle = $id_detalle;                 
                $model->valor_unitario = $table->valor_unitario; 
                $model->porcentaje_descuento = $table->porcentaje_descuento;
                $model->total_linea = $table->total_linea;
                $model->t2 = $table->t2;
                $model->t4 = $table->t4;
                $model->t6 = $table->t6;
                $model->t8 = $table->t8;
                $model->t10 = $table->t10;
                $model->t12 = $table->t12;
                $model->t14 = $table->t14;
                $model->t16 = $table->t16;
                $model->t18 = $table->t18;
                $model->t20 = $table->t20;
                $model->t22 = $table->t22;
                $model->t24 = $table->t24;
                $model->t26 = $table->t26;
                $model->t28 = $table->t28;
                $model->t30 = $table->t30;
                $model->t32 = $table->t32;
                $model->t34 = $table->t34;
                $model->t36 = $table->t36;
                $model->t38 = $table->t38;
                $model->t40 = $table->t40;
                $model->t42 = $table->t42;
                $model->t44 = $table->t44;
                $model->xs = $table->xs;
                $model->s = $table->s;
                $model->m = $table->m;
                $model->l = $table->l;
                $model->xl = $table->xl;
                $model->xxl = $table->xxl;
                $model->t_unica = $table->t_unica;
            }
            
        }
        return $this->renderAjax('_editardetalleremisionentrega', [
                                                                   'model' => $model,
                                                                   'id_detalle' => $id_detalle,
                                                                   'cantidad_unidad' => $cantidad_unidad,
                                                                   'id' => $id, 'existencia' => $existencia,
                                                                    'mensaje' => $mensaje]);
    }
    
    protected function ActualizarTallasReferencia($id, $id_referencia, $sw) {
        //declaracion de variable
        $t2 = 0; $t4 = 0; $t6 = 0; $t8 = 0; $t10 = 0; $t12 = 0; $t14 = 0; $t16 = 0; $t18 = 0; $t20 = 0; $t22 = 0; $t24 = 0; 
        $t26 = 0; $t28 = 0; $t30 = 0; $t32 = 0; $t34 = 0; $t36 = 0; $t38 = 0; $t40 = 0; $t42 = 0; $t44 = 0; $txs = 0; $ts = 0; $tm = 0; 
        $tl = 0; $txl = 0; $txxl = 0; $t_unica = 0; $cantidad = 0;
        $remision_detalle = RemisionEntregaPrendaDetalles::find()->where(['=','id_remision', $id])->andWhere(['=','id_referencia', $id_referencia])->all();
        foreach ($remision_detalle as $detalle):
            $t2 += $detalle->t2;
            $t4 += $detalle->t4;
            $t6 += $detalle->t6;
            $t8 += $detalle->t8;
            $t10 += $detalle->t10;
            $t12 += $detalle->t12;
            $t14 += $detalle->t14;
            $t16 += $detalle->t16;
            $t18 += $detalle->t18;
            $t20 += $detalle->t20;
            $t22 += $detalle->t22;
            $t24 += $detalle->t24;  
            $t26 += $detalle->t26;
            $t28 += $detalle->t28;
            $t30 += $detalle->t30;
            $t32 += $detalle->t32;
            $t34 += $detalle->t34;
            $t36 += $detalle->t36;
            $t38 += $detalle->t38;
            $t40 += $detalle->t40;
            $t42 += $detalle->t42;
            $t44 += $detalle->t44;
            $txs += $detalle->xs;
            $ts += $detalle->s;
            $tm += $detalle->m;
            $tl += $detalle->l;
            $txl += $detalle->xl;
            $txxl += $detalle->xxl;
            $t_unica += $detalle->t_unica;
            $cantidad = $detalle->cantidad;
        endforeach;
        $referencia = \app\models\Referencias::find()->where(['=','id_referencia', $id_referencia])->one();
       if($sw == 1){
            $referencia->t2 =  $referencia->t2 - $t2;
            $referencia->t4 =  $referencia->t4 - $t4;
            $referencia->t6 =  $referencia->t6 - $t6;
            $referencia->t8 =  $referencia->t8 - $t8;
            $referencia->t10 =  $referencia->t10 - $t10;
            $referencia->t12 =  $referencia->t12 - $t12;
            $referencia->t14 =  $referencia->t14 - $t14;
            $referencia->t16 =  $referencia->t16 - $t16;
            $referencia->t18 =  $referencia->t18 - $t18;
            $referencia->t20 =  $referencia->t20 - $t20;
            $referencia->t22 =  $referencia->t22 - $t22;
            $referencia->t24 =  $referencia->t24 - $t24;
            $referencia->t26 =  $referencia->t26 - $t26;
            $referencia->t28 =  $referencia->t28 - $t28;
            $referencia->t30 =  $referencia->t30 - $t30;
            $referencia->t32 =  $referencia->t32 - $t32;
            $referencia->t34 =  $referencia->t34 - $t34;
            $referencia->t36 =  $referencia->t36 - $t36;
            $referencia->t38 =  $referencia->t38 - $t38;
            $referencia->t40 =  $referencia->t40 - $t40;
            $referencia->t42 =  $referencia->t42 - $t42;
            $referencia->t44 =  $referencia->t44 - $t44;
            $referencia->xs =  $referencia->xs - $txs;
            $referencia->s =  $referencia->s - $ts;
            $referencia->m =  $referencia->m - $tm;
            $referencia->l =  $referencia->l - $tl;
            $referencia->xl =  $referencia->xl - $txl;
            $referencia->xxl =  $referencia->xxl - $txxl;
            $referencia->t_unica =  $referencia->t_unica - $t_unica;
            $referencia->total_existencias = $referencia->total_existencias - $cantidad; 
       }else{
           $referencia->t2 =  $referencia->t2 + $t2;
            $referencia->t4 =  $referencia->t4 + $t4;
            $referencia->t6 =  $referencia->t6 + $t6;
            $referencia->t8 =  $referencia->t8 + $t8;
            $referencia->t10 =  $referencia->t10 + $t10;
            $referencia->t12 =  $referencia->t12 + $t12;
            $referencia->t14 =  $referencia->t14 + $t14;
            $referencia->t16 =  $referencia->t16 + $t16;
            $referencia->t18 =  $referencia->t18 + $t18;
            $referencia->t20 =  $referencia->t20 + $t20;
            $referencia->t22 =  $referencia->t22 + $t22;
            $referencia->t24 =  $referencia->t24 + $t24;
            $referencia->t26 =  $referencia->t26 + $t26;
            $referencia->t28 =  $referencia->t28 + $t28;
            $referencia->t30 =  $referencia->t30 + $t30;
            $referencia->t32 =  $referencia->t32 + $t32;
            $referencia->t34 =  $referencia->t34 + $t34;
            $referencia->t36 =  $referencia->t36 + $t36;
            $referencia->t38 =  $referencia->t38 + $t38;
            $referencia->t40 =  $referencia->t40 + $t40;
            $referencia->t42 =  $referencia->t42 + $t42;
            $referencia->t44 =  $referencia->t44 + $t44;
            $referencia->xs =  $referencia->xs + $txs;
            $referencia->s =  $referencia->s + $ts;
            $referencia->m =  $referencia->m + $tm;
            $referencia->l =  $referencia->l + $tl;
            $referencia->xl =  $referencia->xl + $txl;
            $referencia->xxl =  $referencia->xxl + $txxl;
            $referencia->t_unica =  $referencia->t_unica + $t_unica;
            $referencia->total_existencias = $referencia->total_existencias + $cantidad; 
       }    
        $referencia->save(false);
    }
    
  /*  public function actionEditardetalle()
    {
        $iddetalle = Html::encode($_POST["iddetalle"]);
        $idremision = Html::encode($_POST["idremision"]);

        if(Yii::$app->request->post()){
            if((int) $iddetalle)
            {
                $id =  $idremision;
                $dcto = 0; $total = 0;
                $table = RemisionEntregaPrendaDetalles::findOne($iddetalle);
                if ($table) {
                    $table->cantidad = Html::encode($_POST["cantidad"]);
                    $table->valor_unitario = Html::encode($_POST["valor_unitario"]);
                    $total = Html::encode($_POST["cantidad"]) * Html::encode($_POST["valor_unitario"]);
                    $dcto = round($total * Html::encode($_POST["descuento"])/100);
                    $table->valor_descuento = $dcto;
                    $table->porcentaje_descuento = Html::encode($_POST["descuento"]);
                    $table->total_linea = $total - $dcto;
                    $table->save(false);
                    $this->actualizarSaldo($id);
                    $this->redirect(["remision-entrega-prendas/view",'id' => $id]);

                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                    $tipomsg = "danger";
                }
            }
        }
       //return $this->render("_formeditardetalle", ["id" => $model,]);
    }*/
    
    //FUNCION QUE ACTUALIZA TOTALES Y CANTIDADES
    protected function actualizarSaldo($id) {
       
        $remision = RemisionEntregaPrendas::findOne($id);
        $detalle = RemisionEntregaPrendaDetalles::find()->where(['=','id_remision', $id])->all();
        $total = 0;
        $cantidad = 0;
        foreach ($detalle as $valores):
            $total += $valores->total_linea;
            $cantidad += $valores->cantidad;
        endforeach;
        $remision->valor_total = $total;
        $remision->valor_pagar = $total;
        $remision->cantidad = $cantidad;
        $remision->save(false);
    }
    
    //CODIGO QUE AUTORIZA EL PRODUCTO
    public function actionAutorizado($id) {
        $model = $this->findModel($id);
        $mensaje = "";
        if ($model->valor_pagar == 0){
            $this->redirect(["remision-entrega-prendas/view", 'id' => $id]);
            Yii::$app->getSession()->setFlash('warning', 'No se puede autorizar la remision porque no tiene detalles asociados.');
        }else{    
            if ($model->autorizado == 0) {                        
                $model->autorizado = 1;            
                $model->update();
                $this->redirect(["remision-entrega-prendas/view", 'id' => $id]);            
            } else{
                $model->autorizado = 0;
                $model->update();
                 $this->redirect(["remision-entrega-prendas/view", 'id' => $id]); 
            }
        }    

    }
    //CODIGO QUE GENERA EL CONSECUTIVO
    
    public function actionGenerarnro($id)
    {
        $model = $this->findModel($id);
        $remision = RemisionEntregaPrendas::findOne($id);
        $consecutivo = Consecutivo::findOne(12);// 12 REMISION DE ENTREGA DE PRODUCTOS
        $consecutivo->consecutivo = $consecutivo->consecutivo + 1;
        $consecutivo->save(false);
        $remision->nro_remision = $consecutivo->consecutivo;
        $remision->save(false);
        $this->ActualizarExistencias($id);
        $this->redirect(["remision-entrega-prendas/view",'id' => $id]);
            
    }
    
    protected function ActualizarExistencias($id) {
        $detalle = RemisionEntregaPrendaDetalles::find()->where(['=','id_remision', $id])->all();
        foreach ($detalle as $detalle):
            $contador = 0;
            $referencia = \app\models\Referencias::find()->where(['=','id_referencia', $detalle->id_referencia])->one();
            $contador = $referencia->total_existencias - $detalle->cantidad;
            $referencia->total_existencias = $contador;
            $referencia->save(false);
        endforeach;
    }
    
    public function actionImprimir($id) {

        return $this->render('../formatos/remisionentrega', [
                    'model' => $this->findModel($id),
        ]);
    }
    //funcion que permite exportar a excel
    
     public function actionExcelconsulta($tableexcel) {                
        $objPHPExcel = new \PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("EMPRESA")
            ->setLastModifiedBy("EMPRESA")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
     
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID')
                    ->setCellValue('B1', 'NRO REMISION')
                    ->setCellValue('C1', 'NIT/CEDULA')
                    ->setCellValue('D1', 'CLIENTE')
                    ->setCellValue('E1', 'UNIDADES')
                    ->setCellValue('F1', 'VR.TOTAL')
                    ->setCellValue('G1', 'VL. SALDO')
                    ->setCellValue('H1', 'F. ENTREGA')                    
                    ->setCellValue('I1', 'F. PROCESO')
                    ->setCellValue('J1', 'EST. REMISION')
                    ->setCellValue('K1', 'AUTORIZADO')
                    ->setCellValue('L1', 'FACTURADO')
                    ->setCellValue('M1', 'USUARIO')
                    ->setCellValue('N1', 'OBSERVACION');
        $i = 2  ;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                     ->setCellValue('A' . $i, $val->id_remision)
                    ->setCellValue('B' . $i, $val->nro_remision)
                    ->setCellValue('C' . $i, $val->cliente->cedulanit)
                    ->setCellValue('D' . $i, $val->cliente->nombrecorto)
                    ->setCellValue('E' . $i, $val->cantidad)
                    ->setCellValue('F' . $i, $val->valor_total)                    
                    ->setCellValue('G' . $i, $val->valor_pagar)
                    ->setCellValue('H' . $i, $val->fecha_entrega)
                    ->setCellValue('I' . $i, $val->fecha_registro)
                    ->setCellValue('J' . $i, $val->estadoRemision)
                    ->setCellValue('K' . $i, $val->estadoAutorizado)
                    ->setCellValue('L' . $i, $val->estadoFacturado)
                    ->setCellValue('M' . $i, $val->usuariosistema)
                     ->setCellValue('N' . $i, $val->observacion);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Remisiones');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Remision_entrega.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }
    
    protected function findModel($id)
    {
        if (($model = RemisionEntregaPrendas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
