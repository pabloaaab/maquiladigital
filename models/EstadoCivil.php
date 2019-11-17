<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_civil".
 *
 * @property int $id_estado_civil
 * @property string $estado_civil
 *
 * @property Empleado[] $empleados
 */
class EstadoCivil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_civil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado_civil'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estado_civil' => 'Id Estado Civil',
            'estado_civil' => 'Estado Civil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['id_estado_civil' => 'id_estado_civil']);
    }
}
