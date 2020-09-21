<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "novedad_tiempo_extra".
 *
 * @property int $id_novedad
 * @property int $id_empleado
 * @property int $codigo_salario
 * @property int $id_periodo_pago_nomina
 * @property int $id_grupo_pago
 * @property string $fecha_inicio
 * @property string $fecha_corte
 * @property string $fecha_creacion
 * @property double $vlr_hora
 * @property double $nro_horas
 * @property double $total_novedad
 * @property string $usuariosistema
 */
class NovedadTiempoExtra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'novedad_tiempo_extra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empleado', 'codigo_salario', 'fecha_inicio', 'usuariosistema', 'id_programacion'], 'required'],
            [['id_empleado', 'codigo_salario', 'id_periodo_pago_nomina', 'id_grupo_pago', 'id_programacion','salario_contrato'], 'integer'],
            [['fecha_inicio', 'fecha_corte', 'fecha_creacion'], 'safe'],
            [['vlr_hora', 'nro_horas', 'total_novedad','porcentaje'], 'number'],
            [['usuariosistema'], 'string', 'max' => 30],
            [['concepto'], 'string'],
            [['id_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['id_empleado' => 'id_empleado']],
            [['id_programacion'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramacionNomina::className(), 'targetAttribute' => ['id_programacion' => 'id_programacion']],
            [['codigo_salario'], 'exist', 'skipOnError' => true, 'targetClass' => ConceptoSalarios::className(), 'targetAttribute' => ['codigo_salario' => 'codigo_salario']],
             [['id_periodo_pago_nomina'], 'exist', 'skipOnError' => true, 'targetClass' => PeriodoPagoNomina::className(), 'targetAttribute' => ['id_periodo_pago_nomina' => 'id_periodo_pago_nomina']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_novedad' => 'Id Novedad',
            'id_empleado' => 'Id Empleado',
            'codigo_salario' => 'Codigo Salario',
            'id_periodo_pago_nomina' => 'Id Periodo Pago Nomina',
            'id_grupo_pago' => 'Id Grupo Pago',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_corte' => 'Fecha Corte',
            'fecha_creacion' => 'Fecha Creacion',
            'vlr_hora' => 'Vlr Hora',
            'nro_horas' => 'Nro Horas',
            'total_novedad' => 'Total Novedad',
            'usuariosistema' => 'Usuariosistema',
            'id_programacion' => 'id_programacion',
        ];
    }
    
      public function getEmpleado()
    {
        return $this->hasOne(Empleado::className(), ['id_empleado' => 'id_empleado']);
    }
}
