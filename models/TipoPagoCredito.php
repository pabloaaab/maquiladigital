<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_pago_credito".
 *
 * @property int $id_tipo_pago
 * @property string $descripcion
 * @property int $estado
 *
 * @property Credito[] $creditos
 */
class TipoPagoCredito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_pago_credito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['estado'], 'integer'],
            [['descripcion'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_pago' => 'Id Tipo Pago',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditos()
    {
        return $this->hasMany(Credito::className(), ['id_tipo_pago' => 'id_tipo_pago']);
    }
}
