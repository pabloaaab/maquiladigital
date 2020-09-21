<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estudio_empleado".
 *
 * @property int $id
 * @property string $idmunicipio
 * @property int $id_empleado
 * @property int $documento
 * @property int $id_tipo_estudio
 * @property string $institucion_educativa
 * @property string $titulo_obtenido
 * @property int $anio_cursado
 * @property string $fecha_inicio
 * @property string $fecha_terminacion
 * @property int $graduado
 * @property string $fecha_vencimiento
 * @property string $registro
 * @property int $validar_vencimiento
 * @property string $observacion
 *
 * @property Municipio $municipio
 * @property Empleado $empleado
 * @property TipoEstudios $tipoEstudio
 */
class EstudioEmpleado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estudio_empleado';
    }
   public function beforeSave($insert) {
	if(!parent::beforeSave($insert)){
            return false;
        }
	   
	$this->observacion = strtolower($this->observacion); 
        $this->observacion = ucfirst($this->observacion); 
        $this->institucion_educativa = strtoupper($this->institucion_educativa);
	$this->titulo_obtenido = strtoupper($this->titulo_obtenido);
	$this->registro = strtoupper($this->registro);		
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empleado', 'fecha_inicio', 'fecha_terminacion'], 'required'],
            [['id_empleado', 'documento', 'id_tipo_estudio', 'anio_cursado', 'graduado', 'validar_vencimiento'], 'integer'],
            [['fecha_inicio', 'fecha_terminacion', 'fecha_vencimiento'], 'safe'],
            [['observacion'], 'string'],
            [['idmunicipio'], 'string', 'max' => 15],
            [['institucion_educativa', 'titulo_obtenido'], 'string', 'max' => 50],
            [['registro'], 'string', 'max' => 20],
            [['idmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idmunicipio' => 'idmunicipio']],
            [['id_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['id_empleado' => 'id_empleado']],
            [['id_tipo_estudio'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEstudios::className(), 'targetAttribute' => ['id_tipo_estudio' => 'id_tipo_estudio']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'idmunicipio' => 'Municipio:',
            'id_empleado' => 'Empleado:',
            'documento' => 'Documento:',
            'id_tipo_estudio' => 'Estudios:',
            'institucion_educativa' => 'Institucion Educativa:',
            'titulo_obtenido' => 'Titulo Obtenido:',
            'anio_cursado' => 'Año Cursado:',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_terminacion' => 'Fecha Terminacion',
            'graduado' => 'Graduado',
            'fecha_vencimiento' => 'Fecha Vencimiento:',
            'registro' => 'Registro:',
            'validar_vencimiento' => 'Validar Vencimiento:',
            'observacion' => 'Observacion:',
            'usuariosistema' => 'Usuario:',
        ];
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
    public function getEmpleado()
    {
        return $this->hasOne(Empleado::className(), ['id_empleado' => 'id_empleado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoEstudio()
    {
        return $this->hasOne(TipoEstudios::className(), ['id_tipo_estudio' => 'id_tipo_estudio']);
    }
    
    public function getValidar(){
        if($this->validar_vencimiento == 1){
          $validar = 'SI';
        }else{
            $validar = 'NO';
        }
        return $validar;
    }
    
    public function getGraduadoEstudio(){
        if($this->graduado == 1){
          $graduadoestudio = 'SI';
        }else{
            $graduadoestudio = 'NO';
        }
        return $graduadoestudio;
    }
}
