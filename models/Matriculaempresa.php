<?php

namespace app\models;

use yii\db\ActiveRecord;

use Yii;
use yii\base\Model;

class Matriculaempresa extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'matriculaempresa';
    }

	public function beforeSave($insert) {
	if(!parent::beforeSave($insert)){
            return false;
        }	       
	$this->razonsocialmatricula = strtoupper($this->razonsocialmatricula);
	$this->nombrematricula = strtoupper($this->nombrematricula);
	$this->apellidomatricula = strtoupper($this->apellidomatricula);
	$this->direccionmatricula = strtoupper($this->direccionmatricula);
    return true;
    }
}