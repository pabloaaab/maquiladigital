<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rh".
 *
 * @property int $id_rh
 * @property resource $rh
 *
 * @property Empleado[] $empleados
 */
class Rh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rh'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rh' => 'Id Rh',
            'rh' => 'Rh',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['id_rh' => 'id_rh']);
    }
}
