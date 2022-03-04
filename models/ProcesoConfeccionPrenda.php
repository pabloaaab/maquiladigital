<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proceso_confeccion_prenda".
 *
 * @property int $id_proceso_confeccion
 * @property string $descripcion_proceso
 * @property int $estado_proceso
 */
class ProcesoConfeccionPrenda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proceso_confeccion_prenda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion_proceso'], 'required'],
            [['estado_proceso'], 'integer'],
            [['descripcion_proceso'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_proceso_confeccion' => 'Id Proceso Confeccion',
            'descripcion_proceso' => 'Descripcion Proceso',
            'estado_proceso' => 'Estado Proceso',
        ];
    }
     public function getBalanceo()
    {
        return $this->hasMany(ProcesoConfeccionPrenda::className(), ['id_proceso_confeccion' => 'id_proceso_confeccion']);
    }
    
      public function getCantidadprendaterminada()
    {
        return $this->hasMany(ProcesoConfeccionPrenda::className(), ['id_proceso_confeccion' => 'id_proceso_confeccion']);
    }
    
}
