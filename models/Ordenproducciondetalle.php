<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenproducciondetalle".
 *
 * @property int $iddetalleorden
 * @property int $idproducto
 * @property int $cantidad
 * @property double $vlrprecio
 * @property double $subtotal
 * @property int $idordenproduccion
 *
 * @property Producto $producto
 * @property Ordenproduccion $ordenproduccion
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
            [['idproducto', 'cantidad', 'vlrprecio', 'subtotal', 'idordenproduccion'], 'required', 'message' => 'Campo requerido'],
            [['idproducto', 'cantidad', 'idordenproduccion'], 'integer'],
            [['vlrprecio', 'subtotal'], 'number'],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
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
            'cantidad' => 'Cantidad',
            'vlrprecio' => 'Vlrprecio',
            'subtotal' => 'Subtotal',
            'idordenproduccion' => 'Idordenproduccion',
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
    public function getOrdenproduccion()
    {
        return $this->hasOne(Ordenproduccion::className(), ['idordenproduccion' => 'idordenproduccion']);
    }
}
