<?php

namespace app\controllers;

use app\models\Archivodir;
use app\models\Directorio;
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

    public function actionDescargar($id,$numero,$codigo)
    {

            $archivo = Archivodir::findOne($id);
            $directorio = Directorio::findOne($archivo->iddirectorio);
            var_dump($id,'dsdsdsd');
            if (!$this->downloadFile('Documentos/', $archivo->nombre, ["pdf", "txt", "docx","xlsx","jpg","png"]))
            {
                //Mensaje flash para mostrar el error
                Yii::$app->getSession()->setFlash('error', 'Error en la descarga.');

                //$this->redirect(["archivodir/index",'codigo' => $codigo,'numero' => $numero]);
            }


        return $this->render('index', [
            'codigo' => $codigo,
            'numero' => $numero,
        ]);
    }

    private function downloadFile($dir, $file, $extensions=[])
    {
        //Si el directorio existe
        if (is_dir($dir))
        {
            //Ruta absoluta del archivo
            $path = $dir.$file;

            //Si el archivo existe
            if (is_file($path))
            {
                //Obtener información del archivo
                $file_info = pathinfo($path);
                //Obtener la extensión del archivo
                $extension = $file_info["extension"];

                if (is_array($extensions))
                {
                    //Si el argumento $extensions es un array
                    //Comprobar las extensiones permitidas
                    foreach($extensions as $e)
                    {
                        //Si la extension es correcta
                        if ($e === $extension)
                        {
                            //Procedemos a descargar el archivo
                            // Definir headers
                            $size = filesize($path);
                            header("Content-Type: application/force-download");
                            header("Content-Disposition: attachment; filename=$file");
                            header("Content-Transfer-Encoding: binary");
                            header("Content-Length: " . $size);
                            // Descargar archivo
                            readfile($path);
                            //Correcto
                            return true;
                        }
                    }
                }
            }
        }
        //Ha ocurrido un error al descargar el archivo
        return false;
    }
}
