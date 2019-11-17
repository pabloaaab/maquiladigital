<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "caja_compensacion".
 *
 * @property int $id_caja_compensacion
 * @property string $caja
 * @property int $estado
 *
 * @property Contrato[] $contratos
 */
class CajaCompensacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caja_compensacion';
    }

    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->caja = strtoupper($this->caja);        
        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caja'], 'required'],
            [['estado'], 'integer'],
            [['caja'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_caja_compensacion' => 'Id',
            'caja' => 'Caja',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['id_caja_compensacion' => 'id_caja_compensacion']);
    }
    
    public function getActivo()
    {
        if($this->estado == 1){
            $estado = "SI";
        }else{
            $estado = "NO";
        }
        return $estado;
    }
}
