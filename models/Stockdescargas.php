<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stockdescargas".
 *
 * @property int $idstockorden
 * @property string $fecha
 * @property int $stock
 * @property int $idfactura
 * @property int $nrofactura
 * @property int $idordenproduccion
 * @property int $idproducto
 * @property string $observacion
 *
 * @property Facturaventa $factura
 * @property Ordenproduccion $ordenproduccion
 * @property Producto $producto
 */
class Stockdescargas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stockdescargas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha'], 'safe'],
            [['stock', 'idfactura', 'nrofactura', 'idordenproduccion', 'idproducto'], 'integer'],
            [['observacion'], 'string'],
            [['idfactura'], 'exist', 'skipOnError' => true, 'targetClass' => Facturaventa::className(), 'targetAttribute' => ['idfactura' => 'idfactura']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idstockorden' => 'Idstockorden',
            'fecha' => 'Fecha',
            'stock' => 'Stock',
            'idfactura' => 'Idfactura',
            'nrofactura' => 'Nrofactura',
            'idordenproduccion' => 'Idordenproduccion',
            'idproducto' => 'Idproducto',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactura()
    {
        return $this->hasOne(Facturaventa::className(), ['idfactura' => 'idfactura']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproduccion()
    {
        return $this->hasOne(Ordenproduccion::className(), ['idordenproduccion' => 'idordenproduccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['idproducto' => 'idproducto']);
    }
}
