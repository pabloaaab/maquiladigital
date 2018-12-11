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
 * @property int $cantidad_efectiva
 * @property int $cantidad_operada
 * @property int $totalsegundos
 * @property int $segundosficha
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
            [['idproducto', 'cantidad', 'idordenproduccion', 'generado', 'facturado','cantidad_operada','cantidad_efectiva'], 'integer'],
            [['vlrprecio', 'subtotal','ponderacion', 'porcentaje_proceso','porcentaje_cantidad','totalsegundos','segundosficha'], 'number'],
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
            'cantidad_efectiva' => 'Cantidad Efectiva',
            'cantidad_operada' => 'Cantidad operada',
            'totalsegundos' => 'Total Segundos',
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
