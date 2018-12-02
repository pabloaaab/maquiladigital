<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costo_fijo".
 *
 * @property int $id_costo_fijo
 * @property double $valor
 *
 * @property CostoFijoDetalle[] $costoFijoDetalles
 */
class CostoFijo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'costo_fijo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_costo_fijo' => 'Id Costo Fijo',
            'valor' => 'Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostoFijoDetalles()
    {
        return $this->hasMany(CostoFijoDetalle::className(), ['id_costo_fijo' => 'id_costo_fijo']);
    }
}
