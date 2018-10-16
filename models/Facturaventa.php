<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturaventa".
 *
 * @property int $nrofactura
 * @property string $fechainicio
 * @property string $fechavcto
 * @property string $formapago
 * @property int $plazopago
 * @property double $porcentajeiva
 * @property double $porcentajefuente
 * @property double $porcentajereteiva
 * @property double $subtotal
 * @property double $retencionfuente
 * @property double $impuestoiva
 * @property double $retencioniva
 * @property double $totalpagar
 * @property string $valorletras
 * @property int $idcliente
 * @property int $idordenproduccion
 * @property string $usuariosistema
 *
 * @property Cliente $cliente
 * @property Ordenproduccion $ordenproduccion
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
            [['fechainicio', 'fechavcto', 'formapago', 'plazopago', 'porcentajeiva', 'porcentajefuente', 'porcentajereteiva', 'subtotal', 'retencionfuente', 'impuestoiva', 'retencioniva', 'totalpagar', 'valorletras', 'idcliente', 'idordenproduccion', 'usuariosistema'], 'required', 'message' => 'Campo requerido'],
            [['fechainicio', 'fechavcto'], 'safe'],
            [['plazopago', 'idcliente', 'idordenproduccion'], 'integer'],
            [['porcentajeiva', 'porcentajefuente', 'porcentajereteiva', 'subtotal', 'retencionfuente', 'impuestoiva', 'retencioniva', 'totalpagar'], 'number'],
            [['valorletras'], 'string'],
            [['formapago', 'usuariosistema'], 'string', 'max' => 15],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nrofactura' => 'N° Factura:',
            'fechainicio' => 'Fecha Inicio:',
            'fechavcto' => 'Fecha Vencimiento:',
            'formapago' => 'Forma Pago:',
            'plazopago' => 'Plazo Pago:',
            'porcentajeiva' => 'Porcentaje Iva;',
            'porcentajefuente' => 'Porcentaje Fuente:',
            'porcentajereteiva' => 'Porcentaje Rete Iva:',
            'subtotal' => 'Subtotal:',
            'retencionfuente' => 'Retención Fuente:',
            'impuestoiva' => 'Impuesto Iva:',
            'retencioniva' => 'Retención Iva:',
            'totalpagar' => 'Total Pagar:',
            'valorletras' => 'Valor Letras:',
            'idcliente' => 'Idcliente:',
            'idordenproduccion' => 'Idordenproduccion:',
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
    public function getRecibocajadetalles()
    {
        return $this->hasMany(Recibocajadetalle::className(), ['nrofactura' => 'nrofactura']);
    }
}
