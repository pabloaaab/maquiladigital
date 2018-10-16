<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturaventadetalle".
 *
 * @property int $idetallefactura
 * @property int $nrofactura
 * @property int $idproducto
 * @property string $codigoproducto
 * @property int $cantidad
 * @property double $preciounitario
 * @property double $total
 *
 * @property Producto $producto
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
            [['nrofactura', 'idproducto', 'codigoproducto', 'cantidad', 'preciounitario', 'total'], 'required', 'message' => 'Campo requerido'],
            [['nrofactura', 'idproducto', 'cantidad'], 'integer'],
            [['preciounitario', 'total'], 'number'],
            [['codigoproducto'], 'string', 'max' => 15],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idetallefactura' => 'Idetallefactura',
            'nrofactura' => 'Nrofactura',
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
}
