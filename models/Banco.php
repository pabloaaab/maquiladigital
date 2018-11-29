<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banco".
 *
 * @property string $idbanco
 * @property string $nitbanco
 * @property string $entidad
 * @property string $direccionbanco
 * @property string $telefonobanco
 * @property string $producto
 * @property string $numerocuenta
 * @property string $nitmatricula
 * @property string $activo
 */
class Banco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banco';
    }

    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->entidad = strtoupper($this->entidad);
        $this->direccionbanco = strtoupper($this->direccionbanco);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idbanco', 'nitbanco', 'entidad', 'direccionbanco', 'telefonobanco', 'producto', 'numerocuenta', 'nitmatricula', 'activo'], 'required', 'message' => 'Campo requerido'],
            [['idbanco'], 'string', 'max' => 10],
            [['nitbanco', 'telefonobanco', 'producto', 'numerocuenta', 'nitmatricula'], 'string', 'max' => 15],
            [['entidad', 'direccionbanco'], 'string', 'max' => 40],
            [['activo'], 'string', 'max' => 2],
            [['idbanco'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idbanco' => 'Id',
            'nitbanco' => 'Nit',
            'entidad' => 'Entidad',
            'direccionbanco' => 'Dirección',
            'telefonobanco' => 'Teléfono',
            'producto' => 'Producto',
            'numerocuenta' => 'Número Cuenta',
            'nitmatricula' => 'Nit Matricula',
            'activo' => 'Activo',
        ];
    }
}
