<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Empleado;

/**
 * This is the model class for table "empleado".
 *
 * @property int $id_empleado
 * @property int $id_empleado_tipo
 * @property int $identificacion
 * @property int $dv
 * @property string $nombre1
 * @property string $nombre2
 * @property string $apellido1
 * @property string $apellido2
 * @property string $nombrecorto
 * @property string $direccion
 * @property string $telefono
 * @property string $celular
 * @property string $email
 * @property string $iddepartamento
 * @property string $idmunicipio
 * @property int $contrato
 * @property string $observacion
 * @property string $fechaingreso
 * @property string $fecharetiro
 * @property string $fechacreacion
 *
 * @property EmpleadoTipo $empleadoTipo
 * @property Departamento $departamento
 * @property Municipio $municipio
 * @property Fichatiempo[] $fichatiempos
 */
class Empleado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleado';
    }
    
    public function beforeSave($insert) {
	if(!parent::beforeSave($insert)){
            return false;
        }
	# ToDo: Cambiar a empleado cargada de configuración.    
	$this->nombre1 = strtoupper($this->nombre1);
	$this->nombre2 = strtoupper($this->nombre2);
        $this->apellido1 = strtoupper($this->apellido1);
        $this->apellido2 = strtoupper($this->apellido2);
	$this->nombrecorto = strtoupper($this->nombrecorto);
	$this->direccion = strtoupper($this->direccion);	
	$this->observacion = strtoupper($this->observacion);	
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empleado_tipo', 'identificacion', 'dv', 'contrato'], 'integer'],
            [['identificacion', 'id_empleado_tipo','fechaingreso','nombre1','apellido1','iddepartamento','idmunicipio','email'], 'required'],
            ['identificacion','identificacion_no_existe'],
            [['observacion'], 'string'],
            [['fechaingreso', 'fecharetiro', 'fechacreacion'], 'safe'],
            [['nombre1', 'nombre2', 'apellido1', 'apellido2', 'telefono', 'celular'], 'string', 'max' => 20],
            [['nombrecorto', 'direccion'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 60],
            [['iddepartamento', 'idmunicipio'], 'string', 'max' => 15],
            [['id_empleado_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => EmpleadoTipo::className(), 'targetAttribute' => ['id_empleado_tipo' => 'id_empleado_tipo']],
            [['iddepartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['iddepartamento' => 'iddepartamento']],
            [['idmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idmunicipio' => 'idmunicipio']],
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
            'identificacion' => 'Identificacion',
            'dv' => 'Dv',
            'nombre1' => 'Nombre 1',
            'nombre2' => 'Nombre 2',
            'apellido1' => 'Apellido 1',
            'apellido2' => 'Apellido 2',
            'nombrecorto' => 'Empleado',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'email' => 'Email',
            'iddepartamento' => 'Departamento',
            'idmunicipio' => 'Municipio',
            'contrato' => 'Contrato',
            'observacion' => 'Observacion',
            'fechaingreso' => 'Fechaingreso',
            'fecharetiro' => 'Fecharetiro',
            'fechacreacion' => 'Fechacreacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadoTipo()
    {
        return $this->hasOne(EmpleadoTipo::className(), ['id_empleado_tipo' => 'id_empleado_tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['iddepartamento' => 'iddepartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['idmunicipio' => 'idmunicipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichatiempos()
    {
        return $this->hasMany(Fichatiempo::className(), ['id_empleado' => 'id_empleado']);
    }
    
     public function getNombreEmpleado()
    {
        return "{$this->nombre1} {$this->nombre2} {$this->apellido1} {$this->apellido2}";
    }
    
    public function getNombreEmpleados()
    {
        return "{$this->nombrecorto} - {$this->identificacion}";
    }
    
    public function getContratado()
    {
        if($this->contrato == 1){
            $contratado = "SI";
        }else{
            $contratado = "NO";
        }
        return $contratado;
    }
    
    public function getTipo()
    {
        if($this->id_empleado_tipo == 1){
            $tipo = "OPERATIVO";
        }else{
            $tipo = "ADMINISTRATIVO";
        }
        return $tipo;
    }
    
    public function identificacion_no_existe($attribute, $params)
    {
        //Buscar la identificacion en la tabla
        $table = Empleado::find()->where("identificacion=:identificacion", [":identificacion" => $this->identificacion]);
        //Si la identificacion no existe en inscritos mostrar el error
        if ($table->count() > 1)
        {
            $this->addError($attribute, "El numero de identificacion ya existe");
        }
    }
}
