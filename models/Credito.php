<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "credito".
 *
 * @property int $id_credito
 * @property int $id_empleado
 * @property int $codigo_credito
 * @property int $id_tipo_pago
 * @property double $vlr_credito
 * @property double $vlr_cuota
 * @property int $numero_cuotas
 * @property int $numero_cuota_actual
 * @property int $validar_cuotas
 * @property string $fecha_creacion
 * @property string $fecha_inicio
 * @property double $seguro
 * @property string $numero_libranza
 * @property double $saldo_credito
 * @property int $estado_credito
 * @property int $estado_periodo
 * @property int $aplicar_prima
 * @property int $vlr_aplicar
 * @property string $observacion
 * @property string $usuariosistema
 *
 * @property Empleado $empleado
 * @property ConfiguracionCredito $codigoCredito
 * @property TipoPagoCredito $tipoPago
 */
class Credito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'credito';
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
            [['id_empleado', 'codigo_credito', 'id_tipo_pago', 'vlr_credito', 'vlr_cuota', 'numero_cuotas', 'validar_cuotas', 'fecha_inicio', 'id_grupo_pago'], 'required'],
            [['id_empleado', 'codigo_credito', 'id_tipo_pago', 'numero_cuotas', 'numero_cuota_actual', 'validar_cuotas', 'estado_credito', 'estado_periodo', 'aplicar_prima', 'vlr_aplicar', 'id_grupo_pago'], 'integer'],
            [['vlr_credito', 'vlr_cuota', 'seguro', 'saldo_credito'], 'number'],
            [['fecha_creacion', 'fecha_inicio'], 'safe'],
            [['numero_libranza'], 'string', 'max' => 15],
            [['observacion'], 'string', 'max' => 100],
            [['usuariosistema'], 'string', 'max' => 30],
            [['id_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['id_empleado' => 'id_empleado']],
            [['codigo_credito'], 'exist', 'skipOnError' => true, 'targetClass' => ConfiguracionCredito::className(), 'targetAttribute' => ['codigo_credito' => 'codigo_credito']],
            [['id_tipo_pago'], 'exist', 'skipOnError' => true, 'targetClass' => TipoPagoCredito::className(), 'targetAttribute' => ['id_tipo_pago' => 'id_tipo_pago']],
            [['id_grupo_pago'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoPago::className(), 'targetAttribute' => ['id_grupo_pago' => 'id_grupo_pago']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_credito' => 'Id:',
            'id_empleado' => 'Empleado:',
            'codigo_credito' => 'Tipo credito:',
            'id_tipo_pago' => 'Forma pago:',
            'vlr_credito' => 'Valor crédito:',
            'vlr_cuota' => 'Valor cuota:',
            'numero_cuotas' => 'Numero cuotas:',
            'numero_cuota_actual' => 'Numero cuota actual:',
            'validar_cuotas' => 'Validar cuota:',
            'fecha_creacion' => 'Fecha creacion:',
            'fecha_inicio' => 'Fecha inicio:',
            'seguro' => 'Seguro:',
            'numero_libranza' => 'Número libranza:',
            'saldo_credito' => 'Saldo crédito:',
            'estado_credito' => 'Crédito activo',
            'estado_periodo' => 'Periodo activo',
            'aplicar_prima' => 'Aplicar prima:',
            'vlr_aplicar' => 'Valor aplicar',
            'observacion' => 'Observacion:',
            'usuariosistema' => 'Usuario:',
            'id_grupo_pago' => 'Grupo de pago:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleado()
    {
        return $this->hasOne(Empleado::className(), ['id_empleado' => 'id_empleado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoCredito()
    {
        return $this->hasOne(ConfiguracionCredito::className(), ['codigo_credito' => 'codigo_credito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoPago()
    {
        return $this->hasOne(TipoPagoCredito::className(), ['id_tipo_pago' => 'id_tipo_pago']);
    }
     public function getGrupoPago()
    {
        return $this->hasOne(GrupoPago::className(), ['id_grupo_pago' => 'id_grupo_pago']);
    }
    
    public function getEstadocredito(){
        if($this->estado_credito == 1){
            $estadocredito = 'SI';
        }else{
            $estadocredito = 'NO';
        }
        return $estadocredito;
    }
    public function getEstadoperiodo(){
        if($this->estado_periodo == 1){
            $estadoperiodo = 'SI';
        }else{
            $estadoperiodo = 'NO';
        }
        return $estadoperiodo;
    }
    
    public function getValidarcuota(){
        if($this->validar_cuotas == 1){
            $validarcuota = 'SI';
        }else{
            $validarcuota = 'NO';
        }
        return $validarcuota;
    }
    public function getAplicarprima(){
        if($this->aplicar_prima == 1){
            $aplicarprima = 'SI';
        }else{
            $aplicarprima = 'NO';
        }
        return $aplicarprima;
    }
    
}
