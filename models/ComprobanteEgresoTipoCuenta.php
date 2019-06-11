<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comprobante_egreso_tipo_cuenta".
 *
 * @property int $id_comprobante_egreso_tipo_cuenta
 * @property int $cuenta
 * @property int $tipocuenta
 * @property int $base
 * @property int $id_comprobante_egreso_tipo
 *
 * @property ComprobanteEgresoTipo $comprobanteEgresoTipo
 */
class ComprobanteEgresoTipoCuenta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comprobante_egreso_tipo_cuenta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cuenta', 'tipocuenta'], 'required'],
            [['cuenta', 'tipocuenta', 'base', 'id_comprobante_egreso_tipo'], 'integer'],
            [['id_comprobante_egreso_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => ComprobanteEgresoTipo::className(), 'targetAttribute' => ['id_comprobante_egreso_tipo' => 'id_comprobante_egreso_tipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_comprobante_egreso_tipo_cuenta' => 'Id Comprobante Egreso Tipo Cuenta',
            'cuenta' => 'Cuenta',
            'tipocuenta' => 'Tipocuenta',
            'base' => 'Base',
            'id_comprobante_egreso_tipo' => 'Id Comprobante Egreso Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComprobanteEgresoTipo()
    {
        return $this->hasOne(ComprobanteEgresoTipo::className(), ['id_comprobante_egreso_tipo' => 'id_comprobante_egreso_tipo']);
    }
}
