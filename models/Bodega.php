<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bodega".
 *
 * @property int $id_bodega
 * @property string $descripcion
 * @property int $estado
 */
class Bodega extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bodega';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['estado'], 'integer'],
            [['descripcion'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_bodega' => 'Id Bodega',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
        ];
    }
}
