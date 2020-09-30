<?php

namespace app\models;

use Yii;
 
/**
 * This is the model class for table "arl".
 *
 * @property int $id_arl
 * @property double $arl
 */
class Arl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['arl'], 'required','message' => 'Campo requerido'],
            [['arl'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_arl' => 'Id Arl',
            'arl' => 'Arl %',
        ];
    }
}
