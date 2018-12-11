<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costo_laboral_hora".
 *
 * @property int $id_costo_laboral_hora
 * @property int $dia
 * @property int $hora
 * @property int $minutos
 * @property int $segundos
 * @property int $dia_mes
 * @property double $valor_dia
 * @property double $valor_hora
 * @property double $valor_minuto
 * @property double $valor_segundo
 */
class CostoLaboralHora extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'costo_laboral_hora';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dia', 'hora', 'minutos', 'segundos', 'dia_mes'], 'integer'],
            [['valor_dia', 'valor_hora', 'valor_minuto', 'valor_segundo'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_costo_laboral_hora' => 'Id Costo Laboral Hora',
            'dia' => 'Dia:',
            'hora' => 'Hora:',
            'minutos' => 'Minutos:',
            'segundos' => 'Segundos:',
            'dia_mes' => 'Dia Mes:',
            'valor_dia' => 'Valor Dia:',
            'valor_hora' => 'Valor Hora:',
            'valor_minuto' => 'Valor Minuto:',
            'valor_segundo' => 'Valor Segundo:',
        ];
    }
}
