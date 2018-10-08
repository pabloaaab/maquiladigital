<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Cliente;
use app\models\Departamentos;
use app\models\Municipio;

/**
 * ContactForm is the model behind the contact form.
 */
class FormCliente extends Model
{
    public $idcliente;
    public $idtipo;
    public $cedulanit;
    public $dv;
    public $razonsocial;
    public $nombrecliente;
    public $apellidocliente;
    public $nombrecorto;
    public $direccioncliente;
    public $telefonocliente;
    public $celularcliente;
    public $emailcliente;
    public $contacto;
    public $telefonocontacto;
    public $celularcontacto;
    public $formapago;
    public $plazopago;
    public $iddepartamento;
    public $idmunicipio;
    public $nitmatricula;
    public $tiporegimen;
    public $autoretenedor;
    public $retencioniva;
    public $retencionfuente;
    public $observacion;
    public $fechaingreso;

    public function rules()
    {
        return [

            ['idtipo', 'required', 'message' => 'Campo requerido'],
            ['cedulanit', 'required', 'message' => 'Campo requerido'],
            ['cedulanit', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['cedulanit', 'cedulanit_existe'],
            ['dv', 'required', 'message' => 'Campo requerido'],
            [['dv'], 'string', 'max' => 1],
            ['razonsocial', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['nombrecliente', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['apellidocliente', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['apellidocliente', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['direccioncliente', 'default'],
            ['telefonocliente', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['celularcliente', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['emailcliente', 'email'],
            ['emailcliente', 'email_existe'],
            ['contacto', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['telefonocontacto', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['celularcontacto', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['formapago', 'required', 'message' => 'Campo requerido'],
            ['formapago', 'default'],
            ['plazopago', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['iddepartamento', 'required', 'message' => 'Campo requerido'],
            ['idmunicipio', 'required', 'message' => 'Campo requerido'],
            ['nitmatricula', 'required', 'message' => 'Campo requerido'],
            ['nitmatricula', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['nitmatricula', 'nitmatricula_existe'],
            ['tiporegimen', 'required', 'message' => 'Campo requerido'],
            ['autoretenedor', 'default'],
            ['retencioniva', 'required', 'message' => 'Campo requerido'],
            ['retencioniva', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['retencionfuente', 'required', 'message' => 'Campo requerido'],
            ['retencionfuente', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['observacion', 'default'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'idtipo' => 'Tipo Identificacion:',
            'cedulanit' => 'Cedula/Nit:',
            'razonsocial' => 'Razón Social:',
            'nombrecliente' => 'Nombres:',
            'apellidocliente' => 'Apellidos:',
            'direccioncliente' => 'Dirección:',
            'telefonocliente' => 'Teléfono:',
            'celularcliente' => 'celular:',
            'emailcliente' => 'Email:',
            'contacto' => 'Contacto:',
            'telefonocontacto' => 'Telefono:',
            'celularcontacto' => 'Celular:',
            'formapago' => 'Forma de Pago:',
            'plazopago' => 'Plazo:',
            'iddepartamento' => 'Departamento:',
            'idmunicipio' => 'Municipio:',
            'nitmatricula' => 'Nit/Matricula:',
            'tiporegimen' => 'Tipo Régimen:',
            'autoretenedor' => 'Autoretenedor:',
            'retencioniva' => 'Rete Iva:',
            'retencionfuente' => 'Rete Fte:',
            'dv' => 'DV:',
            'observacion' => '',

        ];
    }

    public function cedulanit_existe($attribute, $params)
    {
        //Buscar la cedula/nit en la tabla
        $table = Cliente::find()->where("cedulanit=:cedulanit", [":cedulanit" => $this->cedulanit])->andWhere("idcliente!=:idcliente", [':idcliente' => $this->idcliente]);
        //Si la identificacion existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El número de identificación o nit ya existe");
        }
    }

    public function nitmatricula_existe($attribute, $params)
    {
        //Buscar la cedula/nit en la tabla
        $table = Cliente::find()->where("nitmatricula=:nitmatricula", [":nitmatricula" => $this->nitmatricula])->andWhere("cedulanit!=:cedulanit", [':cedulanit' => $this->cedulanit]);
        //Si la identificacion existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El número de nit o matricula ya existe".$this->cedulanit);
        }
    }

    public function email_existe($attribute, $params)
    {
        //Buscar el email en la tabla
        $table = Cliente::find()->where("emailcliente=:emailcliente", [":emailcliente" => $this->emailcliente])->andWhere("cedulanit!=:cedulanit", [':cedulanit' => $this->cedulanit]);
        //Si el email existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El email ya existe".$this->idcliente);
        }
    }
}
