<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacaciones_adicion".
 *
 * @property int $id_adicion
 * @property int $id_vacacion
 * @property int $codigo_salario
 * @property int $tipo_adicion
 * @property int $valor_adicion
 * @property string $observacion
 * @property string $usuariosistema
 * @property string $fecha_creacion
 *
 * @property Vacaciones $vacacion
 * @property ConceptoSalarios $codigoSalario
 */
class VacacionesAdicion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacaciones_adicion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_vacacion', 'codigo_salario', 'tipo_adicion', 'valor_adicion'], 'integer'],
            [['codigo_salario', 'valor_adicion'], 'required'],
            [['fecha_creacion'], 'safe'],
            [['observacion'], 'string', 'max' => 100],
            [['usuariosistema'], 'string', 'max' => 30],
            [['id_vacacion'], 'exist', 'skipOnError' => true, 'targetClass' => Vacaciones::className(), 'targetAttribute' => ['id_vacacion' => 'id_vacacion']],
            [['codigo_salario'], 'exist', 'skipOnError' => true, 'targetClass' => ConceptoSalarios::className(), 'targetAttribute' => ['codigo_salario' => 'codigo_salario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_adicion' => 'Id Adicion',
            'id_vacacion' => 'Id Vacacion',
            'codigo_salario' => 'Codigo Salario',
            'tipo_adicion' => 'Tipo Adicion',
            'valor_adicion' => 'Valor Adicion',
            'observacion' => 'Observacion',
            'usuariosistema' => 'Usuariosistema',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacacion()
    {
        return $this->hasOne(Vacaciones::className(), ['id_vacacion' => 'id_vacacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoSalario()
    {
        return $this->hasOne(ConceptoSalarios::className(), ['codigo_salario' => 'codigo_salario']);
    }
}
