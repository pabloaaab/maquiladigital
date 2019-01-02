<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property int $idproveedor
 * @property int $idtipo
 * @property int $cedulanit
 * @property int $dv
 * @property string $razonsocial
 * @property string $nombreproveedor
 * @property string $apellidoproveedor
 * @property string $nombrecorto
 * @property string $direccionproveedor
 * @property string $telefonoproveedor
 * @property string $celularproveedor
 * @property string $emailproveedor
 * @property string $contacto
 * @property string $telefonocontacto
 * @property string $celularcontacto
 * @property string $formapago
 * @property int $plazopago
 * @property string $iddepartamento
 * @property string $idmunicipio
 * @property string $nitmatricula
 * @property string $tiporegimen
 * @property int $autoretenedor
 * @property int $retencioniva
 * @property int $retencionfuente
 * @property string $observacion
 * @property string $fechaingreso
 *
 * @property Tipodocumento $tipo
 * @property Departamento $departamento
 * @property Municipio $municipio
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedor';
    }

    public function beforeSave($insert) {
	if(!parent::beforeSave($insert)){
            return false;
        }
	# ToDo: Cambiar a cliente cargada de configuración.    
	$this->nombreproveedor = strtoupper($this->nombreproveedor);
	$this->apellidoproveedor = strtoupper($this->apellidoproveedor);
	$this->razonsocial = strtoupper($this->razonsocial);
	$this->nombrecorto = strtoupper($this->nombrecorto);
	$this->direccionproveedor = strtoupper($this->direccionproveedor);
	$this->contacto = strtoupper($this->contacto);
	$this->observacion = strtoupper($this->observacion);	
        return true;
    }

    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Tipodocumento::className(), ['idtipo' => 'idtipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['iddepartamento' => 'iddepartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['idmunicipio' => 'idmunicipio']);
    }
    
    public function getNombreProveedores()
    {
        return "{$this->nombrecorto} - {$this->cedulanit}";
    }
}