<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametros".
 *
 * @property int $id_parametros
 * @property double $auxilio_transporte
 * @property double $pension
 * @property double $caja
 * @property double $prestaciones
 * @property double $vacaciones
 * @property double $ajuste
 */
class Parametros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parametros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auxilio_transporte', 'pension', 'caja', 'prestaciones', 'vacaciones', 'ajuste'], 'required', 'message' => 'Campo requerido'],
            [['auxilio_transporte', 'pension', 'caja', 'prestaciones', 'vacaciones', 'ajuste'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_parametros' => 'Id Parametros',
            'auxilio_transporte' => 'Auxilio Transporte',
            'pension' => 'Pension',
            'caja' => 'Caja',
            'prestaciones' => 'Prestaciones',
            'vacaciones' => 'Vacaciones',
            'ajuste' => 'Ajuste',
        ];
    }
}
