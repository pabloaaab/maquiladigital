<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Users;

class FormRegister extends model{

    public $codusuario;
    public $usuario;
    public $nombreusuario;
    public $tipousuario;
    public $documentousuario;
    public $emailusuario;
    public $password;
    public $authKey;
    public $accessToken;
    public $activo;
    public $password_repeat;

    public function rules()
    {
        return [
            [['usuario', 'emailusuario', 'password', 'password_repeat','nombreusuario','tipousuario','documentousuario',], 'required', 'message' => 'Campo requerido'],
            ['usuario', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 30 caracteres'],
            ['usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['usuario', 'usuario_existe'],

            ['nombreusuario', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['nombreusuario', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],

            ['emailusuario', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['emailusuario', 'email', 'message' => 'Formato no válido'],
            ['emailusuario', 'email_existe'],
            ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'usuario' => 'Usuario:',
            'nombreusuario' => 'Nombre:',
            'tipousuario' => 'Tipo Usuario:',
            'documentousuario' => 'Documento Usuario:',
            'emailusuario' => 'Email:',
            'password' => 'Clave:',
            'password_repeat' => 'Confirmar Clave:',
        ];
    }

    public function email_existe($attribute, $params)
    {

        //Buscar el email en la tabla
        $table = Users::find()->where("emailusuario=:emailusuario", [":emailusuario" => $this->emailusuario]);

        //Si el email existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El email seleccionado existe");
        }
    }

    public function usuario_existe($attribute, $params)
    {
        //Buscar el usuario en la tabla
        $table = Users::find()->where("usuario=:usuario", [":usuario" => $this->usuario]);

        //Si el username existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El usuario seleccionado existe");
        }
    }

}