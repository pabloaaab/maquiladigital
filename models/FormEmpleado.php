<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Empleado;
use app\models\Departamentos;
use app\models\Municipio;

/**
 * ContactForm is the model behind the contact form.
 */
class FormEmpleado extends Model
{
    public $id_empleado;
    public $identificacion;
    public $id_empleado_tipo;
    public $fechaingreso;
    public $dv;
    public $fecharetiro;
    public $nombre1;
    public $nombre2;
    public $apellido1;
    public $apellido2;
    public $iddepartamento;
    public $idmunicipio;
    public $email;
    public $direccion;
    public $telefono;
    public $celular;        
    public $contrato;
    public $observacion;
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identificacion', 'id_empleado_tipo','fechaingreso','nombre1','apellido1','iddepartamento','idmunicipio','email'], 'required', 'message' => 'Campo requerido'],
            ['identificacion', 'identificacion_existe'],
            ['email', 'email_existe'],
            [['id_empleado_tipo', 'identificacion', 'dv', 'contrato'], 'integer'],
            [['observacion'], 'string'],            
            ['email', 'email_existe'],
            [['fechaingreso', 'fecharetiro'], 'safe'],
            [['nombre1', 'nombre2', 'apellido1', 'apellido2'], 'string', 'max' => 40],
            //[['nombrecorto'], 'string', 'max' => 100],
            [['direccion', 'email'], 'string', 'max' => 120],
            [['telefono', 'celular', 'iddepartamento', 'idmunicipio'], 'string', 'max' => 45],
            [['id_empleado_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => EmpleadoTipo::className(), 'targetAttribute' => ['id_empleado_tipo' => 'id_empleado_tipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_empleado' => 'Id',
            'id_empleado_tipo' => 'Tipo Empleado',
            'identificacion' => 'Identificación',
            'dv' => 'Dv',
            'nombre1' => 'Nombre1',
            'nombre2' => 'Nombre2',
            'apellido1' => 'Apellido1',
            'apellido2' => 'Apellido2',
            //'nombrecorto' => 'Empleado',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'email' => 'Email',
            'iddepartamento' => 'Departamento',
            'idmunicipio' => 'Municipio',
            'contrato' => 'Contrato',
            'observacion' => 'Observacion',
            'fechaingreso' => 'Fecha Ingreso',
            'fecharetiro' => 'Fecha Retiro',
        ];
    }

    
    
    public function identificacion_existe($attribute, $params)
    {
        //Buscar la identificacion en la tabla
        $table = Empleado::find()->where("identificacion=:identificacion", [":identificacion" => $this->identificacion])->andWhere("iddepartamento!=:iddepartamento", [':iddepartamento' => $this->iddepartamento]);
        //Si la identificacion no existe en inscritos mostrar el error
        if ($table->count() > 0)
        {
            $this->addError($attribute, "El numero de identificacion ya existe");
        }
    }  

    public function email_existe($attribute, $params)
    {
        //Buscar el email en la tabla
        $table = Empleado::find()->where("email=:email", [":email" => $this->email])->andWhere("identificacion!=:identificacion", [':identificacion' => $this->identificacion]);
        //Si el email existe mostrar el error
        if ($table->count() > 0)
        {
            $this->addError($attribute, "El email ya existe");
        }
    }
    
    
}
