<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_cotizante".
 *
 * @property int $id_tipo_cotizante
 * @property string $tipo
 *
 * @property Contrato[] $contratos
 */
class TipoNomina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_nomina';
    }

    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tipo_nomina', 'tipo_pago'], 'required'],
            [['tipo_pago'], 'string', 'max' => 30],
            [['ver_registro'],'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_nomina' => 'id_pago_nomina',
            'tipo_pago' => 'tipo_pago',
            'ver_registro' => 'Ver registro',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoNomina()
    {
        return $this->hasMany(TipoNomina::className(), ['id_pago_nomina' => 'id_pago_nomina']);
    }
}
