<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "centro_trabajo".
 *
 * @property int $id_centro_trabajo
 * @property string $centro_trabajo
 * @property int $estado
 *
 * @property Contrato[] $contratos
 */
class CentroTrabajo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'centro_trabajo';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->centro_trabajo = strtoupper($this->centro_trabajo);        
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'integer'],
            [['centro_trabajo'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_centro_trabajo' => 'Id',
            'centro_trabajo' => 'Centro Trabajo',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['id_centro_trabajo' => 'id_centro_trabajo']);
    }
    
    public function getActivo()
    {
        if($this->estado == 1){
            $activo = "SI";
        }else{
            $activo = "NO";
        }
        return $activo;
    }
}
