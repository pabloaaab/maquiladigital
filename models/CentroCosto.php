<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "centro_costo".
 *
 * @property int $id_centro_costo
 * @property string $centro_costo
 *
 * @property Empleado[] $empleados
 */
class CentroCosto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'centro_costo';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->centro_costo = strtoupper($this->centro_costo);        
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['centro_costo'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_centro_costo' => 'Id',
            'centro_costo' => 'Centro Costo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['id_centro_costo' => 'id_centro_costo']);
    }
}
