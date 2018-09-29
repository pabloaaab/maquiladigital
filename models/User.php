<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{

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
    public $fechaproceso;

    public static function isUserAdmin($codusuario)
    {
        if (Users::findOne(['codusuario' => $codusuario, 'activo' => '1', 'role' => 2])){
            return true;
        } else {

            return false;
        }

    }

    public static function isUserSimple($codusuario)
    {
        if (Users::findOne(['codusuario' => $codusuario, 'activo' => '1', 'role' => 1])){
            return true;
        } else {

            return false;
        }
    }

    /**
     * @inheritdoc
     */

    /* busca la identidad del usuario a través de su $codusuario */

    public static function findIdentity($codusuario)
    {

        $user = Users::find()
            ->where("activo=:activo", [":activo" => 1])
            ->andWhere("codusuario=:codusuario", ["codusuario" => $codusuario])
            ->one();

        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */

    /* Busca la identidad del usuario a través de su token de acceso */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        $users = Users::find()
            ->where("activo=:activo", [":activo" => 1])
            ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
            ->all();

        foreach ($users as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */

    /* Busca la identidad del usuario a través del username */
    public static function findByUsername($usuario)
    {
        $users = Users::find()
            ->where("activo=:activo", ["activo" => 1])
            ->andWhere("usuario=:usuario", [":usuario" => $usuario])
            ->all();

        foreach ($users as $user) {
            if (strcasecmp($user->usuario, $usuario) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */

    /* Regresa el id del usuario */
    public function getId()
    {
        return $this->codusuario;
    }

    /**
     * @inheritdoc
     */

    /* Regresa la clave de autenticación */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */

    /* Valida la clave de autenticación */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        /* Valida el password */
        if (crypt($password, $this->password) == $this->password)
        {
            return $password === $password;
        }
    }
}