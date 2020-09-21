<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_estudios".
 *
 * @property int $id_tipo_estudio
 * @property string $estudio
 */
class TipoEstudios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_estudios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estudio'], 'required'],
            [['estudio'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_estudio' => 'Id Tipo Estudio',
            'estudio' => 'Estudio',
        ];
    }
}
