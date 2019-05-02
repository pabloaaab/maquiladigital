<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fichatiempo".
 *
 * @property int $id_ficha_tiempo
 * @property int $id_empleado
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
            [['id_empleado','referencia','total_segundos'], 'required'],
            [['id_empleado','estado'], 'integer'],
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
