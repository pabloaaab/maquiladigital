<?php

namespace app\controllers;

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
use app\models\Cliente;
use app\models\Municipio;
use app\models\FormCliente;
use yii\helpers\Url;
use app\models\FormFiltroCliente;
use yii\web\UploadedFile;


    class ClientesController extends Controller
    {

        public function actionIndex()
        {
            //if (!Yii::$app->user->isGuest) {
                $form = new FormFiltroCliente;
                $cedulanit = null;
				$nombrecorto = null;
                if ($form->load(Yii::$app->request->get())) {
                    if ($form->validate()) {
                        $cedulanit = Html::encode($form->cedulanit);
                        $nombrecorto = Html::encode($form->nombrecorto);
                        $table = Cliente::find()
                            ->andFilterWhere(['like', 'cedulanit', $cedulanit])
                            ->andFilterWhere(['like', 'nombrecorto', $nombrecorto])
							->orderBy('idcliente desc');
                        $count = clone $table;
                        $to = $count->count();
                        $pages = new Pagination([
                            'pageSize' => 20,
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
                    $table = Cliente::find()
                        ->orderBy('idcliente desc');
                    $count = clone $table;
                    $pages = new Pagination([
                        'pageSize' => 20,
                        'totalCount' => $count->count(),
                    ]);
                    $model = $table
                        ->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
                }
                $to = $count->count();
                return $this->render('index', [
                    'model' => $model,
                    'form' => $form,                    
                    'pagination' => $pages,
                    'to' => $to,

                ]);
           /* }else{
                return $this->redirect(["site/login"]);
            }*/

        }

        public function actionNuevo()
        {
            $model = new FormCliente();
            $msg = null;
            $tipomsg = null;
            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    $table = new Cliente();
                    $table->idtipo = $model->idtipo;
                    $table->cedulanit = $model->cedulanit;
                    $table->razonsocial = $model->razonsocial;
                    $table->nombrecliente = $model->nombrecliente;
                    $table->apellidocliente = $model->apellidocliente;
                    $table->direccioncliente = $model->direccioncliente;
                    $table->telefonocliente = $model->telefonocliente;
                    $table->celularcliente = $model->celularcliente;
                    $table->emailcliente = $model->emailcliente;
                    $table->iddepartamento = $model->iddepartamento;
                    $table->idmunicipio = $model->idmunicipio;
                    $table->contacto = $model->contacto;
                    $table->telefonocontacto = $model->telefonocontacto;
                    $table->celularcontacto = $model->celularcontacto;
                    $table->formapago = $model->formapago;
                    $table->plazopago = $model->plazopago;
                    $table->nitmatricula = $model->nitmatricula;
                    $table->tiporegimen = $model->tiporegimen;
                    $table->autoretenedor = $model->autoretenedor;
                    $table->retencionfuente = $model->retencionfuente;
                    $table->retencioniva = $model->retencioniva;

                    if ($table->insert()) {
                        $msg = "Registros guardados correctamente";
                        $model->idtipo = null;
                        $model->cedulanit = null;
                        $model->razonsocial = null;
                        $model->nombrecliente = null;
                        $model->apellidocliente = null;
                        $model->direccioncliente = null;
                        $model->telefonocliente = null;
                        $model->celularcliente = null;
                        $model->emailcliente = null;
                        $model->iddepartamento = null;
                        $model->idmunicipio = null;
                        $model->contacto = null;
                        $model->telefonocontacto = null;
                        $model->celularcontacto = null;
                        $model->formapago = null;
                        $model->plazopago = null;
                        $model->nitmatricula = null;
                        $model->tiporegimen = null;
                        $model->autoretenedor = null;
                        $model->retencionfuente = null;
                        $model->retencioniva = null;
                        $model->observacion = null;
                    } else {
                        $msg = "error";
                    }
                } else {
                    $model->getErrors();
                }
            }

            return $this->render('nuevo', ['model' => $model, 'msg' => $msg, 'tipomsg' => $tipomsg]);
        }

        public function actionEditar()
        {
            $model = new FormInscrito;
            $msg = null;
            $tipomsg = null;
            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    $table = Inscritos::find()->where(['consecutivo' => $model->consecutivo])->one();
                    if ($table) {
                        $table->identificacion = $model->identificacion;
                        $table->nombre1 = $model->nombre1;
                        $table->nombre2 = $model->nombre2;
                        $table->tipo_doc = $model->tipo_doc;
                        $table->apellido1 = $model->apellido1;
                        $table->apellido2 = $model->apellido2;
                        $table->nom_madre = $model->nom_madre;
                        $table->nom_padre = $model->nom_padre;
                        $table->doc_madre = $model->doc_madre;
                        $table->doc_padre = $model->doc_padre;
                        $table->ocupacion_madre = $model->ocupacion_madre;
                        $table->ocupacion_padre = $model->ocupacion_padre;
                        $table->tipo_personal = $model->tipo_personal;
                        $table->lugar_exp = $model->lugar_exp;
                        $table->telefono = $model->telefono;
                        $table->celular = $model->celular;
                        $table->email = $model->email;
                        $table->direccion = $model->direccion;
                        $table->sexo = $model->sexo;
                        $table->comuna = $model->comuna;
                        $table->barrio = $model->barrio;
                        $table->fecha_nac = $model->fecha_nac;
                        $table->municipio_nac = $model->municipio_nac;
                        $table->departamento_nac = $model->departamento_nac;
                        $table->municipio = $model->municipio;
                        $table->estudio1 = $model->estudio1;
                        $table->estudio2 = $model->estudio2;
                        $table->gradoc1 = $model->gradoc1;
                        $table->gradoc2 = $model->gradoc2;
                        $table->anioc1 = $model->anioc1;
                        $table->anioc2 = $model->anioc2;
                        $table->graduado1 = $model->graduado1;
                        $table->graduado2 = $model->graduado2;
                        $table->autoriza = $model->autoriza;
                        $table->fecha_autoriza = $model->fecha_autoriza;
                        $table->ciudad_firma = $model->ciudad_firma;
                        if ($table->update()) {
                            $msg = "El registro ha sido actualizado correctamente";
                        } else {
                            $msg = "El registro no sufrio ningun cambio";
                            $tipomsg = "danger";
                        }
                    } else {
                        $msg = "El registro seleccionado no ha sido encontrado";
                        $tipomsg = "danger";
                    }
                } else {
                    $model->getErrors();
                }
            }


            if (Yii::$app->request->get("consecutivo")) {
                $consecutivo = Html::encode($_GET["consecutivo"]);
                $table = Inscritos::find()->where(['consecutivo' => $consecutivo])->one();
                if ($table) {
                    $model->consecutivo = $table->consecutivo;
                    $model->identificacion = $table->identificacion;
                    $model->nombre1 = $table->nombre1;
                    $model->nombre2 = $table->nombre2;
                    $model->tipo_doc = $table->tipo_doc;
                    $model->apellido1 = $table->apellido1;
                    $model->apellido2 = $table->apellido2;
                    $model->nom_madre = $table->nom_madre;
                    $model->nom_padre = $table->nom_padre;
                    $model->doc_madre = $table->doc_madre;
                    $model->doc_padre = $table->doc_padre;
                    $model->ocupacion_madre = $table->ocupacion_madre;
                    $model->ocupacion_padre = $table->ocupacion_padre;
                    $model->tipo_personal = $table->tipo_personal;
                    $model->lugar_exp = $table->lugar_exp;
                    $model->telefono = $table->telefono;
                    $model->celular = $table->celular;
                    $model->email = $table->email;
                    $model->direccion = $table->direccion;
                    $model->sexo = $table->sexo;
                    $model->comuna = $table->comuna;
                    $model->barrio = $table->barrio;
                    $model->fecha_nac = $table->fecha_nac;
                    $model->municipio_nac = $table->municipio_nac;
                    $model->departamento_nac = $table->departamento_nac;
                    $model->municipio = $table->municipio;
                    $model->estudio1 = $table->estudio1;
                    $model->estudio2 = $table->estudio2;
                    $model->gradoc1 = $table->gradoc1;
                    $model->gradoc2 = $table->gradoc2;
                    $model->anioc1 = $table->anioc1;
                    $model->anioc2 = $table->anioc2;
                    $model->graduado1 = $table->graduado1;
                    $model->graduado2 = $table->graduado2;
                    $model->autoriza = $table->autoriza;
                    $model->fecha_autoriza = $table->fecha_autoriza;
                    $model->ciudad_firma = $table->ciudad_firma;
                } else {
                    return $this->redirect(["clientes/index"]);
                }
            } else {
                return $this->redirect(["clientes/index"]);
            }
            return $this->render("editar", ["model" => $model, "msg" => $msg, "tipomsg" => $tipomsg]);
        }

        public function actionMunicipio($id){
            $rows = Municipio::find()->where(['iddepartamento' => $id])->all();
            echo "<option>Seleccione...</option>";
            if(count($rows)>0){
                foreach($rows as $row){
                    echo "<option value='$row->idmunicipio'>$row->municipio</option>";
                }
            }
        }

}