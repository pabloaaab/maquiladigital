<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "remision_entrega_prendas".
 *
 * @property int $id_remision
 * @property int $idcliente
 * @property int $nro_remision
 * @property string $fecha_entrega
 * @property string $fecha_registro
 * @property int $cantidad
 * @property int $valor_total
 * @property int $valor_pagar
 * @property int $estado_remision
 * @property int $autorizado
 * @property string $usuariosistema
 *
 * @property RemisionEntregaPrendaDetalles[] $remisionEntregaPrendaDetalles
 * @property Cliente $cliente
 */
class RemisionEntregaPrendas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'remision_entrega_prendas';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->observacion = strtolower($this->observacion); 
        $this->observacion = ucfirst($this->observacion);  
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcliente','fecha_entrega'], 'required'],
            [['idcliente', 'nro_remision', 'cantidad', 'valor_total', 'valor_pagar', 'estado_remision', 'autorizado','facturado'], 'integer'],
            [['fecha_entrega', 'fecha_registro'], 'safe'],
            [['usuariosistema'], 'string', 'max' => 20],
            [['observacion'], 'string', 'max' => 100],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_remision' => 'Id',
            'idcliente' => 'Cliente:',
            'nro_remision' => 'Nro Remision',
            'fecha_entrega' => 'Fecha Entrega:',
            'fecha_registro' => 'Fecha Registro',
            'cantidad' => 'Cantidad',
            'valor_total' => 'Valor Total',
            'valor_pagar' => 'Valor Pagar',
            'estado_remision' => 'Estado Remision',
            'autorizado' => 'Autorizado',
            'facturado' => 'Facturado',
            'usuariosistema' => 'Usuariosistema',
            'observacion' => 'Observacion:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemisionEntregaPrendaDetalles()
    {
        return $this->hasMany(RemisionEntregaPrendaDetalles::className(), ['id_remision' => 'id_remision']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['idcliente' => 'idcliente']);
    }
    
    public function getEstadoRemision() {
        if($this->estado_remision == 1){
            $estadoremision = 'ACTIVA';
        }else{
            $estadoremision = 'CANCELADA';
        }
        return $estadoremision;
        
    }
    
    public function getEstadoAutorizado() {
        if($this->autorizado == 1){
            $estadoautorizado = 'SI';
        }else{
            $estadoautorizado = 'NO';
        }
        return $estadoautorizado;
        
    }
    
    public function getEstadoFacturado() {
        if($this->facturado == 1){
            $estadofacturado = 'SI';
        }else{
            $estadofacturado = 'NO';
        }
        return $estadofacturado;
        
    }
}
