<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banco_empleado".
 *
 * @property int $id_banco_empleado
 * @property string $banco
 * @property string $codigo_interfaz
 *
 * @property Empleado[] $empleados
 */
class BancoEmpleado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banco_empleado';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->banco = strtoupper($this->banco);        
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['banco'], 'string', 'max' => 50],
            [['codigo_interfaz'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_banco_empleado' => 'Id',
            'banco' => 'Banco',
            'codigo_interfaz' => 'Codigo Interfaz',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['id_banco_empleado' => 'id_banco_empleado']);
    }
}
