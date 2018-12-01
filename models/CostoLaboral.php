<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costo_laboral".
 *
 * @property int $id_costo_laboral
 * @property double $total_otros
 * @property double $total_administrativo
 * @property double $total_administracion
 * @property double $total_operativo
 * @property double $total_general
 *
 * @property CostoLaboralDetalle[] $costoLaboralDetalles
 */
class CostoLaboral extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'costo_laboral';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_otros', 'total_administrativo', 'total_administracion', 'total_operativo', 'total_general'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_costo_laboral' => 'Id Costo Laboral',
            'total_otros' => 'Total Otros',
            'total_administrativo' => 'Total Administrativo',
            'total_administracion' => 'Total Administracion',
            'total_operativo' => 'Total Operativo',
            'total_general' => 'Total General',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostoLaboralDetalles()
    {
        return $this->hasMany(CostoLaboralDetalle::className(), ['id_costo_laboral' => 'id_costo_laboral']);
    }
}
