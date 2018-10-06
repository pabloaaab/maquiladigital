<?php

namespace app\models;

use yii\db\ActiveRecord;

use Yii;
use yii\base\Model;

class Cliente extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'cliente';
    }

    /**
 * @return \yii\db\ActiveQuery
 */
    public function getIdMunicipioFk()
    {
        return $this->hasOne(Municipio::className(), ['idmunicipio' => 'idmunicipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoFk()
    {
        return $this->hasOne(TipoDocumento::className(), ['idtipo' => 'idtipo']);
    }

}