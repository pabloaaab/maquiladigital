<?php

namespace app\controllers;

use Yii;
use app\models\CostoLaboral;
use app\models\CostoLaboralDetalle;
use app\models\CostoLaboralSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CostoLaboralController implements the CRUD actions for CostoLaboral model.
 */
class CostoLaboralController extends Controller
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

    public function actionCostolaboraldetalle($id) {
        $costolaboral = CostoLaboral::findOne($id);
        $costolaboraldetalle = CostoLaboralDetalle::find()->where(['=', 'id_costo_laboral', $id])->all();
        
        if (isset($_POST["nroempleados"])) {
            $intIndice = 0;
            foreach ($_POST["id_carta_laboral_detalle"] as $intCodigo) {
                if ($_POST["nroempleados"][$intIndice] > 0) {
                    $table = CostoLaboralDetalle::findOne($intCodigo);
                    
                    /*$table->cantidad = $_POST["cantidad"][$intIndice];
                    $table->vlrprecio = $_POST["vlrprecio"][$intIndice];*/

                    
                }
                $intIndice++;
            }
            
        }
        return $this->render('costolaboraldetalle', [
                    'costolaboral' => $costolaboral,
                    'costolaboraldetalle' => $costolaboraldetalle,
        ]);
    }
}
