<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "talla".
 *
 * @property int $idtalla
 * @property string $talla
 * @property string $sexo
 *
 * @property Prendatipo[] $prendatipos
 */
class Talla extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'talla';
    }

    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)){
            return false;
        }
        $this->talla = strtoupper($this->talla);
        $this->sexo = strtoupper($this->sexo);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['talla', 'sexo'], 'required', 'message' => 'Campor requerido'],
            [['talla'], 'string', 'max' => 40],
            [['sexo'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtalla' => 'Idtalla',
            'talla' => 'Talla',
            'sexo' => 'Sexo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrendatipos()
    {
        return $this->hasMany(Prendatipo::className(), ['idtalla' => 'idtalla']);
    }

    public function getTindex()
    {
        return "{$this->talla} - {$this->sexo}";
    }
}
