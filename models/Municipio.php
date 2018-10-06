<?php

namespace app\models;

use yii\db\ActiveRecord;

use Yii;
use yii\base\Model;

class Municipio extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'municipio';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartamentoFk()
    {
        return $this->hasOne(TblDepartamentos::className(), ['iddepartamento' => 'iddepartamento']);
    }
}