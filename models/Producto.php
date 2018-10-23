<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $idproducto
 * @property string $codigoproducto
 * @property string $producto
 * @property int $cantidad
 * @property int $stock
 * @property int $costoconfeccion
 * @property int $vlrventa
 * @property int $idcliente
 * @property string $observacion
 * @property string $activo
 * @property string $fechaproceso
 * @property string $usuariosistema
 *
 * @property Cliente $cliente
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigoproducto', 'producto', 'cantidad', 'stock', 'costoconfeccion', 'vlrventa', 'idcliente', 'observacion', ], 'required', 'message' => 'Campo requerido'],
            [['cantidad', 'stock', 'costoconfeccion', 'vlrventa', 'idcliente'], 'integer'],
            [['observacion'], 'string'],
            [['fechaproceso'], 'safe'],
            [['codigoproducto', 'usuariosistema'], 'string', 'max' => 15],
            [['producto'], 'string', 'max' => 40],
            [['activo'], 'string', 'max' => 2],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproducto' => 'Idproducto:',
            'codigoproducto' => 'Codigo:',
            'producto' => 'Producto:',
            'cantidad' => 'Cantidad:',
            'stock' => 'Stock:',
            'costoconfeccion' => 'Costo Confección:',
            'vlrventa' => 'Valor Venta:',
            'idcliente' => 'Idcliente:',
            'observacion' => 'Observación:',
            'activo' => 'Activo:',
            'fechaproceso' => 'Fecha Proceso:',
            'usuariosistema' => 'Usuariosistema:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['idcliente' => 'idcliente']);
    }


}
