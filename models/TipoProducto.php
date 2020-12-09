<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_producto".
 *
 * @property int $id_tipo_producto
 * @property string $concepto
 * @property int $estado
 */
class TipoProducto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['concepto', 'estado'], 'required'],
            [['estado'], 'integer'],
            [['concepto'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_producto' => 'Id Tipo Producto',
            'concepto' => 'Concepto',
            'estado' => 'Estado',
        ];
    }
}
