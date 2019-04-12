<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenproducciontipo".
 *
 * @property int $idtipo
 * @property string $tipo
 * @property int $remision
 * @property int $activo
 *
 * @property Ordenproduccion[] $ordenproduccions
 */
class Ordenproducciontipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenproducciontipo';
    }

    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)){
            return false;
        }
        $this->tipo = strtoupper($this->tipo);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['activo'], 'integer'],
            [['remision'], 'integer'],
            [['tipo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtipo' => 'Id',
            'tipo' => 'Tipo',
            'activo' => 'Activo',
            'remision' => 'Requiere Remisión',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproduccions()
    {
        return $this->hasMany(Ordenproduccion::className(), ['idtipo' => 'idtipo']);
    }
    
    public function getEstado()
    {
        if($this->activo == 1){
            $estado = "NO";
        }else{
            $estado = "SI";
        }
        return $estado;
    }
    
    public function getRremision()
    {
        if($this->remision == 1){
            $remision = "SI";
        }else{
            $remision = "NO";
        }
        return $remision;
    }
}
