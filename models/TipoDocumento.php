<?php

namespace app\models;

use yii\db\ActiveRecord;

use Yii;
use yii\base\Model;

class TipoDocumento extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'tipodocumento';
    }
	
	public function beforeSave($insert) {
	if(!parent::beforeSave($insert)){
            return false;
        }	       
	$this->descripcion = strtoupper($this->descripcion);
	
    return true;
    }
	
	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtipo', 'tipo', 'descripcion'], 'required', 'message' => 'Campo requerido'],
            [['tipo', 'descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtipo' => 'Id Tipo:',
            'tipo' => 'Tipo:',
            'descripcion' => 'Descripcion:',            
        ];
    }
}