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
	
	public function beforeSave($insert) {
	if(!parent::beforeSave($insert)){
            return false;
        }
	       
	$this->nombrecliente = strtoupper($this->nombrecliente);
	$this->apellidocliente = strtoupper($this->apellidocliente);
	$this->direccioncliente = strtoupper($this->direccioncliente);
	$this->contacto = strtoupper($this->contacto);
	$this->observacion = strtoupper($this->observacion);
	$this->razonsocial = strtoupper($this->razonsocial);
	
        return true;
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
    public function getIdDepartamentoFk()
    {
        return $this->hasOne(Departamentos::className(), ['iddepartamento' => 'iddepartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoFk()
    {
        return $this->hasOne(TipoDocumento::className(), ['idtipo' => 'idtipo']);
    }

}