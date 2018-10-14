<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recibocajadetalle".
 *
 * @property int $iddetallerecibo
 * @property int $idfactura
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
            [['idfactura', 'vlrabono', 'vlrsaldo', 'retefuente', 'reteiva', 'reteica', 'idrecibo', 'observacion'], 'required'],
            [['idfactura', 'idrecibo'], 'integer'],
            [['vlrabono', 'vlrsaldo', 'retefuente', 'reteiva', 'reteica'], 'number'],
            [['observacion'], 'string'],
            [['idfactura'], 'exist', 'skipOnError' => true, 'targetClass' => Facturaventa::className(), 'targetAttribute' => ['idfactura' => 'nrofactura']],
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
            'idfactura' => 'Idfactura',
            'vlrabono' => 'Vlrabono',
            'vlrsaldo' => 'Vlrsaldo',
            'retefuente' => 'Retefuente',
            'reteiva' => 'Reteiva',
            'reteica' => 'Reteica',
            'idrecibo' => 'Idrecibo',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactura()
    {
        return $this->hasOne(Facturaventa::className(), ['nrofactura' => 'idfactura']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecibo()
    {
        return $this->hasOne(Recibocaja::className(), ['idrecibo' => 'idrecibo']);
    }
}
