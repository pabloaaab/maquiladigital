<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seguimiento_incapacidad".
 *
 * @property int $id_seguimiento
 * @property int $id_incapacidad
 * @property string $nota
 * @property string $fecha_proceso
 * @property string $usuariosistema
 *
 * @property Incapacidad $incapacidad
 */
class SeguimientoIncapacidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguimiento_incapacidad';
    }
    
 public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->nota = strtolower($this->nota);
        $this->nota = ucfirst($this->nota);   
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_incapacidad', 'nota', 'usuariosistema'], 'required'],
            [['id_incapacidad'], 'integer'],
            [['nota'], 'string'],
            [['fecha_proceso'], 'safe'],
            [['usuariosistema'], 'string', 'max' => 30],
            [['id_incapacidad'], 'exist', 'skipOnError' => true, 'targetClass' => Incapacidad::className(), 'targetAttribute' => ['id_incapacidad' => 'id_incapacidad']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_seguimiento' => 'Id',
            'id_incapacidad' => 'Id Incapacidad',
            'nota' => 'Nota',
            'fecha_proceso' => 'Fecha Proceso',
            'usuariosistema' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncapacidad()
    {
        return $this->hasOne(Incapacidad::className(), ['id_incapacidad' => 'id_incapacidad']);
    }
}
