<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sintomas_covid".
 *
 * @property int $id
 * @property string $sintoma
 *
 * @property ControlAcceso[] $controlAccesos
 */
class SintomasCovid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sintomas_covid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sintoma'], 'required'],
            [['sintoma'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sintoma' => 'Sintoma',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlAccesos()
    {
        return $this->hasMany(ControlAcceso::className(), ['id_sintomas_covid' => 'id']);
    }
}
