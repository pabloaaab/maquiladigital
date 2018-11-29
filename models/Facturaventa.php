<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturaventa".
 *
 * @property int $idfactura
 * @property int $nrofactura
 * @property string $fechainicio
 * @property string $fechavcto
 * @property string $fechacreacion
 * @property string $formapago
 * @property int $plazopago
 * @property double $porcentajeiva
 * @property double $porcentajefuente
 * @property double $porcentajereteiva
 * @property double $subtotal
 * @property double $retencionfuente
 * @property double $impuestoiva
 * @property double $retencioniva
 * @property double $saldo
 * @property double $totalpagar
 * @property string $valorletras
 * @property int $idcliente
 * @property int $observacion
 * @property int $idordenproduccion
 * @property string $usuariosistema
 * @property int $idresolucion
 * @property int $estado
 * @property int $autorizado
 *
 * @property Cliente $cliente
 * @property Ordenproduccion $ordenproduccion
 * @property Resolucion $resolucion
 * @property Facturaventadetalle[] $facturaventadetalles
 * @property Recibocajadetalle[] $recibocajadetalles
 */
class Facturaventa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturaventa';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->observacion = strtoupper($this->observacion);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nrofactura', 'plazopago', 'idcliente', 'idordenproduccion', 'idresolucion','estado','autorizado'], 'integer'],
            [['fechainicio', 'idcliente', 'idordenproduccion'], 'required', 'message' => 'Campo requerido'],
            [['fechainicio', 'fechavcto', 'fechacreacion'], 'safe'],
            [['porcentajeiva', 'porcentajefuente', 'porcentajereteiva', 'subtotal', 'retencionfuente', 'impuestoiva', 'retencioniva', 'saldo', 'totalpagar'], 'number'],
            [['valorletras','observacion'], 'string'],
            [['formapago', 'usuariosistema'], 'string', 'max' => 15],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
            [['idresolucion'], 'exist', 'skipOnError' => true, 'targetClass' => Resolucion::className(), 'targetAttribute' => ['idresolucion' => 'idresolucion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfactura' => 'ID',
            'nrofactura' => 'Nro Factura',
            'fechainicio' => 'Fecha Inicio',
            'fechavcto' => 'Fecha Vcto',
            'fechacreacion' => 'Fecha Creacion',
            'formapago' => 'Forma Pago',
            'plazopago' => 'Plazo pago',
            'porcentajeiva' => '% Iva',
            'porcentajefuente' => '% Rete Fuente',
            'porcentajereteiva' => '% Rete Iva',
            'subtotal' => 'Subtotal',
            'retencionfuente' => 'Retencion Fuente',
            'impuestoiva' => 'Iva',
            'retencioniva' => 'Retencion Iva',
            'saldo' => 'Saldo',
            'totalpagar' => 'Total Pagar',
            'valorletras' => 'Valor Letras',
            'idcliente' => 'Cliente',
            'idordenproduccion' => 'ID Produccion',
            'usuariosistema' => 'Usuario Sistema',
            'idresolucion' => 'Resolucion',
            'estado' => 'Estado',
            'autorizado' => 'Autorizado',
            'observacion' => 'Observaciones',
        ];
    }

    public static function getOrden($provid)
    {

        $data=  \app\models\Ordenproduccion::find()
            ->where(['idcliente'=>$provid])
            ->select(['idordenproduccion as id'])->asArray()->all();

        return $data;
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
    public function getResolucion()
    {
        return $this->hasOne(Resolucion::className(), ['idresolucion' => 'idresolucion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaventadetalles()
    {
        return $this->hasMany(Facturaventadetalle::className(), ['idfactura' => 'idfactura']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecibocajadetalles()
    {
        return $this->hasMany(Recibocajadetalle::className(), ['idfactura' => 'idfactura']);
    }

    public function getFormadePago(){
        if($this->formapago == 1){ //forma de pafo 1= contado, 2 = credito
            return "CONTADO";
        }elseif ($this->formapago == 2){
            return "CRÉDITO";
        }
    }
}
