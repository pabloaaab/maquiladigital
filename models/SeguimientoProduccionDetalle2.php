<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seguimiento_produccion_detalle2".
 *
 * @property int $id_seguimiento_produccion_detalle
 * @property int $id_seguimiento_produccion
 * @property string $fecha_inicio
 * @property string $hora_inicio
 * @property string $hora_consulta
 * @property double $minutos
 * @property double $horas_a_trabajar
 * @property double $cantidad_por_hora
 * @property double $cantidad
 * @property double $operarias
 * @property double $total
 * @property double $operacion_por_hora
 * @property double $prendas_sistema
 * @property double $prendas_reales
 * @property double $porcentaje_produccion
 */
class SeguimientoProduccionDetalle2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguimiento_produccion_detalle2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_seguimiento_produccion'], 'integer'],
            [['fecha_inicio', 'hora_inicio', 'hora_consulta'], 'safe'],
            [['minutos', 'horas_a_trabajar', 'cantidad_por_hora', 'cantidad','operarias', 'total', 'operacion_por_hora', 'prendas_sistema', 'prendas_reales', 'porcentaje_produccion'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_seguimiento_produccion_detalle' => 'Id Seguimiento Produccion Detalle',
            'id_seguimiento_produccion' => 'Id Seguimiento Produccion',
            'fecha_inicio' => 'Fecha Inicio',
            'hora_inicio' => 'Hora Inicio',
            'hora_consulta' => 'Hora Consulta',
            'minutos' => 'Minutos',            
            'horas_a_trabajar' => 'Horas A Trabajar',
            'cantidad_por_hora' => 'Cantidad Por Hora',
            'cantidad' => 'Cantidad',
            'operarias' => 'Operarias',
            'total' => 'Total',
            'operacion_por_hora' => 'Operacion Por Hora',
            'prendas_sistema' => 'Prendas Sistema',
            'prendas_reales' => 'Prendas Reales',
            'porcentaje_produccion' => 'Porcentaje Produccion',
        ];
    }
}
