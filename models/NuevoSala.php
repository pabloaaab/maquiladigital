<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cambio_salario".
 *
 * @property int $id_cambio_salario
 * @property int $nuevo_salario
 * @property string $fecha_aplicacion
 * @property string $usuariosistema
 * @property int $id_contrato
 * @property string $observacion
 * @property string $fecha_creacion
 *
 * @property Contrato $contrato
 */
class NuevoSala extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cambio_salario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nuevo_salario', 'fecha_aplicacion'], 'required'],
            [['nuevo_salario', 'id_contrato'], 'integer'],
            [['fecha_aplicacion', 'fecha_creacion'], 'safe'],
            [['usuariosistema'], 'string', 'max' => 30],
            [['observacion'], 'string', 'max' => 40],
            [['id_contrato'], 'exist', 'skipOnError' => true, 'targetClass' => Contrato::className(), 'targetAttribute' => ['id_contrato' => 'id_contrato']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cambio_salario' => 'Id Cambio Salario',
            'nuevo_salario' => 'Nuevo Salario',
            'fecha_aplicacion' => 'Fecha Aplicacion',
            'usuariosistema' => 'Usuariosistema',
            'id_contrato' => 'Id Contrato',
            'observacion' => 'Observacion',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContrato()
    {
        return $this->hasOne(Contrato::className(), ['id_contrato' => 'id_contrato']);
    }
}
