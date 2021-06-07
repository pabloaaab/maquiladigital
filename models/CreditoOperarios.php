<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "credito_operarios".
 *
 * @property int $id_credito
 * @property int $id_operario
 * @property int $codigo_credito
 * @property double $vlr_credito
 * @property double $vlr_cuota
 * @property int $numero_cuotas
 * @property int $numero_cuota_actual
 * @property int $validar_cuotas
 * @property string $fecha_creacion
 * @property string $fecha_inicio
 * @property double $saldo_credito
 * @property int $estado_credito
 * @property string $observacion
 * @property string $usuariosistema
 *
 * @property AbonoCreditoOperarios[] $abonoCreditoOperarios
 * @property Operarios $operario
 * @property ConfiguracionCredito $codigoCredito
 */
class CreditoOperarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'credito_operarios';
    }
      public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->observacion = strtolower($this->observacion); 
        $this->observacion = ucfirst($this->observacion);  
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_operario', 'codigo_credito', 'vlr_credito', 'vlr_cuota', 'numero_cuotas', 'validar_cuotas', 'fecha_inicio'], 'required'],
            [['id_operario', 'codigo_credito', 'numero_cuotas', 'numero_cuota_actual', 'validar_cuotas', 'estado_credito'], 'integer'],
            [['vlr_credito', 'vlr_cuota', 'saldo_credito'], 'number'],
            [['fecha_creacion', 'fecha_inicio'], 'safe'],
            [['observacion'], 'string', 'max' => 100],
            [['usuariosistema'], 'string', 'max' => 20],
            [['id_operario'], 'exist', 'skipOnError' => true, 'targetClass' => Operarios::className(), 'targetAttribute' => ['id_operario' => 'id_operario']],
            [['codigo_credito'], 'exist', 'skipOnError' => true, 'targetClass' => ConfiguracionCredito::className(), 'targetAttribute' => ['codigo_credito' => 'codigo_credito']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_credito' => 'Id Credito',
            'id_operario' => 'Id Operario',
            'codigo_credito' => 'Codigo Credito',
            'vlr_credito' => 'Vlr Credito',
            'vlr_cuota' => 'Vlr Cuota',
            'numero_cuotas' => 'Numero Cuotas',
            'numero_cuota_actual' => 'Numero Cuota Actual',
            'validar_cuotas' => 'Validar Cuotas',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_inicio' => 'Fecha Inicio',
            'saldo_credito' => 'Saldo Credito',
            'estado_credito' => 'Estado Credito',
            'observacion' => 'Observacion',
            'usuariosistema' => 'Usuariosistema',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbonoCreditoOperarios()
    {
        return $this->hasMany(AbonoCreditoOperarios::className(), ['id_credito' => 'id_credito']);
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
    public function getCodigoCredito()
    {
        return $this->hasOne(ConfiguracionCredito::className(), ['codigo_credito' => 'codigo_credito']);
    }
    
    public function getEstadocredito(){
        if($this->estado_credito == 1){
            $estadocredito = 'SI';
        }else{
            $estadocredito = 'NO';
        }
        return $estadocredito;
    }
    
      public function getValidarcuota(){
        if($this->validar_cuotas == 1){
            $validarcuota = 'SI';
        }else{
            $validarcuota = 'NO';
        }
        return $validarcuota;
    }
}
