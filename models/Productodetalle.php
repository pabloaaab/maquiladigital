<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productodetalle".
 *
 * @property int $idproductodetalle
 * @property int $idproducto
 * @property string $observacion
 * @property int $activo
 * @property string $fechaproceso
 * @property string $usuariosistema
 * @property int $idprendatipo
 *
 * @property Producto $producto
 * @property Prendatipo $prendatipo
 */
class Productodetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productodetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproducto', 'observacion', 'idprendatipo'], 'required'],
            [['idproducto', 'activo', 'idprendatipo'], 'integer'],
            [['observacion'], 'string'],
            [['fechaproceso'], 'safe'],
            [['usuariosistema'], 'string', 'max' => 20],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idproducto' => 'idproducto']],
            [['idprendatipo'], 'exist', 'skipOnError' => true, 'targetClass' => Prendatipo::className(), 'targetAttribute' => ['idprendatipo' => 'idprendatipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproductodetalle' => 'Idproductodetalle',
            'idproducto' => 'Idproducto',
            'observacion' => 'Observacion',
            'activo' => 'Activo',
            'fechaproceso' => 'Fechaproceso',
            'usuariosistema' => 'Usuariosistema',
            'idprendatipo' => 'Idprendatipo',
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
    public function getPrendatipo()
    {
        return $this->hasOne(Prendatipo::className(), ['idprendatipo' => 'idprendatipo']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproducciondetalles()
    {
        return $this->hasMany(Ordenproducciondetalle::className(), ['idproductodetalle' => 'idproductodetalle']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaventadetalles()
    {
        return $this->hasMany(Facturaventadetalle::className(), ['idproductodetalle' => 'idproductodetalle']);
    }
}
