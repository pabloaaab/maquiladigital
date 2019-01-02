<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Proveedor;
use app\models\Departamentos;
use app\models\Municipio;

/**
 * ContactForm is the model behind the contact form.
 */
class FormProveedor extends Model
{
    public $idproveedor;
    public $idtipo;
    public $cedulanit;
    public $dv;
    public $razonsocial;
    public $nombreproveedor;
    public $apellidoproveedor;
    public $nombrecorto;
    public $direccionproveedor;
    public $telefonoproveedor;
    public $celularproveedor;
    public $emailproveedor;
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
            [['dv'], 'string', 'max' => 1],
            ['razonsocial', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['nombreproveedor', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['apellidoproveedor', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['apellidoproveedor', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['direccionproveedor', 'default'],
            ['telefonoproveedor', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['celularproveedor', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['emailproveedor', 'email'],
	    ['emailproveedor', 'required', 'message' => 'Campo requerido'],
            ['emailproveedor', 'email_existe'],
            ['contacto', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['telefonocontacto', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['celularcontacto', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['formapago', 'required', 'message' => 'Campo requerido'],
            ['formapago', 'default'],
            ['plazopago', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['iddepartamento', 'required', 'message' => 'Campo requerido'],
            ['idmunicipio', 'required', 'message' => 'Campo requerido'],
	    [['idmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idmunicipio' => 'idmunicipio'],'message' => 'Campo requerido'],                      
            ['tiporegimen', 'required', 'message' => 'Campo requerido'],
            ['autoretenedor', 'required'],
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
            'nombreproveedor' => 'Nombres:',
            'apellidoproveedor' => 'Apellidos:',
            'direccionproveedor' => 'Dirección:',
            'telefonoproveedor' => 'Teléfono:',
            'celularproveedor' => 'celular:',
            'emailproveedor' => 'Email:',
            'contacto' => 'Contacto:',
            'telefonocontacto' => 'Telefono contacto:',
            'celularcontacto' => 'Celular contacto:',
            'formapago' => 'Forma de Pago:',
            'plazopago' => 'Plazo:',
            'iddepartamento' => 'Departamento:',
            'idmunicipio' => 'Municipio:',            
            'tiporegimen' => 'Tipo Régimen:',
            'autoretenedor' => 'Autoretenedor:',
            'retencioniva' => 'Retención Iva:',
            'retencionfuente' => 'Retención Fte:',
            'dv' => '',
            'observacion' => 'Observaciones:',

        ];
    }

    public function cedulanit_existe($attribute, $params)
    {
        //Buscar la cedula/nit en la tabla
        $table = Proveedor::find()->where("cedulanit=:cedulanit", [":cedulanit" => $this->cedulanit])->andWhere("emailproveedor!=:emailproveedor", [':emailproveedor' => $this->emailproveedor]);
        //Si la identificacion existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El número de identificación ya existe");
        }
    }   

    public function email_existe($attribute, $params)
    {
        //Buscar el email en la tabla
        $table = Proveedor::find()->where("emailproveedor=:emailproveedor", [":emailproveedor" => $this->emailproveedor])->andWhere("cedulanit!=:cedulanit", [':cedulanit' => $this->cedulanit]);
        //Si el email existe mostrar el error
        if ($table->count() == 1)
        {
            $this->addError($attribute, "El email ya existe");
        }
    }
}
