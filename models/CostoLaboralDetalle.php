<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costo_laboral_detalle".
 *
 * @property int $id_costo_laboral_detalle
 * @property int $id_costo_laboral
 * @property int $nro_empleados
 * @property double $salario
 * @property double $auxilio_transporte
 * @property double $tiempo_extra
 * @property double $bonificacion
 * @property double $arl
 * @property double $pension
 * @property double $caja
 * @property double $prestaciones
 * @property double $vacaciones
 * @property double $ajuste_vac
 * @property double $subtotal
 * @property double $admon
 * @property double $total
 * @property int $id_tipo_cargo
 * @property int $id_arl
 * @property int $no_empleado
 *
 * @property CostoLaboral $costoLaboral
 * @property TipoCargo $tipoCargo
 * @property Arl $arl0
 */
class CostoLaboralDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'costo_laboral_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_costo_laboral', 'nro_empleados', 'id_tipo_cargo', 'id_arl','no_empleado'], 'integer'],
            [['salario', 'auxilio_transporte', 'tiempo_extra', 'bonificacion', 'arl', 'pension', 'caja', 'prestaciones', 'vacaciones', 'ajuste_vac', 'subtotal', 'admon', 'total'], 'number'],
            [['id_costo_laboral'], 'exist', 'skipOnError' => true, 'targetClass' => CostoLaboral::className(), 'targetAttribute' => ['id_costo_laboral' => 'id_costo_laboral']],
            [['id_tipo_cargo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCargo::className(), 'targetAttribute' => ['id_tipo_cargo' => 'id_tipo_cargo']],
            [['id_arl'], 'exist', 'skipOnError' => true, 'targetClass' => Arl::className(), 'targetAttribute' => ['id_arl' => 'id_arl']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_costo_laboral_detalle' => 'Id Costo Laboral Detalle',
            'id_costo_laboral' => 'Id Costo Laboral',
            'nro_empleados' => 'Nro Empleados',
            'salario' => 'Salario',
            'auxilio_transporte' => 'Auxilio Transporte',
            'tiempo_extra' => 'Tiempo Extra',
            'bonificacion' => 'Bonificacion',
            'arl' => 'Arl',
            'pension' => 'Pension',
            'caja' => 'Caja',
            'prestaciones' => 'Prestaciones',
            'vacaciones' => 'Vacaciones',
            'ajuste_vac' => 'Ajuste Vac',
            'subtotal' => 'Subtotal',
            'admon' => 'Admon',
            'total' => 'Total',
            'id_tipo_cargo' => 'Id Tipo Cargo',
            'id_arl' => 'Id Arl',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostoLaboral()
    {
        return $this->hasOne(CostoLaboral::className(), ['id_costo_laboral' => 'id_costo_laboral']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCargo()
    {
        return $this->hasOne(TipoCargo::className(), ['id_tipo_cargo' => 'id_tipo_cargo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArl0()
    {
        return $this->hasOne(Arl::className(), ['id_arl' => 'id_arl']);
    }
}
