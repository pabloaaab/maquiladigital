<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orden_produccion_tercero_detalle".
 *
 * @property int $id_detalle
 * @property int $id_orden_tercero
 * @property int $idproductodetalle
 * @property int $cantidad
 * @property int $vlr_minuto
 * @property int $total_pagar
 *
 * @property OrdenProduccionTercero $ordenTercero
 * @property Productodetalle $productodetalle
 */
class OrdenProduccionTerceroDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orden_produccion_tercero_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_orden_tercero', 'idproductodetalle', 'cantidad'], 'required'],
            [['id_orden_tercero', 'idproductodetalle', 'cantidad', 'vlr_minuto', 'total_pagar'], 'integer'],
            [['id_orden_tercero'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenProduccionTercero::className(), 'targetAttribute' => ['id_orden_tercero' => 'id_orden_tercero']],
            [['idproductodetalle'], 'exist', 'skipOnError' => true, 'targetClass' => Productodetalle::className(), 'targetAttribute' => ['idproductodetalle' => 'idproductodetalle']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detalle' => 'Id Detalle',
            'id_orden_tercero' => 'Id Orden Tercero',
            'idproductodetalle' => 'Idproductodetalle',
            'cantidad' => 'Cantidad',
            'vlr_minuto' => 'Vlr Minuto',
            'total_pagar' => 'Total Pagar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenTercero()
    {
        return $this->hasOne(OrdenProduccionTercero::className(), ['id_orden_tercero' => 'id_orden_tercero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductodetalle()
    {
        return $this->hasOne(Productodetalle::className(), ['idproductodetalle' => 'idproductodetalle']);
    }
}
