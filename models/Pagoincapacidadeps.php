<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagoincapacidadeps".
 *
 * @property int $id_pago
 * @property int $nro_pago
 * @property int $id_entidad_salud
 * @property string $fecha_pago_entidad
 * @property string $fecha_registro
 * @property int $valor_pago
 * @property int $idbanco
 * @property string $usuariosistema
 * @property string $observacion
 *
 * @property PagoincacidadepsDetalle[] $pagoincacidadepsDetalles
 * @property EntidadSalud $entidadSalud
 * @property Banco $banco
 */
class Pagoincapacidadeps extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pagoincapacidadeps';
    }
    public function beforeSave($insert) {
            if (!parent::beforeSave($insert)) {
                return false;
            }
   
            $this->observacion = strtolower($this->observacion); 
            $this->observacion = ucfirst($this->observacion);  
            return true;
        }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nro_pago', 'id_entidad_salud', 'valor_pago', 'idbanco','autorizado'], 'integer'],
            [['id_entidad_salud', 'fecha_pago_entidad', 'idbanco'], 'required'],
            [['fecha_pago_entidad', 'fecha_registro'], 'safe'],
            [['usuariosistema'], 'string', 'max' => 20],
            [['observacion'], 'string', 'max' => 100],
            [['id_entidad_salud'], 'exist', 'skipOnError' => true, 'targetClass' => EntidadSalud::className(), 'targetAttribute' => ['id_entidad_salud' => 'id_entidad_salud']],
            [['idbanco'], 'exist', 'skipOnError' => true, 'targetClass' => Banco::className(), 'targetAttribute' => ['idbanco' => 'idbanco']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pago' => 'Id Pago',
            'nro_pago' => 'Nro Pago',
            'id_entidad_salud' => 'Id Entidad Salud',
            'fecha_pago_entidad' => 'Fecha Pago Entidad',
            'fecha_registro' => 'Fecha Registro',
            'valor_pago' => 'Valor Pago',
            'idbanco' => 'Idbanco',
            'usuariosistema' => 'Usuariosistema',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagoincacidadepsDetalles()
    {
        return $this->hasMany(PagoincacidadepsDetalle::className(), ['id_pago' => 'id_pago']);
    }
   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntidadSalud()
    {
        return $this->hasOne(EntidadSalud::className(), ['id_entidad_salud' => 'id_entidad_salud']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanco()
    {
        return $this->hasOne(Banco::className(), ['idbanco' => 'idbanco']);
    }
    
    public function getAutorizadoPago() {
      
        if($this->autorizado == 1){
            $autorizadoproceso = 'SI';
        }else{
            $autorizadoproceso = 'NO';
        }   
        return $autorizadoproceso;
    }
}

