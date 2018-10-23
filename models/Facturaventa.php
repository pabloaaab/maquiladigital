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
 * @property int $idordenproduccion
 * @property string $usuariosistema
 * @property int $idresolucion
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nrofactura', 'plazopago', 'idcliente', 'idordenproduccion', 'idresolucion'], 'integer'],
            [['fechainicio', 'idcliente', 'idordenproduccion'], 'required', 'message' => 'Campo requerido'],
            [['fechainicio', 'fechavcto', 'fechacreacion'], 'safe'],
            [['porcentajeiva', 'porcentajefuente', 'porcentajereteiva', 'subtotal', 'retencionfuente', 'impuestoiva', 'retencioniva', 'saldo', 'totalpagar'], 'number'],
            [['valorletras'], 'string'],
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
            'idfactura' => 'Idfactura',
            'nrofactura' => 'Nrofactura',
            'fechainicio' => 'Fechainicio',
            'fechavcto' => 'Fechavcto',
            'fechacreacion' => 'Fechacreacion',
            'formapago' => 'Formapago',
            'plazopago' => 'Plazopago',
            'porcentajeiva' => 'Porcentajeiva',
            'porcentajefuente' => 'Porcentajefuente',
            'porcentajereteiva' => 'Porcentajereteiva',
            'subtotal' => 'Subtotal',
            'retencionfuente' => 'Retencionfuente',
            'impuestoiva' => 'Impuestoiva',
            'retencioniva' => 'Retencioniva',
            'saldo' => 'Saldo',
            'totalpagar' => 'Totalpagar',
            'valorletras' => 'Valorletras',
            'idcliente' => 'Idcliente',
            'idordenproduccion' => 'Idordenproduccion',
            'usuariosistema' => 'Usuariosistema',
            'idresolucion' => 'Idresolucion',
        ];
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
}
