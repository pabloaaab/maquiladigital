<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago_adicional_fecha".
 *
 * @property int $id_pago_fecha
 * @property string $fecha_corte
 * @property string $fecha_creacion
 * @property string $detalle
 * @property int $estado_proceso
 * @property string $usuariosistema
 *
 * @property PagoAdicionalPermanente $pagoFecha
 */
class PagoAdicionalFecha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pago_adicional_fecha';
    }

     public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->detalle = strtolower($this->detalle); 
        $this->detalle = ucfirst($this->detalle);  
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_corte'], 'required'],
            [['fecha_corte'], 'safe'],
            [['estado_proceso'], 'integer'],
            [['detalle'], 'string', 'max' => 30],
            
            [['id_pago_fecha'], 'exist', 'skipOnError' => true, 'targetClass' => PagoAdicionalPermanente::className(), 'targetAttribute' => ['id_pago_fecha' => 'id_pago_permanente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fecha_corte' => 'Fecha Corte:',
            'detalle' => 'Detalle:',
            'estado_proceso' => 'Abierto/Cerrado:',
       ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagoFecha()
    {
        return $this->hasOne(PagoAdicionalPermanente::className(), ['id_pago_permanente' => 'id_pago_fecha']);
    }
    
    public function getEstadoproceso(){
        if($this->estado_proceso == 1){
            $estadoproceso = "ABIERTO";
        }else{
            $estadoproceso = "CERRADO";
        }
        return $estadoproceso;
    }
}
