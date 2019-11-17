<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cesantia".
 *
 * @property int $id_cesantia
 * @property string $cesantia
 * @property int $estado
 *
 * @property Contrato[] $contratos
 */
class Cesantia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cesantia';
    }

    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->cesantia = strtoupper($this->cesantia);        
        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cesantia'], 'required'],
            [['estado'], 'integer'],
            [['cesantia'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cesantia' => 'Id Cesantia',
            'cesantia' => 'Cesantia',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['id_cesantia' => 'id_cesantia']);
    }
    
    public function getActivo()
    {
        if($this->estado == 1){
            $estado = "SI";
        }else{
            $estado = "NO";
        }
        return $estado;
    }
}
