<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compra".
 *
 * @property int $id_compra
 * @property int $id_compra_tipo
 * @property double $porcentajeiva
 * @property double $porcentajefuente
 * @property double $porcentajereteiva
 * @property double $subtotal
 * @property double $retencionfuente
 * @property double $impuestoiva
 * @property double $retencioniva
 * @property double $saldo
 * @property double $total
 * @property int $id_proveedor
 * @property string $usuariosistema
 * @property int $estado
 * @property int $autorizado
 * @property string $observacion
 * @property string $fechacreacion
 * @property int $factura
 * @property int $numero
 *
 * @property CompraTipo $compraTipo
 * @property Proveedor $proveedor
 */
class Compra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_compra_tipo', 'id_proveedor', 'factura', 'subtotal','fechacreacion','impuestoiva'], 'required'],
            [['id_compra_tipo', 'id_proveedor', 'estado', 'autorizado','factura','numero'], 'integer'],
            [['porcentajeiva', 'porcentajefuente', 'porcentajereteiva', 'subtotal', 'retencionfuente', 'impuestoiva', 'retencioniva', 'saldo', 'total'], 'number'],
            [['observacion'], 'string'],
            [['fechacreacion'], 'safe'],
            [['usuariosistema'], 'string', 'max' => 50],
            [['id_compra_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => CompraTipo::className(), 'targetAttribute' => ['id_compra_tipo' => 'id_compra_tipo']],
            [['id_proveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['id_proveedor' => 'idproveedor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_compra' => 'Id Compra',
            'id_compra_tipo' => 'Compra Tipo',
            'porcentajeiva' => 'Porcentaje Iva',
            'porcentajefuente' => 'Porcentaje Fuente',
            'porcentajereteiva' => 'Porcentaje Reteiva',
            'subtotal' => 'Subtotal',
            'retencionfuente' => 'Retencion Fuente',
            'impuestoiva' => 'Impuesto Iva',
            'retencioniva' => 'Retencion Iva',
            'saldo' => 'Saldo',
            'total' => 'Total',
            'id_proveedor' => 'Proveedor',
            'usuariosistema' => 'Usuario',
            'estado' => 'Estado',
            'autorizado' => 'Autorizado',
            'observacion' => 'Observacion',
            'fechacreacion' => 'Fecha Creacion',
            'factura' => 'Factura',
            'numero' => 'Número',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompraTipo()
    {
        return $this->hasOne(CompraTipo::className(), ['id_compra_tipo' => 'id_compra_tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['idproveedor' => 'id_proveedor']);
    }
    
    public function getAutorizar()
    {
        if($this->autorizado == 1){
            $autorizar = "SI";
        }else{
            $autorizar = "NO";
        }
        return $autorizar;
    }
    
    public function getEstados()
    {
        if($this->estado == 0){
            $estado = "ABIERTA";
        }
        if($this->estado == 1){
            $estado = "ABONADA";
        }
        if($this->estado == 2){
            $estado = "PAGADA";
        }        
        return $estado;
    }
}
