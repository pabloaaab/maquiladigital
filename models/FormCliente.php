<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Cliente;

/**
 * ContactForm is the model behind the contact form.
 */
class FormCliente extends Model
{
    public $idtipo;
    public $cedulanit;
    public $dv;
    public $razonsocil;
    public $nombrecliente;
    public $apellidocliente;
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
            ['dv', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['razonsocial', 'required', 'message' => 'Campo requerido'],
            ['razonsocial', 'match', 'pattern' => "/^[a-záéíóúñ]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['nombrecliente', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['nombrecliente', 'required', 'message' => 'Campo requerido'],
            ['apellidocliente', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['apellidocliente', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['direccioncliente', 'default'],
            ['telefonocliente', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['celularcliente', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['emailcliente', 'email'],
            ['emailcliente', 'email_existe'],
            ['contacto', 'match', 'pattern' => "/^[a-záéíóúñ]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['telefonocontacto', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['celularcontacto', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['formadepago', 'required', 'message' => 'Campo requerido'],
            ['formadepago', 'default'],
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
            'telefonocontacto' => 'TelefonoContacto:',
            'celularcontacto' => 'Celular Contacto:',
            'formadepago' => 'Forma de Pago:',
            'plazopago' => 'Plazo Pago:',
            'iddepartamento' => 'Departamento:',
            'municipio' => 'Municipio:',
            'nitmatricula' => 'Nit/Matricula:',
            'tiporegimen' => 'Tipo Régimen:',
            'autoretenedor' => 'Autoretenedor:',
            'retencioniva' => 'Retención Iva:',
            'retencionfuente' => 'Retención Fuente:',
            'observacion' => 'Observación:',

        ];
    }

    public function cedulanit_existe($attribute, $params)
    {
        //Buscar la cedula/nit en la tabla
        $table = Cliente::find()->where("cedulanit=:cedulanit", [":cedulanit" => $this->cedulanit])->andWhere("codcliente!=:codcliente", [':codcliente' => $this->codcliente]);
        //Si la identificacion existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El número de identificación ya existe".$this->consecutivo);
        }
    }
    public function email_existe($attribute, $params)
    {
        //Buscar el email en la tabla
        $table = Cliente::find()->where("emailcliente=:emailcliente", [":emailcliente" => $this->emailcliente])->andWhere("codcliente!=:codcliente", [':codcliente' => $this->codcliente]);
        //Si el email existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El email ya existe".$this->codcliente);
        }
    }
}
