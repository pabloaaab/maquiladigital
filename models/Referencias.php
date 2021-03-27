<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referencias".
 *
 * @property int $id_referencia
 * @property int $id_producto
 * @property int $codigo_producto
 * @property int $existencias
 * @property int $total_existencias
 * @property int $precio_costo
 * @property double $porcentaje_mayorista
 * @property double $porcentaje_deptal
 * @property int $precio_venta_mayorista
 * @property int $precio_venta_deptal
 * @property int $id_proveedor
 * @property int $estado_existencia
 * @property int $autorizado
 * @property string $fecha_creacion
 * @property string $usuariosistema
 * @property int $t2
 * @property int $t4
 * @property int $t6
 * @property int $t8
 * @property int $t10
 * @property int $t12
 * @property int $t14
 * @property int $t16
 * @property int $t18
 * @property int $t20
 * @property int $t22
 * @property int $t24
 * @property int $t26
 * @property int $t28
 * @property int $t30
 * @property int $t32
 * @property int $t34
 * @property int $t36
 * @property int $t38
 * @property int $t40
 * @property int $t42
 * @property int $t44
 * @property int $xs
 * @property int $s
 * @property int $m
 * @property int $l
 * @property int $xl
 *
 * @property CostoProducto $producto
 * @property Proveedor $proveedor
 */
class Referencias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'existencias', 'idproveedor','id_bodega'], 'required'],
            [['id_producto', 'existencias','id_bodega', 'total_existencias', 'precio_costo', 'precio_venta_mayorista', 'precio_venta_deptal', 'idproveedor', 'estado_existencia', 'autorizado', 't2', 't4', 't6', 't8', 't10', 't12', 't14', 't16', 't18', 't20', 't22', 't24', 't26', 't28', 't30', 't32', 't34', 't36', 't38', 't40', 't42', 't44', 'xs', 's', 'm', 'l', 'xl','xxl'], 'integer'],
            [['porcentaje_mayorista', 'porcentaje_deptal'], 'number'],
            [['fecha_creacion'], 'safe'],
            [['usuariosistema'], 'string', 'max' => 20],
            [['descripcion','codigo_producto'], 'string'],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => CostoProducto::className(), 'targetAttribute' => ['id_producto' => 'id_producto']],
            [['idproveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['idproveedor' => 'idproveedor']],
            [['id_bodega'], 'exist', 'skipOnError' => true, 'targetClass' => Bodega::className(), 'targetAttribute' => ['id_bodega' => 'id_bodega']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_referencia' => 'Id Referencia',
            'id_producto' => 'Producto:',
            'codigo_producto' => 'Codigo Producto',
            'descripcion' => 'Referencia',
            'existencias' => 'Existencias:',
            'total_existencias' => 'Total Existencias',
            'precio_costo' => 'Precio Costo',
            'porcentaje_mayorista' => '% Mayorista:',
            'porcentaje_deptal' => '% Deptal:',
            'precio_venta_mayorista' => 'Precio venta mayorista:',
            'precio_venta_deptal' => 'Precio venta deptal:',
            'idproveedor' => 'Proveedor:',
            'id_bodega' => 'Bodega:',
            'estado_existencia' => 'Estado Existencia',
            'autorizado' => 'Autorizado',
            'fecha_creacion' => 'Fecha Creacion',
            'usuariosistema' => 'Usuariosistema',
            't2' => 'T2',
            't4' => 'T4',
            't6' => 'T6',
            't8' => 'T8',
            't10' => 'T10',
            't12' => 'T12',
            't14' => 'T14',
            't16' => 'T16',
            't18' => 'T18',
            't20' => 'T20',
            't22' => 'T22',
            't24' => 'T24',
            't26' => 'T26',
            't28' => 'T28',
            't30' => 'T30',
            't32' => 'T32',
            't34' => 'T34',
            't36' => 'T36',
            't38' => 'T38',
            't40' => 'T40',
            't42' => 'T42',
            't44' => 'T44',
            'xs' => 'Xs',
            's' => 'S',
            'm' => 'M',
            'l' => 'L',
            'xl' => 'Xl',
            'xxl' => 'XXl',
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
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['idproveedor' => 'idproveedor']);
    }
    
    public function getBodega()
    {
        return $this->hasOne(Bodega::className(), ['id_bodega' => 'id_bodega']);
    }
    
    public function getAutorizadoreferencia() {
        if($this->autorizado == 1){
            $autorizado = 'SI';
        }else{
            $autorizado = 'NO';
        }
        return $autorizado;
    }
}
