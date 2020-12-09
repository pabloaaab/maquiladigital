<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costo_producto_detalle".
 *
 * @property int $id
 * @property int $id_producto
 * @property int $id_insumos
 * @property double $cantidad
 * @property double $vlr_unitario
 * @property int $total
 *
 * @property CostoProducto $producto
 * @property Insumos $insumos
 */
class CostoProductoDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'costo_producto_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'id_insumos', 'cantidad'], 'required'],
            [['id_producto', 'id_insumos', 'total'], 'integer'],
            [['cantidad', 'vlr_unitario'], 'number'],
            [['codigo_insumo'], 'string', 'max' => 80],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => CostoProducto::className(), 'targetAttribute' => ['id_producto' => 'id_producto']],
            [['id_insumos'], 'exist', 'skipOnError' => true, 'targetClass' => Insumos::className(), 'targetAttribute' => ['id_insumos' => 'id_insumos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_producto' => 'Id Producto',
            'id_insumos' => 'Id Insumos',
            'cantidad' => 'Cantidad',
            'vlr_unitario' => 'Vlr Unitario',
            'total' => 'Total',
            'codigo_insumo' => 'Codigo insumo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(CostoProducto::className(), ['id_producto' => 'id_producto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasOne(Insumos::className(), ['id_insumos' => 'id_insumos']);
    }
}
