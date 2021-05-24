<?php

namespace app\controllers;

use app\models\ValorPrendaUnidad;
use app\models\ValorPrendaUnidadSearch;
use app\models\UsuarioDetalle;
use app\models\Ordenproduccion;
use app\models\ValorPrendaUnidadDetalles;
use app\models\Operarios;
use app\models\FormFiltroValorPrenda;
use app\models\FormFiltroResumePagoPrenda;
//clases
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Response;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

/**
 * ValorPrendaUnidadController implements the CRUD actions for ValorPrendaUnidad model.
 */
class ValorPrendaUnidadController extends Controller
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
     * Lists all ValorPrendaUnidad models.
     * @return mixed
     */
   public function actionIndex() {
        if (Yii::$app->user->identity) {
            if (UsuarioDetalle::find()->where(['=', 'codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=', 'id_permiso', 106])->all()) {
                $form = new FormFiltroValorPrenda();
                $idtipo = null;
                $idordenproduccion = null;
                $estado_valor = null;
                $cerrar_pago = null;
                $autorizado = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $idtipo = Html::encode($form->idtipo);
                        $idordenproduccion = Html::encode($form->idordenproduccion);
                        $estado_valor = Html::encode($form->estado_valor);
                        $cerrar_pago = Html::encode($form->cerrar_pago);
                        $autorizado = Html::encode($form->autorizado);
                        $table = ValorPrendaUnidad::find()
                                ->andFilterWhere(['=', 'idtipo', $idtipo])
                                ->andFilterWhere(['=', 'idordenproduccion', $idordenproduccion])
                                ->andFilterWhere(['=', 'estado_valor', $estado_valor])
                                ->andFilterWhere(['=', 'cerrar_pago', $cerrar_pago])
                                ->andFilterWhere(['=', 'autorizado', $autorizado]);
                        $table = $table->orderBy('id_valor DESC');
                        $tableexcel = $table->all();
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 25,
                            'totalCount' => $count->count()
                        ]);
                        $modelo = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                        if (isset($_POST['excel'])) {
                            $check = isset($_REQUEST['id_valor  DESC']);
                            $this->actionExcelconsultaValorPrenda($tableexcel);
                        }
                    } else {
                        $form->getErrors();
                    }
                } else {
                    $table = ValorPrendaUnidad::find()
                             ->orderBy('id_valor DESC');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $pages = new Pagination([
                        'pageSize' => 25,
                        'totalCount' => $count->count(),
                    ]);
                    $modelo = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if (isset($_POST['excel'])) {
                        //$table = $table->all();
                        $this->actionExcelconsultaValorPrenda($tableexcel);
                    }
                }
                $to = $count->count();
                return $this->render('index', [
                            'modelo' => $modelo,
                            'form' => $form,
                            'pagination' => $pages,
                ]);
            } else {
                return $this->redirect(['site/sinpermiso']);
            }
        } else {
            return $this->redirect(['site/login']);
        }
    }
    
   //index de consulta o pago
    public function actionIndexsoporte() {
        if (Yii::$app->user->identity) {
            if (UsuarioDetalle::find()->where(['=', 'codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=', 'id_permiso', 107])->all()) {
                $form = new FormFiltroResumePagoPrenda();
                $id_operario = null;
                $idordenproduccion = null;
                $operacion = null;
                $dia_pago = null;
                $fecha_corte = null;
                $registro = NULL;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $id_operario = Html::encode($form->id_operario);
                        $idordenproduccion = Html::encode($form->idordenproduccion);
                        $operacion = Html::encode($form->operacion);
                        $dia_pago = Html::encode($form->dia_pago);
                        $fecha_corte = Html::encode($form->fecha_corte);
                        $registro = Html::encode($form->registro_pagado);
                        $table = ValorPrendaUnidadDetalles::find()
                                ->andFilterWhere(['=', 'id_operario', $id_operario])
                                ->andFilterWhere(['=', 'idordenproduccion', $idordenproduccion])
                                ->andFilterWhere(['=', 'operacion', $operacion])
                                ->andFilterWhere(['>=', 'dia_pago', $dia_pago])
                                ->andFilterWhere(['<=', 'dia_pago', $fecha_corte])
                                ->andFilterWhere(['=', 'registro_pagado', $registro]);
                        $table = $table->orderBy('consecutivo DESC');
                        $tableexcel = $table->all();
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 120,
                            'totalCount' => $count->count()
                        ]);
                        $modelo = $table
                                ->offset($pages->offset)
                                ->limit($pages->limit)
                                ->all();
                        if (isset($_POST['excel'])) {
                            $check = isset($_REQUEST['consecutivo  DESC']);
                            $this->actionExcelResumeValorPrenda($tableexcel);
                        }
                    } else {
                        $form->getErrors();
                    }
                } else {
                    $table = ValorPrendaUnidadDetalles::find()
                             ->orderBy('consecutivo DESC');
                    $tableexcel = $table->all();
                    $count = clone $table;
                    $pages = new Pagination([
                        'pageSize' => 120,
                        'totalCount' => $count->count(),
                    ]);
                    $modelo = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                    if (isset($_POST['excel'])) {
                        //$table = $table->all();
                        $this->actionExcelResumeValorPrenda($tableexcel);
                    }
                }
                 if(isset($_POST['cerrar_abrir'])){                            
                        if(isset($_REQUEST['consecutivo'])){                            
                            $intIndice = 0;
                            foreach ($_POST["consecutivo"] as $intCodigo) {
                                if ($_POST["consecutivo"][$intIndice]) {                                
                                   $codigo = $_POST["consecutivo"][$intIndice];
                                   $this->actionCerrarAbrirRegistro($codigo);
                                }
                                $intIndice++;
                            }
                        }
                       $this->redirect(["valor-prenda-unidad/indexsoporte"]);
                 }
                $to = $count->count();
                return $this->render('indexsoporte', [
                            'modelo' => $modelo,
                            'form' => $form,
                            'pagination' => $pages,
                ]);
            } else {
                return $this->redirect(['site/sinpermiso']);
            }
        } else {
            return $this->redirect(['site/login']);
        }
    } 
    
    public function actionCerrarAbrirRegistro($codigo) {
        $detalle = ValorPrendaUnidadDetalles::findOne($codigo);
        if($detalle->registro_pagado == 0){
          $detalle->registro_pagado = 1;
        }else{
            $detalle->registro_pagado = 0;
        }  
        $detalle->save(false);
    }
   public function actionView($id)
    {
        $detalles_pago = ValorPrendaUnidadDetalles::find()->where(['=','id_valor', $id])->orderBy('consecutivo desc')->all();
        //proceso para actualizar
        if (isset($_POST["detalle_pago_prenda"])) {
            $intIndice = 0;
            foreach ($_POST["detalle_pago_prenda"] as $intCodigo) {                
                $table = ValorPrendaUnidadDetalles::findOne($intCodigo);
                $table->id_operario = $_POST["id_operario"][$intIndice];
                $table->idordenproduccion = $_POST["idordenproduccion"][$intIndice];
                $table->operacion = $_POST["operacion"][$intIndice];
                $table->dia_pago = $_POST["dia_pago"][$intIndice];
                $table->cantidad = $_POST["cantidad"][$intIndice];
                $operario = Operarios::find()->where(['=','id_operario', $_POST["id_operario"][$intIndice]])->one();
                $valor_unidad = ValorPrendaUnidad::find()->where(['=','id_valor', $id])->andWhere(['=','idordenproduccion', $_POST["idordenproduccion"][$intIndice]])->one();
                $vlr_unidad = 0;
                if($operario){
                    if($valor_unidad){
                        if($operario->vinculado == 1){
                           $vlr_unidad = $valor_unidad->vlr_vinculado;
                           if($_POST["vlr_prenda"][$intIndice] == ''){
                                $table->vlr_prenda = $vlr_unidad;
                               $table->vlr_pago = $table->vlr_prenda * $table->cantidad;
                           }else{
                                $table->vlr_prenda = $_POST["vlr_prenda"][$intIndice];
                                $table->vlr_pago = $_POST["vlr_prenda"][$intIndice] * $table->cantidad; 
                           }
                           $table->usuariosistema = Yii::$app->user->identity->username;
                           $table->observacion = 'Vinculado';
                           $table->save(false);
                           $intIndice++;
                        }else{
                           $vlr_unidad = $valor_unidad->vlr_contrato; 
                           if($_POST["vlr_prenda"][$intIndice] == ''){
                                $table->vlr_prenda = $vlr_unidad;
                               $table->vlr_pago = $table->vlr_prenda * $table->cantidad;
                           }else{
                                $table->vlr_prenda = $_POST["vlr_prenda"][$intIndice];
                                $table->vlr_pago = $_POST["vlr_prenda"][$intIndice] * $table->cantidad; 
                           }
                           $table->usuariosistema = Yii::$app->user->identity->username;
                           $table->observacion = 'No vinculado';
                           $table->save(false);
                           $intIndice++;
                        }  
                    }else{
                        Yii::$app->getSession()->setFlash('error', 'Esta orden de produccion no se la ha asignado el valor a la prenda. Favor consultar con el administrador.');
                    }    
                }
            }
            $this->Totalpagar($id);
            $this->TotalCantidades($id);
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'detalles_pago' => $detalles_pago,
        ]);
    }
    /**
     * Creates a new ValorPrendaUnidad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ValorPrendaUnidad();
        $orden = Ordenproduccion::find()->where(['=','pagada', 0])->orderBy('idordenproduccion desc')->all();  
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            $model->usuariosistema = Yii::$app->user->identity->username;
            $model->estado_valor = 0; 
            $ordenproduccion = Ordenproduccion::findOne($model->idordenproduccion);
            $model->cantidad = $ordenproduccion->cantidad;
            $model->update();
            return $this->redirect(['index', 'id' => $model->id_valor]);
        }

        return $this->render('create', [
            'model' => $model,
            'orden' => ArrayHelper::map($orden, "idordenproduccion", "idordenproduccion"),
        ]);
    }

    /**
     * Updates an existing ValorPrendaUnidad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $orden = Ordenproduccion::find()->where(['=','pagada', 0])->orderBy('idordenproduccion desc')->all();  
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->usuario_editado = Yii::$app->user->identity->username;
            $fecha = date('Y-m-d h:i:s');
            $model->fecha_editado = $fecha;
            $model->update();
            return $this->redirect(['index', 'id' => $model->id_valor]);
        }
        return $this->render('update', [
            'model' => $model,
            'orden' => ArrayHelper::map($orden, "idordenproduccion", "idordenproduccion"),
        ]);
    }

    /**
     * Deletes an existing ValorPrendaUnidad model.
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
            $this->redirect(["valor-prenda-unidad/index"]);
        } catch (IntegrityException $e) {
            $this->redirect(["valor-prenda-unidad/index"]);
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar este registro, tiene registros asociados en otros procesos');
        } catch (\Exception $e) {            
            Yii::$app->getSession()->setFlash('error', 'Error al eliminar este registro, tiene registros asociados en otros procesos');
            $this->redirect(["valor-prenda-unidad/index"]);
        }
    }

    protected function findModel($id)
    {
        if (($model = ValorPrendaUnidad::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    //PROCESOS Y SUBPROCESOS
    
     public function actionNuevodetalle($id)
    {              
        $valor_unidad = ValorPrendaUnidad::findOne($id);
        if($valor_unidad->cantidad_operacion > $valor_unidad->cantidad){
           $this->redirect(["valor-prenda-unidad/view", 'id' => $id]); 
           Yii::$app->getSession()->setFlash('error', 'No se puede generar mas lineas porque la cantidad de operaciones  '.$valor_unidad->cantidad_operacion.' es mayor que la cantidad del lote '.$valor_unidad->cantidad .'.');  
        }else{
            if($valor_unidad->cantidad_procesada > $valor_unidad->cantidad){
                $this->redirect(["valor-prenda-unidad/view", 'id' => $id]); 
                Yii::$app->getSession()->setFlash('error', 'No se puede generar mas lineas porque la cantidad de confeccion y/o Terminación '.$valor_unidad->cantidad_procesada.' es mayor o igual que la cantidad del lote '.$valor_unidad->cantidad.'.');
            }else{    
                $model = new ValorPrendaUnidadDetalles();
                $model->id_valor = $id;                
                $model->dia_pago= date('Y-m-d');
                $model->insert();
                return $this->redirect(['view', 'id' => $id]);
            }
        }
       
    }
    
    //PROCESO QUE BUSCA EL MODULO Y TRAE LAS EMPLEADOS
    
     public function actionNuevodetallemodular($id, $idordenproduccion)
    {              
       $fecha_corte = date('Y-m-d'); 
        $balanceo = \app\models\Balanceo::find()->where(['=','idordenproduccion', $idordenproduccion])->orderBy('id_balanceo desc')->all();
        if ($balanceo){
            foreach ($balanceo as $val):
                //este bloque busca las unidades confeccionadas por fecha
                $cantidad = \app\models\CantidadPrendaTerminadas::find()->where(['=','id_balanceo', $val->id_balanceo])->andWhere(['=','fecha_entrada', $fecha_corte])->all();
                if($cantidad){
                    $suma = 0; $total = 0;
                    foreach ($cantidad as $contar):
                        $suma += $contar->cantidad_terminada; 
                    endforeach;
                    $total = round($suma / $val->cantidad_empleados); 
                    //este proceso busca los operarios que estan en el modulo
                    $detalle_balanceo = \app\models\BalanceoDetalle::find()->where(['=','id_balanceo', $contar->id_balanceo])->all();
                    $operario = 0; $variable = 0;
                    if($detalle_balanceo){
                        foreach ($detalle_balanceo as $detalle):
                             $operario = $detalle->id_operario;
                              if($variable <> $detalle->id_operario){
                                 $operario = $detalle->id_operario; 
                                 $variable = $operario;
                                 $valor_prenda = new ValorPrendaUnidadDetalles();
                                 $valor_prenda->id_operario = $operario;
                                 $valor_prenda->id_valor = $id;
                                 $valor_prenda->dia_pago= $fecha_corte;
                                 $valor_prenda->idordenproduccion = $idordenproduccion;
                                 $valor_prenda->cantidad = $total; 
                                 $valor_prenda->insert();
                              }
                        endforeach;
                    }else{
                         $this->redirect(["valor-prenda-unidad/view", 'id' => $id]);
                         Yii::$app->getSession()->setFlash('error', 'La orden de produccion Nro: '. $idordenproduccion. ', no tiene asignado empleados para las operaciones.'); 
                    }    
                }else{
                   $this->redirect(["valor-prenda-unidad/view", 'id' => $id]);
                   Yii::$app->getSession()->setFlash('error', 'El modulo de balanceo Nro: '. $val->id_balanceo. ', no realizo confeccion el dia '.$fecha_corte.'. Favor hacer este proceso manual.'); 
                }    
            endforeach;
           // return $this->redirect(['view', 'id' => $id]);
        }else{
             $this->redirect(["valor-prenda-unidad/view", 'id' => $id]);
             Yii::$app->getSession()->setFlash('error', 'La orden de produccion Nro: '. $idordenproduccion. ', no tiene balanceo creado en sistema.!');
        }
       // return $this->redirect(['view', 'id' => $id]);
    }
   
    public function actionEliminar($id,$detalle)
    {                                
        $detalle = ValorPrendaUnidadDetalles::findOne($detalle);
        $detalle->delete();
        $this->Totalpagar($id);
        $this->TotalCantidades($id);
        $this->redirect(["view",'id' => $id]);        
    }
    
    protected function Totalpagar($id) {
        $valor = ValorPrendaUnidad::findOne($id);
        $detalle = ValorPrendaUnidadDetalles::find()->where(['=','id_valor', $id])->all();
        $suma=0; 
        $ajuste = 0;
        $operacion = 0;
        foreach ($detalle as $val):
            if($val->operacion == 0){
               $suma += $val->vlr_pago;
            }else{
                if($val->operacion == 1){
                    $operacion += $val->vlr_pago;
                }else{
                    $ajuste += $val->vlr_pago;
                }
            }   
        endforeach;
        $valor->total_confeccion = $suma;
        $valor->total_operacion = $operacion;
        $valor->total_ajuste = $ajuste;
        $valor->total_pagar = $suma + $operacion + $ajuste;
        $valor->save(false);
    }
    //actualiza las cantidades
    protected function TotalCantidades($id) {
        $valor = ValorPrendaUnidad::findOne($id);
        $detalle = ValorPrendaUnidadDetalles::find()->where(['=','id_valor', $id])->all();
        $suma=0; $operacion = 0;
            foreach ($detalle as $val):
                if($val->operacion == 0){
                   $suma += $val->cantidad;
                }else{
                    if(($val->operacion == 1)){
                       $operacion += $val->cantidad; 
                    }
                }
            endforeach;
            $valor->cantidad_procesada = $suma;
            $valor->cantidad_operacion = $operacion;
            $valor->save(false);
        if($valor->cantidad_procesada > $valor->cantidad  || $valor->cantidad_operacion > $valor->cantidad){
                Yii::$app->getSession()->setFlash('error', 'La cantidad y/o operacion procesada es mayor que las unidades entradas en la orden Nro: '. $valor->idordenproduccion. '.');
        } 
       
    }
    
    public function actionAutorizado($id) {
        $model = $this->findModel($id);
        $mensaje = "";
        if($model->cantidad_procesada > $model->cantidad  || $model->cantidad_operacion > $model->cantidad){
            $this->redirect(["valor-prenda-unidad/view", 'id' => $id]);
             Yii::$app->getSession()->setFlash('error', 'La cantidad y/o operacion procesada es mayor que las unidades entradas en la orden Nro: '. $model->idordenproduccion. '.');
        }else{  
            if ($model->autorizado == 0) {                        
                $model->autorizado = 1;            
               $model->update();
               $this->redirect(["valor-prenda-unidad/view", 'id' => $id]);  

            } else{
                $model->autorizado = 0;
                $model->update();
                $this->redirect(["valor-prenda-unidad/view", 'id' => $id]); 
            }
        }    
    }
    
    public function actionCerrarpago($id, $idordenproduccion) {
           $model = $this->findModel($id);
           $orden = Ordenproduccion::findOne($idordenproduccion);
           $model->cerrar_pago =  1;
           $model->estado_valor = 1;
           $model->save(false);
           $this->redirect(["valor-prenda-unidad/view", 'id' => $id]);
    }
    //cerrar el pago y la orden de produccion
    
    public function actionCerrarpagoorden($id, $idordenproduccion) {
           $model = $this->findModel($id);
           $orden = Ordenproduccion::findOne($idordenproduccion);
           $model->cerrar_pago = 1;
           $model->estado_valor = 1;
           $model->save(false);
           $orden->pagada = 1;
           $orden->save(false);
           $this->redirect(["valor-prenda-unidad/view", 'id' => $id]);
    }
    
   
    
    public function actionGenerarexcel($id) {        
        $ficha = ValorPrendaUnidad::findOne($id);
        $model = ValorPrendaUnidadDetalles::find()->where(['=','id_valor',$id])->orderBy([ 'id_operario' =>SORT_ASC ])->all();
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
        $objPHPExcel->getActiveSheet()->getStyle('2')->getFont()->setBold(true);        
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
        $objPHPExcel->getActiveSheet()->mergeCells("a".(1).":l".(1));
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PAGO DE OPERACIONES')
                    ->setCellValue('A2', 'ORDEN')
                    ->setCellValue('B2', 'DOCUMENTO')
                    ->setCellValue('C2', 'OPERARIO(A)')
                    ->setCellValue('D2', 'OPERACION')
                    ->setCellValue('E2', 'DIA PAGO')
                    ->setCellValue('F2', 'CANTIDAD')
                    ->setCellValue('G2', 'VR. PRENDA')
                    ->setCellValue('H2', 'VR. PAGO')
                    ->setCellValue('I2', 'USUARIO')
                    ->setCellValue('J2', 'OBSERVACION');
                  
        $i = 3;
        $confeccion = 'CONFECCION';
        $operaciones = 'OPERACIONES';
        $ajuste = 'AJUSTE';
        foreach ($model as $val) {                            
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $ficha->idordenproduccion)
                    ->setCellValue('B' . $i, $val->operario->documento)
                    ->setCellValue('C' . $i, $val->operario->nombrecompleto);
                    if($val->operacion == 1){
                         $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue('D' . $i, $confeccion);
                    }else{
                        if($val->operacion == 2){
                             $objPHPExcel->setActiveSheetIndex(0)
                             ->setCellValue('D' . $i, $operaciones);
                        }else{
                             $objPHPExcel->setActiveSheetIndex(0)
                             ->setCellValue('D' . $i, $ajuste);
                        }
                    } 
                     $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('E' . $i, $val->dia_pago)
                    ->setCellValue('F' . $i, $val->cantidad)
                    ->setCellValue('G' . $i, $val->vlr_prenda)
                    ->setCellValue('H' . $i, $val->vlr_pago)
                    ->setCellValue('I' . $i, $val->usuariosistema)
                    ->setCellValue('J' . $i, $val->observacion);
              
                   
            $i++;                        
        }
        //promedio por dia
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("           
           SELECT SUM(valor_prenda_unidad_detalles.vlr_pago) AS Total, valor_prenda_unidad_detalles.id_operario FROM valor_prenda_unidad_detalles WHERE id_valor = ".$id."  GROUP BY id_operario");
        $result = $command->queryAll();
        $i = 3;
       /* foreach ($result as $promedio){
            $objPHPExcel->setActiveSheetIndex(0)
                     ->setCellValue('K' . $i, $promedio['Total'])
                     ->setCellValue('L' . $i, $promedio['id_operario']);   
            $i++;            
        }*/
        //fin promedio por dia

        $objPHPExcel->getActiveSheet()->setTitle('Total_pago_prendas');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename="Total_pago_prendas.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0 
        header("Content-Transfer-Encoding: binary ");
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);        
        $objWriter->save('php://output');
        //$objWriter->save($pFilename = 'Descargas');
        exit; 
        
    }
    
    public function actionExcelResumeValorPrenda($tableexcel) {                
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
  
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID')
                    ->setCellValue('B1', 'ORD. PRODUCCION')
                    ->setCellValue('C1', 'OPERARIO')
                    ->setCellValue('D1', 'OPERACION')
                    ->setCellValue('E1', 'FECHA PROCESO')                    
                    ->setCellValue('F1', 'CANT.')
                    ->setCellValue('G1', 'VR. PRENDA')
                    ->setCellValue('H1', 'TOTAL PAGADO')
                    ->setCellValue('I1', 'USUARIO')
                    ->setCellValue('J1', 'ESTADO_REGISTRO')
                    ->setCellValue('K1', 'OBSERVACION');
                   
        $i = 2;
        $confeccion = 'CONFECCION';
        $operaciones = 'OPERACIONES';
        $ajuste = 'AJUSTE';
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->consecutivo)
                    ->setCellValue('B' . $i, $val->idordenproduccion)
                    ->setCellValue('C' . $i, $val->operario->nombrecompleto);
                        if($val->operacion == 1){
                             $objPHPExcel->setActiveSheetIndex(0)
                          ->setCellValue('D' . $i, $confeccion);
                        }else{
                            if($val->operacion == 2){
                                 $objPHPExcel->setActiveSheetIndex(0)
                                 ->setCellValue('D' . $i, $operaciones);
                            }else{
                                 $objPHPExcel->setActiveSheetIndex(0)
                                 ->setCellValue('D' . $i, $ajuste);
                            }
                        } 
                     $objPHPExcel->setActiveSheetIndex(0)                    
                    ->setCellValue('E' . $i, $val->dia_pago)
                    ->setCellValue('F' . $i, $val->cantidad)  
                    ->setCellValue('G' . $i, $val->vlr_prenda)
                    ->setCellValue('H' . $i, $val->vlr_pago)
                    ->setCellValue('I' . $i, $val->usuariosistema)
                    ->setCellValue('J' . $i, $val->registroPagado)
                    ->setCellValue('K' . $i, $val->observacion);
                  
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Resumen pago');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Resumen_pago.xlsx"');
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
    
     public function actionExcelconsultaValorPrenda($tableexcel) {                
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ID')
                    ->setCellValue('B1', 'ORDEN PROD.')
                    ->setCellValue('C1', 'CLIENTE')
                    ->setCellValue('D1', 'SERVICIO')
                    ->setCellValue('E1', 'VR. VINCULADO')                    
                    ->setCellValue('F1', 'VR. CONTRATO')
                    ->setCellValue('G1', 'TOTAL CONFECCION')
                    ->setCellValue('H1', 'CANT. PROCESADA')
                    ->setCellValue('I1', 'TOTAL AJUSTE')
                    ->setCellValue('J1', 'TOTAL OPERACION')
                    ->setCellValue('K1', 'CANT. OPERACION')
                    ->setCellValue('L1', 'TOTAL PAGAR')
                    ->setCellValue('M1', 'CANTIDAD') 
                    ->setCellValue('N1', 'AUTORIZADO')
                    ->setCellValue('O1', 'CERRADO')
                    ->setCellValue('P1', 'ACTIVO')
                    ->setCellValue('Q1', 'USUARIO CREADOR')
                    ->setCellValue('R1', 'F. PROCESO')
                    ->setCellValue('S1', 'USUARIO EDITADO')
                    ->setCellValue('T1', 'F. EDITADO');;
        $i = 2;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $val->id_valor)
                    ->setCellValue('B' . $i, $val->idordenproduccion)
                    ->setCellValue('C' . $i, $val->ordenproduccion->cliente->nombrecorto)
                    ->setCellValue('D' . $i, $val->tipo->tipo)                    
                    ->setCellValue('E' . $i, $val->vlr_vinculado)
                    ->setCellValue('F' . $i, $val->vlr_contrato)  
                    ->setCellValue('G' . $i, $val->total_confeccion)
                    ->setCellValue('H' . $i, $val->cantidad_procesada)
                    ->setCellValue('I' . $i, $val->total_ajuste)
                    ->setCellValue('J' . $i, $val->total_operacion)
                    ->setCellValue('K' . $i, $val->cantidad_operacion)
                    ->setCellValue('L' . $i, $val->total_pagar)
                    ->setCellValue('M' . $i, $val->cantidad)
                    ->setCellValue('N' . $i, $val->autorizadoPago)
                    ->setCellValue('O' . $i, $val->cerradoPago)
                    ->setCellValue('P' . $i, $val->estadovalor)
                    ->setCellValue('Q' . $i, $val->usuariosistema)
                    ->setCellValue('R' . $i, $val->fecha_proceso)
                    ->setCellValue('S' . $i, $val->usuario_editado)
                    ->setCellValue('T' . $i, $val->fecha_editado);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Valor_prenda');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="valor_prendas.xlsx"');
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
}
