<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamento".
 *
 * @property int $iddepartamento
 * @property string $nombredepartamento
 * @property string $activo
 *
 * @property Cliente[] $clientes
 * @property Municipio[] $municipios
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddepartamento', 'nombredepartamento', 'activo'], 'required'],
            [['iddepartamento'], 'integer'],
            [['nombredepartamento'], 'string', 'max' => 40],
            [['activo'], 'string', 'max' => 2],
            [['iddepartamento'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddepartamento' => 'Iddepartamento',
            'nombredepartamento' => 'Nombredepartamento',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['iddepartamento' => 'iddepartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipio::className(), ['iddepartamento' => 'iddepartamento']);
    }
}
