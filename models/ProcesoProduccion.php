<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proceso_produccion".
 *
 * @property int $idproceso
 * @property string $proceso
 * @property int $estado
 *
 * @property Ordenproducciondetalleproceso[] $ordenproducciondetalleprocesos
 */
class ProcesoProduccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proceso_produccion';
    }

    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)){
            return false;
        }
        $this->proceso = strtoupper($this->proceso);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proceso'], 'required','message'=> 'Campo obligatorio'],
            [['estado','estandarizado'], 'integer'],
           [['segundos','minutos'], 'number'],
            [['proceso'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproceso' => 'Id',
            'proceso' => 'Operación',
            'estado' => 'Estado',
            'segundos' => 'Segundos',
            'minutos' => 'Minutos',
            'estandarizado' => 'Estandar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproducciondetalleprocesos()
    {
        return $this->hasMany(Ordenproducciondetalleproceso::className(), ['idproceso' => 'idproceso']);
    }
    
    public function getEstandar(){
        if ($this->estandarizado == 1){
            $estandarizado = 'SI';
        }else{
            $estandarizado = 'NO';
        }
        return $estandarizado;
    } 
     public function getActivoRegistro(){
        if ($this->estado == 0){
            $estadoregistro = 'SI';
        }else{
            $estadoregistro = 'NO';
        }
        return $estadoregistro;
    } 
}
