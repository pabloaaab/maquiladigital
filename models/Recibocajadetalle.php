<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recibocajadetalle".
 *
 * @property int $iddetallerecibo
 * @property int $nrofactura
 * @property double $vlrabono
 * @property double $vlrsaldo
 * @property double $retefuente
 * @property double $reteiva
 * @property double $reteica
 * @property int $idrecibo
 * @property string $observacion
 *
 * @property Facturaventa $factura
 * @property Recibocaja $recibo
 */
class Recibocajadetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recibocajadetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nrofactura', 'vlrabono', 'vlrsaldo', 'retefuente', 'reteiva', 'reteica', 'idrecibo', 'observacion'], 'required', 'message' => 'Campo requerido'],
            [['nrofactura', 'idrecibo'], 'integer'],
            [['vlrabono', 'vlrsaldo', 'retefuente', 'reteiva', 'reteica'], 'number'],
            [['observacion'], 'string'],
            [['nrofactura'], 'exist', 'skipOnError' => true, 'targetClass' => Facturaventa::className(), 'targetAttribute' => ['nrofactura' => 'nrofactura']],
            [['idrecibo'], 'exist', 'skipOnError' => true, 'targetClass' => Recibocaja::className(), 'targetAttribute' => ['idrecibo' => 'idrecibo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetallerecibo' => 'Idetallerecibo',
            'nrofactura' => 'N° Factura:',
            'vlrabono' => 'Valor Abono:',
            'vlrsaldo' => 'Valor Saldo:',
            'retefuente' => 'Rete Fuente:',
            'reteiva' => 'Rete Iva:',
            'reteica' => 'Rete Ica:',
            'idrecibo' => 'Idrecibo:',
            'observacion' => 'Observacion:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactura()
    {
        return $this->hasOne(Facturaventa::className(), ['nrofactura' => 'nrofactura']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecibo()
    {
        return $this->hasOne(Recibocaja::className(), ['idrecibo' => 'idrecibo']);
    }
}
