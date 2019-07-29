<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fichatiempo".
 *
 * @property int $id_ficha_tiempo
 * @property int $id_empleado
 * @property int $id_horario
 * @property double $cumplimiento
 * @property date $fechacreacion
 * @property date $desde
 * @property date $hasta
 * @property string $observacion
 * @property string $referencia
 * @property int $estado
 * @property float $total_segundos
 *
 * @property Empleado $empleado
 * @property Horarios $horario
 */
class Fichatiempo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fichatiempo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empleado','referencia','total_segundos','id_horario'], 'required'],
            [['id_empleado','estado','id_horario'], 'integer',],
            [['cumplimiento','total_segundos'], 'number'],
            [['observacion','referencia'], 'string'],
            [['desde','hasta'], 'safe'],
            [['id_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['id_empleado' => 'id_empleado']],            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ficha_tiempo' => 'Id',
            'id_empleado' => 'Empleado',
            'id_horario' => 'Horario',
            'cumplimiento' => 'Cumplimiento',
            'observacion' => 'Observacion',
            'desde' => 'Desde',
            'hasta' => 'Hasta',
            'referencia' => 'Referencia',
            'estado' => 'Estado',
            'total_segundos' => 'Total Segundos',            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleado()
    {
        return $this->hasOne(Empleado::className(), ['id_empleado' => 'id_empleado']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorario()
    {
        return $this->hasOne(Horario::className(), ['id_horario' => 'id_horario']);
    }
    
    public function getCerrado()
    {
        if($this->estado == 1){
            $cerrado = "SI";
        }else{
            $cerrado = "NO";
        }
        return $cerrado;
    }
}
