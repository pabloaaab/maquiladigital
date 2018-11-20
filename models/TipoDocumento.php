<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipodocumento".
 *
 * @property int $idtipo
 * @property string $tipo
 * @property string $descripcion
 *
 * @property Cliente[] $clientes
 */
class Tipodocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipodocumento';
    }

    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)){
            return false;
        }	       
        $this->descripcion = strtoupper($this->descripcion);
        $this->tipo = strtoupper($this->tipo);
        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'descripcion'], 'required', 'message' => 'Campo requerido'],
            [['tipo'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtipo' => 'Idtipo',
            'tipo' => 'Tipo',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['idtipo' => 'idtipo']);
    }
}
