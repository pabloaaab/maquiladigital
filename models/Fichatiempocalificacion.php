<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fichatiempocalificacion".
 *
 * @property int $id
 * @property double $rango1
 * @property double $rango2
 * @property string $observacion
 */
class Fichatiempocalificacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fichatiempocalificacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rango1', 'rango2'], 'required'],
            [['rango1', 'rango2'], 'number'],
            [['observacion'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rango1' => 'Rango1',
            'rango2' => 'Rango2',
            'observacion' => 'Observacion',
        ];
    }
}
