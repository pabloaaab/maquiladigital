<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fichatiempodetalle".
 *
 * @property int $id_ficha_tiempo_detalle
 * @property int $id_ficha_tiempo
 * @property string $dia
 * @property string $desde
 * @property string $hasta
 * @property double $total_segundos
 * @property double $total_operacion
 * @property double $realizadas
 * @property double $cumplimiento
 * @property string $observacion
 *
 * @property Fichatiempo $fichaTiempo
 */
class Fichatiempodetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fichatiempodetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ficha_tiempo'], 'integer'],
            [['dia', 'desde', 'hasta'], 'safe'],
            [['total_segundos', 'total_operacion', 'realizadas', 'cumplimiento'], 'number'],
            [['observacion'], 'string'],
            [['id_ficha_tiempo'], 'exist', 'skipOnError' => true, 'targetClass' => Fichatiempo::className(), 'targetAttribute' => ['id_ficha_tiempo' => 'id_ficha_tiempo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ficha_tiempo_detalle' => 'Id Ficha Tiempo Detalle',
            'id_ficha_tiempo' => 'Id Ficha Tiempo',
            'dia' => 'Dia',
            'desde' => 'Desde',
            'hasta' => 'Hasta',
            'total_segundos' => 'Total Segundos',
            'total_operacion' => 'Total Operacion',
            'realizadas' => 'Realizadas',
            'cumplimiento' => 'Cumplimiento',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichaTiempo()
    {
        return $this->hasOne(Fichatiempo::className(), ['id_ficha_tiempo' => 'id_ficha_tiempo']);
    }
}
