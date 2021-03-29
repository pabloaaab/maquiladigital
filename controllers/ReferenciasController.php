<?php

namespace app\controllers;


use app\models\Referencias;
use app\models\ReferenciasSearch;
use app\models\UsuarioDetalle;
use app\models\FormFiltroReferencias;
use app\models\CostoProducto;

//clases
use Codeception\Module\Cli;
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

/**
 * ReferenciasController implements the CRUD actions for Referencias model.
 */
class ReferenciasController extends Controller
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
     * Lists all Referencias models.
     * @return mixed
     */
     public function actionIndex() {
        if (Yii::$app->user->identity){
            if (UsuarioDetalle::find()->where(['=','codusuario', Yii::$app->user->identity->codusuario])->andWhere(['=','id_permiso',104])->all()){
                $form = new FormFiltroReferencias();
                $codigo_producto = null;
                $id_proveedor = null;
                $fecha_creacion = null;
                $descripcion = null;
                $bodega = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {                        
                        $codigo_producto = Html::encode($form->codigo_producto);
                        $id_proveedor = Html::encode($form->idproveedor);
                        $fecha_creacion = Html::encode($form->fecha_creacion);
                        $descripcion = Html::encode($form->descripcion);
                        $bodega = Html::encode($form->id_bodega);
                        $table = Referencias::find()
                                ->andFilterWhere(['=', 'codigo_producto', $codigo_producto])
                                ->andFilterWhere(['=', 'idproveedor', $id_proveedor])
                                ->andFilterWhere(['>=', 'fecha_creacion', $fecha_creacion])   
                                ->andFilterWhere(['like','descripcion', $descripcion])
                                ->andFilterWhere(['=','id_bodega', $bodega]);
                       $table = $table->orderBy('id_referencia DESC');
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
                                $check = isset($_REQUEST['id_referencia DESC']);
                                $this->actionExcelconsulta($tableexcel);
                            }
                } else {
                        $form->getErrors();
                }                    
            } else {
                $table = Referencias::find()
                        ->orderBy('id_referencia DESC');
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
     * Displays a single Referencias model.
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
     * Creates a new Referencias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNuevareferencia()
    {
        $model = new Referencias();
        $producto = CostoProducto::find()->where(['=','autorizado', 1])->orderBy('descripcion ASC')->all();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {           
            if ($model->validate()) {
                $costo = CostoProducto::findOne($model->id_producto);
                $suma = 0; $suma2 = 0; $suma3 = 0; $suma4 = 0;
                $table = new Referencias();
                $table->id_producto = $model->id_producto;
                $table->codigo_producto = $costo->codigo_producto;
                $table->descripcion = $costo->descripcion;
                $table->existencias = $model->existencias;
                $table->precio_costo = $costo->costo_con_iva;
                $table->porcentaje_mayorista = $model->porcentaje_mayorista;
                $table->porcentaje_deptal = $model->porcentaje_deptal;
                $table->precio_venta_mayorista = round(($table->precio_costo * $table->porcentaje_mayorista)/100)+ $table->precio_costo;
                $table->precio_venta_deptal = round(($table->precio_costo * $table->porcentaje_deptal)/100)+ $table->precio_costo;
                $table->estado_existencia = 1;
                $fechaActual = date('Y-m-d');
                $table->fecha_creacion = $fechaActual;
                $table->usuariosistema = Yii::$app->user->identity->username;
                $table->idproveedor = $model->idproveedor; 
                $table->id_bodega = $model->id_bodega; 
                $table->t2 = Html::encode($_POST["t2"]);
                $table->t4 = Html::encode($_POST["t4"]);
                $table->t6 = Html::encode($_POST["t6"]);
                $table->t8 = Html::encode($_POST["t8"]);
                $table->t10 = Html::encode($_POST["t10"]);
                $table->t12 = Html::encode($_POST["t12"]);
                $table->t14 = Html::encode($_POST["t14"]);
                $table->t16 = Html::encode($_POST["t16"]);
                $table->t18 = Html::encode($_POST["t18"]);
                $table->t20 = Html::encode($_POST["t20"]);
                $table->t22 = Html::encode($_POST["t22"]);
                $table->t24 = Html::encode($_POST["t24"]);
                $table->t26 = Html::encode($_POST["t26"]);
                $table->t28 = Html::encode($_POST["t28"]);
                $table->t30 = Html::encode($_POST["t30"]);
                $table->t32 = Html::encode($_POST["t32"]);
                $table->t34 = Html::encode($_POST["t34"]);
                $table->t36 = Html::encode($_POST["t36"]);
                $table->t38 = Html::encode($_POST["t38"]);
                $table->t40 = Html::encode($_POST["t40"]);
                $table->t42 = Html::encode($_POST["t42"]);
                $table->t44 = Html::encode($_POST["t44"]);
                $table->xs = Html::encode($_POST["txs"]);
                $table->s = Html::encode($_POST["ts"]);
                $table->m = Html::encode($_POST["tm"]);
                $table->l = Html::encode($_POST["tl"]);
                $table->xl = Html::encode($_POST["txl"]);
                $table->xxl = Html::encode($_POST["txxl"]);
                $table->t_unica = Html::encode($_POST["t_unica"]);
                $total = 0;
                $suma = Html::encode($_POST["t2"])+ Html::encode($_POST["t4"])+ Html::encode($_POST["t6"])+ Html::encode($_POST["t8"])+ Html::encode($_POST["t10"])+ Html::encode($_POST["t12"]); 
                $suma2 = Html::encode($_POST["t12"])+ Html::encode($_POST["t16"])+ Html::encode($_POST["t18"])+ Html::encode($_POST["t20"])+ Html::encode($_POST["t22"])+ Html::encode($_POST["t24"])+ Html::encode($_POST["t26"]);
                $suma3 = Html::encode($_POST["t28"])+ Html::encode($_POST["t30"])+Html::encode($_POST["t32"])+ Html::encode($_POST["t34"])+ Html::encode($_POST["t36"])+ Html::encode($_POST["t38"])+ Html::encode($_POST["t40"]);
                $suma4 = Html::encode($_POST["t42"])+ Html::encode($_POST["t44"])+ Html::encode($_POST["txs"])+Html::encode($_POST["ts"])+Html::encode($_POST["tm"])+Html::encode($_POST["tl"])+Html::encode($_POST["txl"])+ Html::encode($_POST["txxl"] +Html::encode($_POST["t_unica"]));
                $total = $suma + $suma2 + $suma3 + $suma4;
                if($total == $model->existencias){
                     $table->total_existencias = $total;
                    if ($table->insert()) {
                        $this->redirect(["referencias/index"]);
                    } else {
                        $msg = "error";
                    }
                }else{
                    Yii::$app->getSession()->setFlash('error', 'Las existencias no coincide con las tallas.');
                }    
          }else{
                $model->getErrors();
            }
        }    
        return $this->render('create', [
            'model' => $model,
            'producto' => ArrayHelper::map($producto, "id_producto", "productos"),
            
        ]);
    }

    //CODIGO QUE AUTORIZA EL PRODUCTO
    public function actionAutorizado($id) {
        
       $model = $this->findModel($id);
        if($model->autorizado == 0){
            $model->autorizado = 1;
            $model->save(false);
             return $this->redirect(['view', 'id' => $id]); 
        }else{
            $model->autorizado = 0;
            $model->save(false);
             return $this->redirect(['view', 'id' => $id]); 
        }
        
    }
    
    
    
    public function actionUpdate($id)
    {
        $model = Referencias::findOne($id);
        $msg = '';
        $producto = CostoProducto::find()->where(['=','autorizado', 1])->orderBy('descripcion ASC')->all();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {  
            if($model->validate()){
                $model->id_producto = $model->id_producto ;
                $model->existencias = $model->existencias ;
                $model->porcentaje_mayorista = $model->porcentaje_mayorista;
                $model->porcentaje_deptal =   $model->porcentaje_deptal ;
                $model->precio_venta_mayorista = round(($model->precio_costo * $model->porcentaje_mayorista)/100)+ $model->precio_costo;
                $model->precio_venta_deptal = round(($model->precio_costo * $model->porcentaje_deptal)/100)+ $model->precio_costo;
                $model->idproveedor =  $model->idproveedor; 
                $model->id_bodega = $model  ->id_bodega; 
                $model->t2 = Html::encode($_POST["t2"]);
                $model->t4 = Html::encode($_POST["t4"]);
                $model->t6 = Html::encode($_POST["t6"]);
                $model->t8 = Html::encode($_POST["t8"]);
                $model->t10 = Html::encode($_POST["t10"]);
                $model->t12 = Html::encode($_POST["t12"]);
                $model->t14 = Html::encode($_POST["t14"]);
                $model->t16 = Html::encode($_POST["t16"]);
                $model->t18 = Html::encode($_POST["t18"]);
                $model->t20 = Html::encode($_POST["t20"]);
                $model->t22 = Html::encode($_POST["t22"]);
                $model->t24 = Html::encode($_POST["t24"]);
                $model->t26 = Html::encode($_POST["t26"]);
                $model->t28 = Html::encode($_POST["t28"]);
                $model->t30 = Html::encode($_POST["t30"]);
                $model->t32 = Html::encode($_POST["t32"]);
                $model->t34 = Html::encode($_POST["t34"]);
                $model->t36 = Html::encode($_POST["t36"]);
                $model->t38 = Html::encode($_POST["t38"]);
                $model->t40 = Html::encode($_POST["t40"]);
                $model->t42 = Html::encode($_POST["t42"]);
                $model->t44 = Html::encode($_POST["t44"]);
                $model->xs = Html::encode($_POST["txs"]);
                $model->s = Html::encode($_POST["ts"]);
                $model->m = Html::encode($_POST["tm"]);
                $model->l = Html::encode($_POST["tl"]);
                $model->xl = Html::encode($_POST["txl"]);
                $model->xxl = Html::encode($_POST["txxl"]);
                $model->t_unica = Html::encode($_POST["t_unica"]);
                $total = 0; $suma = 0; $suma2 = 0; $suma3 = 0; $suma4 = 0;
                $suma = Html::encode($_POST["t2"])+ Html::encode($_POST["t4"])+ Html::encode($_POST["t6"])+ Html::encode($_POST["t8"])+ Html::encode($_POST["t10"])+ Html::encode($_POST["t12"]); 
                $suma2 = Html::encode($_POST["t12"])+ Html::encode($_POST["t16"])+ Html::encode($_POST["t18"])+ Html::encode($_POST["t20"])+ Html::encode($_POST["t22"])+ Html::encode($_POST["t24"])+ Html::encode($_POST["t26"]);
                $suma3 = Html::encode($_POST["t28"])+ Html::encode($_POST["t30"])+Html::encode($_POST["t32"])+ Html::encode($_POST["t34"])+ Html::encode($_POST["t36"])+ Html::encode($_POST["t38"])+ Html::encode($_POST["t40"]);
                $suma4 = Html::encode($_POST["t42"])+ Html::encode($_POST["t44"])+ Html::encode($_POST["txs"])+Html::encode($_POST["ts"])+Html::encode($_POST["tm"])+Html::encode($_POST["tl"])+Html::encode($_POST["txl"])+ Html::encode($_POST["txxl"]) +Html::encode($_POST["t_unica"]);
                $total = $suma + $suma2 + $suma3 + $suma4;
                if($total == $model->existencias){
                    $model->total_existencias = $total;
                    $model->save(false);
                   $this->redirect(["referencias/index"]);
                }else{
                    Yii::$app->getSession()->setFlash('error', 'Las existencias no coincide con las tallas.');
                }    
            }else{
                $model->getErrors();
            }
        }
        if (Yii::$app->request->get("id")) {
             $table = Referencias::findOne($id);  
             if($table->autorizado == 1){
                 Yii::$app->getSession()->setFlash('error', 'Esta referencia no se puede modificar porque ya esta autorizada.!');
                  return $this->redirect(['index']);
             }else{
                if($table){
                    $model->id_producto = $table->id_producto;
                    $model->codigo_producto = $table->codigo_producto;
                    $model->existencias =  $table->existencias;
                    $model->porcentaje_mayorista = $table->porcentaje_mayorista;
                    $model->porcentaje_deptal = $table->porcentaje_deptal;
                    $model->idproveedor = $table->idproveedor;
                    $model->id_bodega = $table->id_bodega;
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
                    $model->xl  = $table->xl;
                    $model->xxl  = $table->xxl;
                    $model->t_unica  = $table->t_unica;

                }else{
                    return $this->redirect(['index']);
                }
             }   
        }else{
             return $this->redirect(['index']);    
        }

        return $this->render('update', [
            'model' => $model,
            'producto' => ArrayHelper::map($producto, "id_producto", "productos"),
        ]);
    }

    /**
     * Deletes an existing Referencias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEliminar($id) {
        if (Yii::$app->request->post()) {
            $referencia = Referencias::findOne($id);
            if ((int) $id) {
                if ($referencia->autorizado == 1){
                   Yii::$app->getSession()->setFlash('error', 'La referencia no se puede anular porque esta autorizada para facturación.'); 
                   $this->redirect(["referencias/index"]);
               }else{
                    try {

                        Referencias::deleteAll("id_referencia=:id_referencia", [":id_referencia" => $id]);
                        Yii::$app->getSession()->setFlash('success', 'Registro Eliminado con exito.');
                        $this->redirect(["referencias/index"]);
                    } catch (IntegrityException $e) {
                        $this->redirect(["referencias/index"]);
                        Yii::$app->getSession()->setFlash('error', 'Error al eliminar la referencia Nro: ' . $referencia->codigo_producto . ', tiene registros asociados en otros procesos');
                    } catch (\Exception $e) {

                        $this->redirect(["referencias/index"]);
                        Yii::$app->getSession()->setFlash('error', 'Error al eliminar la referencia Nro: ' . $referencia->codigo_producto . ', tiene registros asociados en otros procesos');
                    }
               }
            } else {
                // echo "Ha ocurrido un error al eliminar el registros, redireccionando ...";
                echo "<meta http-equiv='refresh' content='3; " . Url::toRoute("referencias/index") . "'>";
            }
                
            
        } else {
            return $this->redirect(["referencias/index"]);
        }
    }

    //codigo que exporta las referencias
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setAutoSize(true); 
         $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setAutoSize(true);
        $objPHPExcel->setActiveSheetIndex(0)
                     ->setCellValue('A1', 'ID_REF.')
                    ->setCellValue('B1', 'ID_PROD.')
                    ->setCellValue('C1', 'CODIGO')
                    ->setCellValue('D1', 'REFERENCIA')
                    ->setCellValue('E1', 'BODEGA')
                    ->setCellValue('F1', 'EXIST.')
                    ->setCellValue('G1', 'T_EXISTENCIA')                    
                    ->setCellValue('H1', 'COSTO_PROD.')
                    ->setCellValue('I1', '% DEPTAL')
                    ->setCellValue('J1', '% MAYORISTA')
                    ->setCellValue('K1', 'PRECIO DEPTAL')
                    ->setCellValue('L1', 'PRECIO MAYORISTA')
                    ->setCellValue('M1', 'AUTORIZADO')
                    ->setCellValue('N1', 'FECHA CREACION')
                    ->setCellValue('O1', 'USUARIO')
                    ->setCellValue('P1', 'T 2')
                    ->setCellValue('Q1', 'T 4')
                    ->setCellValue('R1', 'T 6')
                    ->setCellValue('S1', 'T 8')
                    ->setCellValue('T1', 'T 10')
                    ->setCellValue('U1', 'T 12')
                    ->setCellValue('V1', 'T 14')
                    ->setCellValue('W1', 'T 16')
                    ->setCellValue('X1', 'T 18')
                    ->setCellValue('Y1', 'T 20')
                    ->setCellValue('Z1', 'T 22')
                    ->setCellValue('AA1', 'T 24')
                    ->setCellValue('AB1', 'T 26')
                    ->setCellValue('AC1', 'T 28')
                    ->setCellValue('AD1', 'T 30')
                    ->setCellValue('AE1', 'T 32')
                    ->setCellValue('AF1', 'T 34')
                    ->setCellValue('AG1', 'T 36')
                    ->setCellValue('AH1', 'T 38')
                    ->setCellValue('AI1', 'T 40')
                    ->setCellValue('AJ1', 'T 42')
                    ->setCellValue('AK1', 'T 44')
                    ->setCellValue('AL1', 'T XS')
                    ->setCellValue('AM1', 'T S')
                    ->setCellValue('AN1', 'T M')
                    ->setCellValue('AO1', 'T L')
                    ->setCellValue('AP1', 'T XL')
                    ->setCellValue('AQ1', 'PROVEEDOR');
        $i = 2  ;
        
        foreach ($tableexcel as $val) {
                                  
            $objPHPExcel->setActiveSheetIndex(0)
                     ->setCellValue('A' . $i, $val->id_referencia)
                    ->setCellValue('B' . $i, $val->id_producto)
                    ->setCellValue('C' . $i, $val->codigo_producto)
                    ->setCellValue('D' . $i, $val->descripcion)
                    ->setCellValue('E' . $i, $val->bodega->descripcion)
                    ->setCellValue('F' . $i, $val->existencias)                    
                    ->setCellValue('G' . $i, $val->total_existencias)
                    ->setCellValue('H' . $i, $val->precio_costo)
                    ->setCellValue('I' . $i, $val->porcentaje_deptal)
                    ->setCellValue('J' . $i, $val->porcentaje_mayorista)
                    ->setCellValue('K' . $i, $val->precio_venta_deptal)
                    ->setCellValue('L' . $i, $val->precio_venta_mayorista)
                    ->setCellValue('M' . $i, $val->autorizado)
                    ->setCellValue('N' . $i, $val->fecha_creacion)
                    ->setCellValue('O' . $i, $val->usuariosistema)
                    ->setCellValue('P' . $i, $val->t2)
                    ->setCellValue('Q' . $i, $val->t4)
                    ->setCellValue('R' . $i, $val->t6)
                    ->setCellValue('S' . $i, $val->t8)
                    ->setCellValue('T' . $i, $val->t10)
                    ->setCellValue('U' . $i, $val->t12)
                    ->setCellValue('V' . $i, $val->t14)
                    ->setCellValue('W' . $i, $val->t16)
                    ->setCellValue('X' . $i, $val->t18)
                    ->setCellValue('Y' . $i, $val->t20)
                    ->setCellValue('Z' . $i, $val->t22)
                    ->setCellValue('AA' . $i, $val->t24)
                    ->setCellValue('AB' . $i, $val->t26)
                    ->setCellValue('AC' . $i, $val->t28)
                    ->setCellValue('AD' . $i, $val->t30)
                    ->setCellValue('AE' . $i, $val->t32)
                    ->setCellValue('AF' . $i, $val->t34)
                    ->setCellValue('AG' . $i, $val->t36)
                    ->setCellValue('AH' . $i, $val->t38)
                    ->setCellValue('AI' . $i, $val->t40)
                    ->setCellValue('AJ' . $i, $val->t42)
                    ->setCellValue('AK' . $i, $val->t44)
                    ->setCellValue('AL' . $i, $val->xs)
                    ->setCellValue('AM' . $i, $val->s)
                    ->setCellValue('AN' . $i, $val->m)
                    ->setCellValue('AO' . $i, $val->l)
                    ->setCellValue('AP' . $i, $val->xl)
                    ->setCellValue('AQ' . $i, $val->proveedor->nombrecorto);
            $i++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Referencias');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Referencias.xlsx"');
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
        if (($model = Referencias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
