<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "control_acceso".
 *
 * @property int $id
 * @property int $id_registro_personal
 * @property string $fecha_ingreso
 * @property string $fecha_salida
 * @property int $acceso 1: Entrada, 2: Salida
 * @property string $temperatura_inicial
 * @property string $temperatura_final
 * @property int $tipo_personal 1: Empleado, 2: Visitante
 * @property int $tiene_sintomas
 * @property string $observacion
 * @property string $fecha_creacion
 *
 * @property RegistroPersonal $registroPersonal
 * @property ControlAccesoDetalle[] $controlAccesoDetalles
 */
class ControlAcceso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_acceso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_registro_personal', 'tiene_sintomas'], 'required'],
            [['id_registro_personal', 'tiene_sintomas'], 'integer'],
            [['fecha_ingreso', 'fecha_salida', 'fecha_creacion'], 'safe'],
            [['observacion','tipo_personal'], 'string'],
            [['temperatura_inicial', 'temperatura_final'], 'string', 'max' => 20],
            [['id_registro_personal'], 'exist', 'skipOnError' => true, 'targetClass' => RegistroPersonal::className(), 'targetAttribute' => ['id_registro_personal' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_registro_personal' => 'Id Registro Personal',
            'fecha_ingreso' => 'Fecha Ingreso',
            'fecha_salida' => 'Fecha Salida',            
            'temperatura_inicial' => 'Temperatura Inicial',
            'temperatura_final' => 'Temperatura Final',
            'tipo_personal' => 'Tipo Personal',
            'tiene_sintomas' => 'Tiene Sintomas',
            'observacion' => 'Observacion',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistroPersonal()
    {
        return $this->hasOne(RegistroPersonal::className(), ['id' => 'id_registro_personal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlAccesoDetalles()
    {
        return $this->hasMany(ControlAccesoDetalle::className(), ['id_control_acceso' => 'id']);
    }
    
    public function getTieneSintomas(){
        if($this->tiene_sintomas == 1){
            $tienesintomas = 'SI';
        }else{
            $tienesintomas = 'NO';
        }
        return $tienesintomas;
    }
}
