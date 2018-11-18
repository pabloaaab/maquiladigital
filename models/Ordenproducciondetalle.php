<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenproducciondetalle".
 *
 * @property int $iddetalleorden
 * @property int $idproducto
 * @property string $codigoproducto
 * @property int $cantidad
 * @property double $vlrprecio
 * @property double $subtotal
 * @property int $idordenproduccion
 * @property int $generado
 * @property int $facturado
 * @property int $porcentaje_proceso
 * @property int $porcentaje_cantidad
 * @property int $ponderacion
 * @property int $cantidad_operada
 *
 * @property Producto $producto
 * @property Ordenproducciondetalleproceso[] $ordenproducciondetalleprocesos
 */
class Ordenproducciondetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenproducciondetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproducto', 'codigoproducto', 'cantidad', 'vlrprecio', 'idordenproduccion'], 'required'],
            [['idproducto', 'cantidad', 'idordenproduccion', 'generado', 'facturado', 'porcentaje_proceso','porcentaje_cantidad','cantidad_operada'], 'integer'],
            [['vlrprecio', 'subtotal','ponderacion'], 'number'],
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
            'iddetalleorden' => 'Iddetalleorden',
            'idproducto' => 'Idproducto',
            'codigoproducto' => 'Codigoproducto',
            'cantidad' => 'Cantidad',
            'vlrprecio' => 'Vlrprecio',
            'subtotal' => 'Subtotal',
            'idordenproduccion' => 'Idordenproduccion',
            'generado' => 'Generado',
            'facturado' => 'Facturado',
            'porcentaje_proceso' => 'Porcentaje Proceso',
            'porcentaje_cantidad' => 'Porcentaje Cantidad',
            'ponderacion' => 'Ponderación',
            'cantidad_operada' => 'Cantidad operada',
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
    public function getOrdenproducciondetalleprocesos()
    {
        return $this->hasMany(Ordenproducciondetalleproceso::className(), ['iddetalleorden' => 'iddetalleorden']);
    }
}
