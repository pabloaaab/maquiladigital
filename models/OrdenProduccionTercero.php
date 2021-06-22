<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orden_produccion_tercero".
 *
 * @property int $id_orden_tercero
 * @property int $idproveedor
 * @property int $idcliente
 * @property int $idordenproduccion
 * @property int $idtipo
 * @property string $codigo_producto
 * @property string $fecha_proceso
 * @property string $fecha_registro
 * @property double $vlr_minuto
 * @property int $total_pagar
 * @property string $observacion
 * @property string $usuariosistema
 *
 * @property Proveedor $proveedor
 * @property Cliente $cliente
 * @property Ordenproduccion $ordenproduccion
 * @property Ordenproducciontipo $tipo
 */
class OrdenProduccionTercero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orden_produccion_tercero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproveedor', 'idcliente', 'codigo_producto', 'fecha_proceso','vlr_minuto','cantidad_minutos','idtipo'], 'required'],
            [['idproveedor', 'idcliente', 'idordenproduccion', 'idtipo', 'total_pagar','cantidad_unidades'], 'integer'],
            [['fecha_proceso', 'fecha_registro'], 'safe'],
            [['vlr_minuto','cantidad_minutos'], 'number'],
            [['codigo_producto'], 'string', 'max' => 15],
            [['observacion'], 'string', 'max' => 100],
            [['usuariosistema'], 'string', 'max' => 20],
            [['idproveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['idproveedor' => 'idproveedor']],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
            [['idtipo'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproducciontipo::className(), 'targetAttribute' => ['idtipo' => 'idtipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_orden_tercero' => 'Nro Orden:',
            'idproveedor' => 'Proveedor:',
            'idcliente' => 'Cliente:',
            'idordenproduccion' => 'OP Cliente:',
            'idtipo' => 'Proceso:',
            'codigo_producto' => 'Codigo Producto',
            'fecha_proceso' => 'Fecha Proceso',
            'fecha_registro' => 'Fecha Registro',
            'vlr_minuto' => 'Vlr Minuto:',
            'cantidad_minutos' => 'Cant. Minutos:',
            'total_pagar' => 'Total Pagar:',
            'observacion' => 'Observacion:',
            'usuariosistema' => 'Usuarios:',
            'cantidad_unidades' => 'Total unidades:'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['idproveedor' => 'idproveedor']);
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
    public function getOrdenproduccion()
    {
        return $this->hasOne(Ordenproduccion::className(), ['idordenproduccion' => 'idordenproduccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Ordenproducciontipo::className(), ['idtipo' => 'idtipo']);
    }
    
    public function getAutorizadoTercero() {
        if($this->autorizado == 1){
             $autorizadotercero = 'SI';  
        }else{
            $autorizadotercero = 'NO';
        }
        return $autorizadotercero;
    }
}
