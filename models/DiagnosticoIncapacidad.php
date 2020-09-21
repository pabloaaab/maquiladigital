<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diagnostico_incapacidad".
 *
 * @property string $codigo_diagnostico
 * @property string $diagnostico
 */
class DiagnosticoIncapacidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnostico_incapacidad';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->codigo_diagnostico = strtoupper($this->codigo_diagnostico);        
         $this->diagnostico = strtoupper($this->diagnostico); 
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_diagnostico', 'diagnostico'], 'required'],
            [['codigo_diagnostico'], 'string', 'max' => 10],
            [['diagnostico'], 'string', 'max' => 100],
            [['codigo_diagnostico'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_codigo' => 'Id',
            'codigo_diagnostico' => 'Codigo',
            'diagnostico' => 'Diagnostico',
        ];
    }

    public function getDiagnostico()
    {
        return $this->hasMany(DiagnosticoIncapacidad::className(), ['codigo_diagnostico' => 'codigo_diagnostico']);
    }
    
     public function diagnosticovalidar($attribute, $params)
    {
        //Buscar la identificacion en la tabla
        $table = DiagnosticoIncapacidad::find()->where("codigo_diagnostico=:codigo_diagnostico", [":codigo_diagnostico" => $this->codigo_diagnostico]);
        //Si la identificacion no existe en inscritos mostrar el error
        if ($table->count() > 1)
        {
            $this->addError($attribute, "El código de diagnótico ya existe");
        }
    }
}   
