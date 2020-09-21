<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configuracion_licencia".
 *
 * @property int $codigo_licencia
 * @property string $concepto
 * @property int $afecta_salud
 * @property int $ausentismo
 * @property int $maternidad
 * @property int $paternidad
 * @property int $suspension_contrato
 * @property int $remunerada
 * @property int $codigo_salario
 *
 * @property ConceptoSalarios $codigoSalario
 */
class ConfiguracionLicencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'configuracion_licencia';
    }
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->concepto = strtoupper($this->concepto);        
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['concepto', 'codigo_salario'], 'required'],
            [['afecta_salud', 'ausentismo', 'maternidad', 'paternidad', 'suspension_contrato', 'remunerada', 'codigo_salario','codigo'], 'integer'],
            [['porcentaje'], 'number'],
            [['concepto'], 'string', 'max' => 40],
             ['concepto', 'match', 'pattern' => '/^[a-z\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            [['codigo_salario'], 'exist', 'skipOnError' => true, 'targetClass' => ConceptoSalarios::className(), 'targetAttribute' => ['codigo_salario' => 'codigo_salario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_licencia' => 'Codigo',
            'concepto' => 'Concepto licencia:',
            'afecta_salud' => 'Afecta Salud',
            'ausentismo' => 'Ausentismo',
            'maternidad' => 'Maternidad',
            'paternidad' => 'Paternidad',
            'suspension_contrato' => 'Suspension',
            'remunerada' => 'Remunerada',
            'codigo_salario' => 'Concepto Salario:',
            'codigo' => 'Tipo:',
            'porcentaje' =>'Porcentaje:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoSalario()
    {
        return $this->hasOne(ConceptoSalarios::className(), ['codigo_salario' => 'codigo_salario']);
    }
    public function getConceptoSalarios()
    {
        return $this->hasOne(ConceptoSalarios::className(), ['codigo_salario' => 'codigo_salario']);
    }
    
     public function getConfiguracionLicencia()
    {
        return $this->hasMany(ConfiguracionLicencia::className(), ['codigo_licencia' => 'codigo_licencia']);
    }
    public function getafectaSalud()
    {
        if($this->afecta_salud == 1){
            $afectasalud= "SI";
        }else{
            $afectasalud = "NO";
        }
        return $afectasalud;
    }
    public function getlAusentismo()
    {
        if($this->ausentismo == 1){
            $lausentismo= "SI";
        }else{
            $lausentismo = "NO";
        }
        return $lausentismo;
    }
     public function getlMaternidad()
    {
        if($this->maternidad == 1){
            $lmaternidad= "SI";
        }else{
            $lmaternidad = "NO";
        }
        return $lmaternidad;
    }
     public function getlicenciaPaternidad()
    {
        if($this->paternidad == 1){
            $licenciapaternidad= "SI";
        }else{
            $licenciapaternidad = "NO";
        }
        return $licenciapaternidad;
    }
     public function getlRemunerada()
    {
        if($this->remunerada == 1){
            $lremunerada= "SI";
        }else{
            $lremunerada = "NO";
        }
        return $lremunerada;
    }
     public function getsuspensionContrato()
    {
        if($this->suspension_contrato == 1){
            $suspensioncontrato= "SI";
        }else{
            $suspensioncontrato = "NO";
        }
        return $suspensioncontrato;
    }
}
