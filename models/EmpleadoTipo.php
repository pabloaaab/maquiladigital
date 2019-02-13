<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleado_tipo".
 *
 * @property int $id_empleado_tipo
 * @property string $tipo
 *
 * @property Empleado[] $empleados
 */
class EmpleadoTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleado_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_empleado_tipo' => 'Id Empleado Tipo',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['id_empleado_tipo' => 'id_empleado_tipo']);
    }
}
