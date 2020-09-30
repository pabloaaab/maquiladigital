<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maquina_operario".
 *
 * @property int $id
 * @property int $id_operario
 * @property int $id_tipo
 * @property string $fecha_registro
 * @property string $usuariosistema
 *
 * @property Operarios $operario
 * @property TiposMaquinas $tipo
 */
class MaquinaOperario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maquina_operario';
    }
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_operario'], 'required'],
            [['id_operario', 'id_tipo','cantidad'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['usuariosistema'], 'string', 'max' => 20],
            [['id_operario'], 'exist', 'skipOnError' => true, 'targetClass' => Operarios::className(), 'targetAttribute' => ['id_operario' => 'id_operario']],
            [['id_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => TiposMaquinas::className(), 'targetAttribute' => ['id_tipo' => 'id_tipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_operario' => 'Id Operario',
            'id_tipo' => 'Id Tipo',
            'fecha_registro' => 'Fecha Registro',
            'usuariosistema' => 'Usuariosistema',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperario()
    {
        return $this->hasOne(Operarios::className(), ['id_operario' => 'id_operario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TiposMaquinas::className(), ['id_tipo' => 'id_tipo']);
    }
}
