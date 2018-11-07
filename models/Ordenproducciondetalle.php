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
 * @property int $iddetalleproceso
 *
 * @property Producto $producto
 * @property Ordenproducciondetalleproceso $detalleproceso
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
            [['idproducto', 'cantidad', 'idordenproduccion', 'generado', 'facturado', 'porcentaje_proceso', 'iddetalleproceso'], 'integer'],
            [['vlrprecio', 'subtotal'], 'number'],
            [['codigoproducto'], 'string', 'max' => 15],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
            [['iddetalleproceso'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproducciondetalleproceso::className(), 'targetAttribute' => ['iddetalleproceso' => 'iddetalleproceso']],
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
            'iddetalleproceso' => 'Iddetalleproceso',
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
    public function getDetalleproceso()
    {
        return $this->hasOne(Ordenproducciondetalleproceso::className(), ['iddetalleproceso' => 'iddetalleproceso']);
    }
}
