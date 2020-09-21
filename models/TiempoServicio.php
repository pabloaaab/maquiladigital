<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_contrato".
 *
 * @property int $id_tipo_contrato
 * @property string $contrato
 * @property int $estado
 *
 * @property Contrato[] $contratos
 */
class TiempoServicio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiempo_servicio';
    }

    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->tiempo_servicio = strtoupper($this->tiempo_servicio);        
        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tiempo_servicio', 'horas_dia'], 'required'],
            [['horas_dia'], 'integer'],
            [['pago_incapacidad_general', 'pago_incapacidad_laboral'],'number'],
            [['tiempo_servicio'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tiempo' => 'Id',
            'tiempo_servicio' => 'Servicio',
            'horas_dia' => 'Horas dia',
            'pago_incapacidad_general' => '% Pago incapacidad_general',
            'pago_incapacidad_laboral' => '% Pago incapacidad laboral',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiempos()
    {
        return $this->hasMany(TiempoServicio::className(), ['id_tiempo' => 'id_tiempo']);
    }
    
}
