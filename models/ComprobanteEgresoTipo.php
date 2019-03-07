<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comprobante_egreso_tipo".
 *
 * @property int $id_comprobante_egreso_tipo
 * @property string $concepto
 * @property int $activo
 *
 * @property ComprobanteEgreso[] $comprobanteEgresos
 */
class ComprobanteEgresoTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comprobante_egreso_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['concepto'], 'required'],
            [['activo'], 'integer'],
            [['concepto'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_comprobante_egreso_tipo' => 'Id Comprobante Egreso Tipo',
            'concepto' => 'Concepto',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComprobanteEgresos()
    {
        return $this->hasMany(ComprobanteEgreso::className(), ['id_comprobante_egreso_tipo' => 'id_comprobante_egreso_tipo']);
    }
}
