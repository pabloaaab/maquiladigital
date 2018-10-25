<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturaventadetalle".
 *
 * @property int $iddetallefactura
 * @property int $idfactura
 * @property int $idproducto
 * @property string $codigoproducto
 * @property int $cantidad
 * @property double $preciounitario
 * @property double $total
 *
 * @property Producto $producto
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
            [['idfactura', 'idproducto', 'codigoproducto', 'cantidad', 'preciounitario', 'total'], 'required'],
            [['idfactura', 'idproducto', 'cantidad'], 'integer'],
            [['preciounitario', 'total'], 'number'],
            [['codigoproducto'], 'string', 'max' => 15],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
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
            'idproducto' => 'Idproducto',
            'codigoproducto' => 'Codigoproducto',
            'cantidad' => 'Cantidad',
            'preciounitario' => 'Preciounitario',
            'total' => 'Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactura()
    {
        return $this->hasOne(Facturaventa::className(), ['idfactura' => 'idfactura']);
    }
}
