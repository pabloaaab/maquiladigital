<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sucursal".
 *
 * @property int $id_sucursal
 * @property string $sucursal
 *
 * @property Empleado[] $empleados
 */
class Sucursal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sucursal';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->sucursal = strtoupper($this->sucursal);        
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sucursal'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sucursal' => 'Id',
            'sucursal' => 'Sucursal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['id_sucursal' => 'id_sucursal']);
    }
}
