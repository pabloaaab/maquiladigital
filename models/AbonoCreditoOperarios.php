<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "abono_credito_operarios".
 *
 * @property int $id_abono
 * @property int $id_credito
 * @property double $vlr_abono
 * @property double $saldo
 * @property int $cuota_pendiente
 * @property string $observacion
 * @property string $fecha_proceso
 * @property string $usuariosistema
 *
 * @property CreditoOperarios $credito
 */
class AbonoCreditoOperarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'abono_credito_operarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_credito', 'cuota_pendiente'], 'integer'],
            [['vlr_abono', 'saldo'], 'number'],
            [['fecha_proceso'], 'safe'],
            [['observacion'], 'string', 'max' => 50],
            [['usuariosistema'], 'string', 'max' => 30],
            [['id_credito'], 'exist', 'skipOnError' => true, 'targetClass' => CreditoOperarios::className(), 'targetAttribute' => ['id_credito' => 'id_credito']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_abono' => 'Id Abono',
            'id_credito' => 'Id Credito',
            'vlr_abono' => 'Vlr Abono',
            'saldo' => 'Saldo',
            'cuota_pendiente' => 'Cuota Pendiente',
            'observacion' => 'Observacion',
            'fecha_proceso' => 'Fecha Proceso',
            'usuariosistema' => 'Usuariosistema',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCredito()
    {
        return $this->hasOne(CreditoOperarios::className(), ['id_credito' => 'id_credito']);
    }
}
