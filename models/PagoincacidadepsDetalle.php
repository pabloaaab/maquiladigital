<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagoincacidadeps_detalle".
 *
 * @property int $id
 * @property int $id_pago
 * @property int $id_incapacidad
 * @property int $vlr_pago_administradora
 * @property int $vlr_saldo
 *
 * @property Pagoincapacidadeps $pago
 * @property Incapacidad $incapacidad
 */
class PagoincacidadepsDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pagoincacidadeps_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pago', 'id_incapacidad'], 'required'],
            [['id_pago', 'id_incapacidad', 'vlr_pago_administradora', 'vlr_saldo','abono','vlr_saldo'], 'integer'],
            [['id_pago'], 'exist', 'skipOnError' => true, 'targetClass' => Pagoincapacidadeps::className(), 'targetAttribute' => ['id_pago' => 'id_pago']],
            [['id_incapacidad'], 'exist', 'skipOnError' => true, 'targetClass' => Incapacidad::className(), 'targetAttribute' => ['id_incapacidad' => 'id_incapacidad']],
            [['codigo_incapacidad'], 'exist', 'skipOnError' => true, 'targetClass' => ConfiguracionIncapacidad::className(), 'targetAttribute' => ['codigo_incapacidad' => 'codigo_incapacidad']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pago' => 'Id Pago',
            'id_incapacidad' => 'Id Incapacidad',
            'vlr_pago_administradora' => 'Vlr Pago Administradora',
            'vlr_saldo' => 'Vlr Saldo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPago()
    {
        return $this->hasOne(Pagoincapacidadeps::className(), ['id_pago' => 'id_pago']);
    }
    public function getCodigoIncapacidad()
    {
        return $this->hasOne(ConfiguracionIncapacidad::className(), ['codigo_incapacidad' => 'codigo_incapacidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncapacidad()
    {
        return $this->hasOne(Incapacidad::className(), ['id_incapacidad' => 'id_incapacidad']);
    }
}
