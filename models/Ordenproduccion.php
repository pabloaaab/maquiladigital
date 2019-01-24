<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenproduccion".
 *
 * @property int $idordenproduccion
 * @property int $idcliente
 * @property string $fechallegada
 * @property string $fechaprocesada
 * @property string $fechaentrega
 * @property int $cantidad
 * @property double $totalorden
 * @property string $valorletras
 * @property string $observacion
 * @property int $estado
 * @property int $autorizado
 * @property string $ordenproduccion
 * @property string $ordenproduccionext
 * @property int $idtipo
 * @property string $usuariosistema
 * @property int $facturado
 * @property int $proceso_control
 * @property int $porcentaje_proceso
 * @property int $porcentaje_cantidad
 * @property int $ponderacion
 * @property int $segundosficha
 * @property string $codigoproducto
 * @property string $duracion
 *
 * @property Facturaventa[] $facturaventas
 * @property Cliente $cliente
 * @property Ordenproducciontipo $tipo
 */
class Ordenproduccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenproduccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcliente', 'fechallegada', 'fechaprocesada', 'fechaentrega', 'observacion', 'idtipo','ponderacion','ordenproduccion','ordenproduccionext','codigoproducto'], 'required', 'message' => 'Campo requerido'],            
            [['idcliente', 'estado', 'idtipo','autorizado','facturado','proceso_control','cantidad'], 'integer'],
            [['fechallegada', 'fechaprocesada', 'fechaentrega'], 'safe'],
            [['totalorden','ponderacion','porcentaje_proceso','porcentaje_cantidad','segundosficha'], 'number'],
            [['valorletras', 'observacion','codigoproducto'], 'string'],
            [['ordenproduccion','duracion'], 'string', 'max' => 25],
            [['usuariosistema'], 'string', 'max' => 50],            
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idtipo'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproducciontipo::className(), 'targetAttribute' => ['idtipo' => 'idtipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idordenproduccion' => 'Id',
            'idcliente' => 'Cliente',
            'fechallegada' => 'Fecha Llegada',
            'fechaprocesada' => 'Fecha Procesada',
            'fechaentrega' => 'Fecha Entrega',
            'cantidad' => 'Cantidad',
            'totalorden' => 'Total Orden',
            'valorletras' => 'Valor Letras',
            'observacion' => 'Observacion',
            'estado' => 'Estado',
            'estado' => 'Facturado',
            'proceso_control' => 'Control',
            'autorizado' => 'Autorizado',
            'ordenproduccion' => 'Orden Prod',
            'ordenproduccionext' => 'Orden Prod Ext',
            'idtipo' => 'Tipo',
            'usuariosistema' => 'Usuario Sistema',
            'porcentaje_proceso' => '% Proceso',
            'porcentaje_cantidad' => '% cantidad',
            'ponderacion' => 'Ponderación',
            'codigoproducto' => 'Código Producto',
            'duracion' => 'Duración',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaventas()
    {
        return $this->hasMany(Facturaventa::className(), ['idordenproduccion' => 'idordenproduccion']);
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
    public function getTipo()
    {
        return $this->hasOne(Ordenproducciontipo::className(), ['idtipo' => 'idtipo']);
    }

    public function getOrdenProduccion()
    {
        return " Id: {$this->idordenproduccion} - Orden Producción: {$this->ordenproduccion} - Fecha Llegada: {$this->fechallegada} - Total: {$this->totalorden} - Tipo: {$this->tipo->tipo}";
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
    
    public function getFacturar()
    {
        if($this->facturado == 1){
            $facturar = "SI";
        }else{
            $facturar = "NO";
        }
        return $facturar;
    }
        
}
