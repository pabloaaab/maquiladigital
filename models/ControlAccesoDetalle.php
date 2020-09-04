<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "control_acceso_detalle".
 *
 * @property int $id
 * @property int $id_control_acceso
 * @property int $id_sintoma_covid
 *
 * @property ControlAcceso $controlAcceso
 * @property SintomasCovid $idSintomaCov
 */
class ControlAccesoDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_acceso_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_control_acceso', 'id_sintoma_covid'], 'integer'],
            ['acceso', 'string'],
            [['id_control_acceso'], 'exist', 'skipOnError' => true, 'targetClass' => ControlAcceso::className(), 'targetAttribute' => ['id_control_acceso' => 'id']],
            [['id_sintoma_covid'], 'exist', 'skipOnError' => true, 'targetClass' => SintomasCovid::className(), 'targetAttribute' => ['id_sintoma_covid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_control_acceso' => 'Id Control Acceso',
            'id_sintoma_covid' => 'Id Sintoma Covid',
            'acceso' => 'Acceso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlAcceso()
    {
        return $this->hasOne(ControlAcceso::className(), ['id' => 'id_control_acceso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSintomaCov()
    {
        return $this->hasOne(SintomasCovid::className(), ['id' => 'id_sintoma_covid']);
    }
}
