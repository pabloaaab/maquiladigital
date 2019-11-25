<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo_pago".
 *
 * @property int $id_grupo_pago
 * @property string $grupo_pago
 * @property int $estado
 *
 * @property Contrato[] $contratos
 */
class GrupoPago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grupo_pago';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->grupo_pago = strtoupper($this->grupo_pago);        
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'integer'],
            [['grupo_pago'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_grupo_pago' => 'Id Grupo Pago',
            'grupo_pago' => 'Grupo Pago',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['id_grupo_pago' => 'id_grupo_pago']);
    }
    
    public function getActivo()
    {
        if($this->estado == 1){
            $activo = "SI";
        }else{
            $activo = "NO";
        }
        return $activo;
    }
}
