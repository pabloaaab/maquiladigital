<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registro_personal".
 *
 * @property int $id
 * @property int $documento
 * @property int $tipo_documento
 * @property string $nombrecompleto
 * @property int $telefono
 * @property int $celular
 * @property string $idmunicipio
 * @property string $fecha_creacion
 *
 * @property ControlAcceso[] $controlAccesos
 * @property Municipio $municipio
 * @property Tipodocumento $tipoDocumento
 */
class RegistroPersonal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registro_personal';
    }    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documento', 'id_tipo_documento', 'telefono', 'celular'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['nombrecompleto'], 'string', 'max' => 100],
            [['idmunicipio'], 'string', 'max' => 15],
            [['idmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idmunicipio' => 'idmunicipio']],
            [['id_tipo_documento'], 'exist', 'skipOnError' => true, 'targetClass' => Tipodocumento::className(), 'targetAttribute' => ['id_tipo_documento' => 'id_tipo_documento']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'documento' => 'Documento',
            'id_tipo_documento' => 'Tipo Documento',
            'nombrecompleto' => 'Nombrecompleto',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'idmunicipio' => 'Idmunicipio',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }
    
    public function beforeSave($insert) {
	if(!parent::beforeSave($insert)){
            return false;
        }
	# ToDo: Cambiar a cliente cargada de configuración.    
	$this->nombrecompleto = strtoupper($this->nombrecompleto);	
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlAccesos()
    {
        return $this->hasMany(ControlAcceso::className(), ['id_registro_personal' => 'id']);
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
    public function getTipoDocumento()
    {
        return $this->hasOne(TipoDocumento::className(), ['id_tipo_documento' => 'id_tipo_documento']);   
    }
}
