<?php

namespace app\controllers;

use app\models\Archivodir;
use Yii;

use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
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
use app\models\FormSubirArchivo;
use yii\web\Controller;
use yii\filters\VerbFilter;


class ArchivodirController extends \yii\web\Controller
{

    public function actionIndex($codigo,$numero)
    {
        //if (!Yii::$app->user->isGuest) {



            $table = Archivodir::find();

            $count = clone $table;
            $pages = new Pagination([
                'pageSize' => 10,
                'totalCount' => $count->count(),
            ]);
            $model = $table
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        $to = $count->count();
        return $this->render('index', [
            'model' => $model,
            'codigo' => $codigo,
            'numero' => $numero,
            'pagination' => $pages,
        ]);
        /* }else{
             return $this->redirect(["site/login"]);
         }*/
    }

    public function actionSubir()
    {
        $model = new FormSubirArchivo();
        $msg = null;

        $codigo = Html::encode($_GET["codigo"]);
        $numero = Html::encode($_GET["numero"]);
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {

                $table = new Archivodir();
                if ($table) {
                    $table->descripcion = "dfdfdfdf";
                    $table->nombre = $model->imageFile->baseName.'.'.$model->imageFile->extension;
                    $table->extension = $model->imageFile->extension;
                    $table->tamaño = $model->imageFile->size;
                    $table->tipo = $model->imageFile->type;
                    $table->numero = $numero;
                    //$table->numero = $codigo;
                    $table->iddocumentodir = 2;
                    $table->iddirectorio = 1;
                    $table->insert();

                    $this->redirect(["notacredito/view",'id' => $codigo]);
                    // el archivo se subió exitosamente
                } else {
                    $msg = "El registro seleccionado no ha sido encontrado";
                }
            }
        }
        if (Yii::$app->request->get("numero")) {

            $model->codigo = $codigo;
            $model->numero = $numero;

        }

        return $this->render("Subir", ["model" => $model, "msg" => $msg]);
    }

}
