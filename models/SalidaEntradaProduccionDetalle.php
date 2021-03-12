<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salida_entrada_produccion_detalle".
 *
 * @property int $consecutivo
 * @property int $id_salida
 * @property int $idproductodetalle
 * @property int $cantidad
 * @property string $fecha_creacion
 *
 * @property SalidaEntradaProduccion $salida
 * @property Productodetalle $productodetalle
 */
class SalidaEntradaProduccionDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'salida_entrada_produccion_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_salida', 'cantidad'], 'required'],
            [['id_salida', 'idproductodetalle', 'cantidad'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['id_salida'], 'exist', 'skipOnError' => true, 'targetClass' => SalidaEntradaProduccion::className(), 'targetAttribute' => ['id_salida' => 'id_salida']],
            [['idproductodetalle'], 'exist', 'skipOnError' => true, 'targetClass' => Productodetalle::className(), 'targetAttribute' => ['idproductodetalle' => 'idproductodetalle']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'consecutivo' => 'Consecutivo',
            'id_salida' => 'Id Salida',
            'idproductodetalle' => 'Idproductodetalle',
            'cantidad' => 'Cantidad',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalida()
    {
        return $this->hasOne(SalidaEntradaProduccion::className(), ['id_salida' => 'id_salida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductodetalle()
    {
        return $this->hasOne(Productodetalle::className(), ['idproductodetalle' => 'idproductodetalle']);
    }
}
