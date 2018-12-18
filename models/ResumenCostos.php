<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resumen_costos".
 *
 * @property int $id_resumen_costos
 * @property double $costo_laboral
 * @property double $costo_fijo
 * @property double $total_costo
 * @property double $costo_diario
 */
class ResumenCostos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resumen_costos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['costo_laboral', 'costo_fijo', 'total_costo', 'costo_diario'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_resumen_costos' => 'Id Resumen Costos',
            'costo_laboral' => 'Costo Laboral',
            'costo_fijo' => 'Costo Fijo',
            'total_costo' => 'Total Costo',
            'costo_diario' => 'Costo Diario',
        ];
    }
}
