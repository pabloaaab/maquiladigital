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
use app\models\Departamentos;
use app\models\FormCliente;
use yii\helpers\Url;
use app\models\FormFiltroCliente;
use yii\web\UploadedFile;
use yii\bootstrap\Modal;

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
                    $table = Cliente::find()
                        ->orderBy('idcliente desc');
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
                $to = $count->count();
                return $this->render('index', [
                    'model' => $model,
                    'form' => $form,                    
                    'pagination' => $pages,
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
                    $table->observacion = $model->observacion;
                    $table->dv = $model->dv;
                    if ($model->idtipo == 1){
                        $table->nombrecorto = $model->nombrecliente." ".$model->apellidocliente ;
                        $model->razonsocial = null;
                    }elseif ($model->idtipo == 5){
                        $table->nombrecorto = $model->razonsocial;
                        $model->nombrecliente = null;
                        $model->apellidocliente = null;
                    }

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
            $model = new FormCliente();
            $msg = null;
            $tipomsg = null;
            if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            $idcliente = Html::encode($_GET["idcliente"]);
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    $table = Cliente::find()->where(['idcliente' => $idcliente])->one();
                    if ($table) {
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
                        $table->observacion = $model->observacion;
                        $table->dv = $model->dv;
                        if ($model->idtipo == 1){
                            $table->nombrecorto = $model->nombrecliente." ".$model->apellidocliente ;
                            $model->razonsocial = null;
                        }elseif ($model->idtipo == 5){
                            $table->nombrecorto = $model->razonsocial;
                            $model->nombrecliente = null;
                            $model->apellidocliente = null;
                        }
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


            if (Yii::$app->request->get("idcliente")) {
                $idcliente = Html::encode($_GET["idcliente"]);
                $table = Cliente::find()->where(['idcliente' => $idcliente])->one();
                if ($table) {
                    $model->idtipo = $table->idtipo;
                    $model->cedulanit = $table->cedulanit;
                    $model->razonsocial = $table->razonsocial;
                    $model->nombrecliente = $table->nombrecliente;
                    $model->apellidocliente = $table->apellidocliente;
                    $model->direccioncliente = $table->direccioncliente;
                    $model->telefonocliente = $table->telefonocliente;
                    $model->celularcliente = $table->celularcliente;
                    $model->emailcliente = $table->emailcliente;
                    $model->iddepartamento = $table->iddepartamento;
                    $model->idmunicipio = $table->idmunicipio;
                    $model->contacto = $table->contacto;
                    $model->telefonocontacto = $table->telefonocontacto;
                    $model->celularcontacto = $table->celularcontacto;
                    $model->formapago = $table->formapago;
                    $model->plazopago = $table->plazopago;
                    $model->nitmatricula = $table->nitmatricula;
                    $model->tiporegimen = $table->tiporegimen;
                    $model->autoretenedor = $table->autoretenedor;
                    $model->retencionfuente = $table->retencionfuente;
                    $model->retencioniva = $table->retencioniva;
                    $model->dv = $table->dv;
                    $model->observacion = $table->observacion;
                } else {
                    return $this->redirect(["clientes/index"]);
                }
            } else {
                return $this->redirect(["clientes/index"]);
            }
            return $this->render("editar", ["model" => $model, "msg" => $msg, "tipomsg" => $tipomsg]);
        }

        public function actionDetalle()
        {
           // $model = new List();
            $idcliente = Html::encode($_GET["idcliente"]);
            $table = Cliente::find()->where(['idcliente' => $idcliente])->one();
            return $this->render('detalle', ['table' => $table
                ]);
        }

        public function actionEliminar()
        {
            if(Yii::$app->request->post())
            {
                $idcliente = Html::encode($_POST["idcliente"]);
                if((int) $idcliente)
                {
                    if(Cliente::deleteAll("idcliente=:idcliente", [":idcliente" => $idcliente]))
                    {
                        //echo "Cliente con id $idcliente eliminado con éxito, redireccionando ...";
                        $this->redirect(["clientes/index"]);
                    }
                    else
                    {
                       // echo "Ha ocurrido un error al eliminar el cliente, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("clientes/index")."'>";
                    }
                }
                else
                {
                   // echo "Ha ocurrido un error al eliminar el cliente, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("clientes/index")."'>";
                }
            }
            else
            {
                return $this->redirect(["clientes/index"]);
            }
        }

        public function actionMunicipio($id){
            $rows = Municipio::find()->where(['iddepartamento' => $id])->all();
            echo "<option required>Seleccione...</option>";
            if(count($rows)>0){
                foreach($rows as $row){
                    echo "<option value='$row->idmunicipio' required>$row->municipio</option>";
                }
            }
        }

}