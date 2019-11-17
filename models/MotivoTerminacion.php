<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "motivo_terminacion".
 *
 * @property int $id_motivo_terminacion
 * @property string $motivo
 *
 * @property Contrato[] $contratos
 */
class MotivoTerminacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motivo_terminacion';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->motivo = strtoupper($this->motivo);        
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['motivo'], 'required'],
            [['motivo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_motivo_terminacion' => 'Id',
            'motivo' => 'Motivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['id_motivo_terminacion' => 'id_motivo_terminacion']);
    }
}
