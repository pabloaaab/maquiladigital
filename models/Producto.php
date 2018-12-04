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
 * @property int $activo
 * @property string $fechaproceso
 * @property string $usuariosistema
 * @property int $idprendatipo
 * @property int $idtipo
 * 
 * @property Facturaventadetalle[] $facturaventadetalles
 * @property Ordenproducciondetalle[] $ordenproducciondetalles
 * @property Cliente $cliente
 * @property Prendatipo $prendatipo
 * @property Ordenproducciontipo $ordenproducciontipo
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

    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)){
            return false;
        }
        $this->producto = strtoupper($this->producto);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigoproducto', 'producto', 'cantidad', 'costoconfeccion', 'vlrventa', 'idcliente', 'idprendatipo', 'idtipo'], 'required', 'message' => 'Campo requerido'],
            [['cantidad', 'stock', 'idcliente', 'activo', 'idprendatipo', 'idtipo'], 'integer'],
            [['costoconfeccion','vlrventa'],'number'],
            [['observacion'], 'string'],
            [['fechaproceso'], 'safe'],
            [['codigoproducto', 'usuariosistema'], 'string', 'max' => 15],
            [['producto'], 'string', 'max' => 40],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idprendatipo'], 'exist', 'skipOnError' => true, 'targetClass' => Prendatipo::className(), 'targetAttribute' => ['idprendatipo' => 'idprendatipo']],
            [['idtipo'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproducciontipo::className(), 'targetAttribute' => ['idtipo' => 'idtipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproducto' => 'Id',
            'codigoproducto' => 'Cod Producto',
            'producto' => 'Producto',
            'cantidad' => 'Cantidad',
            'stock' => 'Stock',
            'costoconfeccion' => 'Costo Confeccion',
            'vlrventa' => 'Vlr Venta',
            'idcliente' => 'Cliente',
            'observacion' => 'Observacion',
            'activo' => 'Activo',
            'fechaproceso' => 'Fecha Proceso',
            'usuariosistema' => 'Usuario Sistema',
            'idprendatipo' => 'Prenda Tipo',
            'idtipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaventadetalles()
    {
        return $this->hasMany(Facturaventadetalle::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproducciondetalles()
    {
        return $this->hasMany(Ordenproducciondetalle::className(), ['idproducto' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['idcliente' => 'idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrendatipo()
    {
        return $this->hasOne(Prendatipo::className(), ['idprendatipo' => 'idprendatipo']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproducciontipo()
    {
        return $this->hasOne(Ordenproducciontipo::className(), ['idtipo' => 'idtipo']);
    }

    public function getNombreProducto()
    {
        return "{$this->prendatipo->prenda} - {$this->prendatipo->talla->talla} - {$this->prendatipo->talla->sexo}";
    }
}
