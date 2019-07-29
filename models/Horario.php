<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "horario".
 *
 * @property int $id_horario
 * @property string $horario
 * @property string $desde
 * @property string $hasta
 *
 * @property Fichatiempo[] $fichatiempos
 */
class Horario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['horario', 'desde', 'hasta'], 'required'],
            [['desde', 'hasta'], 'string'],
            [['horario'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_horario' => 'Id',
            'horario' => 'Horario',
            'desde' => 'Desde',
            'hasta' => 'Hasta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichatiempos()
    {
        return $this->hasMany(Fichatiempo::className(), ['id_horario' => 'id_horario']);
    }
    
    public function getNombreHorario()
    {
        return "{$this->horario} {$this->desde} - {$this->hasta}";
    }
}
