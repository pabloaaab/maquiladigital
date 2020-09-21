<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cambio_eps".
 *
 * @property int $id_cambio
 * @property int $id_contrato
 * @property int $id_entidad_salud_anterior
 * @property int $id_entidad_salud_nueva
 * @property string $fecha_cambio
 * @property string $usuariosistema
 * @property string $motivo
 *
 * @property Contrato $contrato
 * @property EntidadSalud $entidadSaludAnterior
 * @property EntidadSalud $entidadSaludNueva
 */
class CambioEps extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cambio_eps';
    }
     public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->motivo = strtoupper($this->motivo);        
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_entidad_salud_nueva'], 'required'],
            [['id_contrato', 'id_entidad_salud_anterior', 'id_entidad_salud_nueva'], 'integer'],
            [['usuariosistema'], 'string', 'max' => 20],
            [['motivo'], 'string', 'max' => 100],
            [['id_contrato'], 'exist', 'skipOnError' => true, 'targetClass' => Contrato::className(), 'targetAttribute' => ['id_contrato' => 'id_contrato']],
            [['id_entidad_salud_anterior'], 'exist', 'skipOnError' => true, 'targetClass' => EntidadSalud::className(), 'targetAttribute' => ['id_entidad_salud_anterior' => 'id_entidad_salud']],
            [['id_entidad_salud_nueva'], 'exist', 'skipOnError' => true, 'targetClass' => EntidadSalud::className(), 'targetAttribute' => ['id_entidad_salud_nueva' => 'id_entidad_salud']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cambio' => 'Codigo',
            'id_contrato' => 'Nro Contrato',
            'id_entidad_salud_anterior' => 'Entidad Salud Anterior:',
            'id_entidad_salud_nueva' => 'Nueva entidad salud:',
            'usuariosistema' => 'Usuario:',
            'motivo' => 'Motivo:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContrato()
    {
        return $this->hasOne(Contrato::className(), ['id_contrato' => 'id_contrato']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
        public function getEntidadSaludAnterior()
    {
        return $this->hasOne(EntidadSalud::className(), ['id_entidad_salud' => 'id_entidad_salud_anterior']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntidadSaludNueva()
    {
        return $this->hasOne(EntidadSalud::className(), ['id_entidad_salud' => 'id_entidad_salud_nueva']);
    }
}
