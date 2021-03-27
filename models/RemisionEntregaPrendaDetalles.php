<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "remision_entrega_prenda_detalles".
 *
 * @property int $id_detalle
 * @property int $id_producto
 * @property int $cantidad
 * @property int $valor_unitario
 * @property double $porcentaje_descuento
 * @property int $valor_descuento
 * @property int $total_linea
 * @property int $id_remision
 *
 * @property CostoProducto $producto
 * @property RemisionEntregaPrendas $remision
 */
class RemisionEntregaPrendaDetalles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'remision_entrega_prenda_detalles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'cantidad', 'valor_unitario'], 'required'],
            [['id_referencia', 'cantidad', 'valor_unitario', 'valor_descuento', 'total_linea', 'id_remision'], 'integer'],
            [['porcentaje_descuento'], 'number'],
            [['codigo_producto'], 'string'],
            [['id_referencia'], 'exist', 'skipOnError' => true, 'targetClass' => Referencias::className(), 'targetAttribute' => ['id_referencia' => 'id_referencia']],
            [['id_remision'], 'exist', 'skipOnError' => true, 'targetClass' => RemisionEntregaPrendas::className(), 'targetAttribute' => ['id_remision' => 'id_remision']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detalle' => 'Id Detalle',
            'id_referencia' => 'Referencia',
            'cantidad' => 'Cantidad',
            'valor_unitario' => 'Valor Unitario',
            'porcentaje_descuento' => 'Porcentaje Descuento',
            'valor_descuento' => 'Valor Descuento',
            'total_linea' => 'Total Linea',
            'id_remision' => 'Id Remision',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferencias()
    {
        return $this->hasOne(Referencias::className(), ['id_referencia' => 'id_referencia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemision()
    {
        return $this->hasOne(RemisionEntregaPrendas::className(), ['id_remision' => 'id_remision']);
    }
}
