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
}