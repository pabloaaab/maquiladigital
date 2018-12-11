<?php

namespace app\controllers;

use app\models\Ordenproduccion;
use app\models\Ordenproducciontipo;
use app\models\CostoProduccionDiaria;
use app\models\FormGenerarCostoProduccionDiaria;
use Codeception\Lib\HelperModule;
use yii;
use yii\base\Model;
use yii\web\Controller;
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

class CostoProduccionDiariaController extends Controller {

    public function actionCostodiario() {
        //if (!Yii::$app->user->isGuest) {
        $ordenesproduccion = Ordenproduccion::find()->Where(['=', 'autorizado', 1])->andWhere(['=', 'facturado', 0])->all();
        $form = new FormGenerarCostoProduccionDiaria;
        $operarias = null;
        $horaslaboradas = null;
        $minutoshora = null;
        $idordenproduccion = null;
        if ($form->load(Yii::$app->request->get())) {
            if ($form->validate()) {
                $operarias = Html::encode($form->operarias);
                $horaslaboradas = Html::encode($form->horaslaboradas);
                $minutoshora = Html::encode($form->minutoshora);
                $idordenproduccion = Html::encode($form->idordenproduccion);
                if ($idordenproduccion){
                    if($operarias > 0 && $horaslaboradas > 0){
                        $ordenproduccion = Ordenproduccion::findOne($idordenproduccion);
                        if ($ordenproduccion->cantidad > 0){
                            if($ordenproduccion->segundosficha > 0){
                                $costolaboralhora = \app\models\CostoLaboralHora::findOne(1);                        
                                $costodiario = CostoProduccionDiaria::findOne(1);
                                $costodiario->idcliente = $ordenproduccion->idcliente;
                                $costodiario->idordenproduccion = $ordenproduccion->idordenproduccion;
                                $costodiario->cantidad = $ordenproduccion->cantidad;
                                $costodiario->ordenproduccion = $ordenproduccion->ordenproduccion;
                                $costodiario->ordenproduccionext = $ordenproduccion->ordenproduccionext;
                                $costodiario->idtipo = $ordenproduccion->idtipo;
                                $costodiario->cantidad_x_hora = round($minutoshora / ($ordenproduccion->segundosficha / 60),2);
                                $costodiario->cantidad_diaria = round(($costodiario->cantidad_x_hora * $horaslaboradas) * $operarias,2);
                                $costodiario->tiempo_entrega_dias = round($costodiario->cantidad / $costodiario->cantidad_diaria,2);
                                $costodiario->nro_horas = round($horaslaboradas * $costodiario->tiempo_entrega_dias,2);
                                $costodiario->dias_entrega = round($costodiario->nro_horas / 8,2);
                                $costodiario->costo_muestra_operaria = round($ordenproduccion->segundosficha / 60 * $costolaboralhora->valor_minuto,2);
                                $costodiario->costo_x_hora = round($costodiario->costo_muestra_operaria * $costodiario->cantidad_x_hora,2);
                                $costodiario->update();
                                $table = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',1])->all();                        
                                $model = $table;
                            }else{
                                Yii::$app->getSession()->setFlash('error', 'La orden de produccion no tiene procesos generados en la ficha de operaciones');                        
                                $model = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all();
                            }                            
                        } else{
                               Yii::$app->getSession()->setFlash('error', 'La cantidad de la orden de produccion debe ser mayor a cero');                        
                               $model = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all(); 
                        }
                                                        
                    }else{
                        Yii::$app->getSession()->setFlash('error', 'La cantidad de operarias y/o horas laboradas, no pueden ser 0 (cero)');                        
                        $model = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all();
                    }
                    
                }else{
                    Yii::$app->getSession()->setFlash('error', 'No se tiene el valor de la orden de producción para generar el informe');
                    $model = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all();
                }                
            } else {
                $form->getErrors();
            }
        } else {
            $table = CostoProduccionDiaria::find()->where(['=','id_costo_produccion_diaria',0])->all();            
            $model = $table;            
        }        
        return $this->render('costodiario', [
                    'model' => $model,
                    'form' => $form,
                    //'pagination' => $pages,
                    'ordenesproduccion' => ArrayHelper::map($ordenesproduccion, "idordenproduccion", "ordenProduccion"),
        ]);
        /* }else{
          return $this->redirect(["site/login"]);
          } */
    }           

}
