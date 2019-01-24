<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturaventadetalle".
 *
 * @property int $iddetallefactura
 * @property int $idfactura
 * @property int $idproductodetalle
 * @property string $codigoproducto
 * @property int $cantidad
 * @property double $preciounitario
 * @property double $total
 *
 * @property Productodetalle $productodetalle
 * @property Facturaventa $factura
 */
class Facturaventadetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturaventadetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfactura', 'idproductodetalle', 'codigoproducto', 'cantidad', 'preciounitario', 'total'], 'required'],
            [['idfactura', 'idproductodetalle', 'cantidad'], 'integer'],
            [['preciounitario', 'total'], 'number'],
            [['codigoproducto'], 'string', 'max' => 15],
            [['idproductodetalle'], 'exist', 'skipOnError' => true, 'targetClass' => Productodetalle::className(), 'targetAttribute' => ['idproductodetalle' => 'idproductodetalle']],
            [['idfactura'], 'exist', 'skipOnError' => true, 'targetClass' => Facturaventa::className(), 'targetAttribute' => ['idfactura' => 'idfactura']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetallefactura' => 'Iddetallefactura',
            'idfactura' => 'Idfactura',
            'idproductodetalle' => 'Idproductodetalle',
            'codigoproducto' => 'Codigoproducto',
            'cantidad' => 'Cantidad',
            'preciounitario' => 'Preciounitario',
            'total' => 'Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductodetalle()
    {
        return $this->hasOne(Productodetalle::className(), ['idproductodetalle' => 'idproductodetalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactura()
    {
        return $this->hasOne(Facturaventa::className(), ['idfactura' => 'idfactura']);
    }
}
