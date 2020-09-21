<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "licencia".
 *
 * @property int $id_licencia_pk
 * @property int $codigo_licencia
 * @property int $id_empleado
 * @property int $id_contrato
 * @property int $id_grupo_pago
 * @property string $fecha_desde
 * @property string $fecha_hasta
 * @property string $fecha_proceso
 * @property string $fecha_aplicacion
 * @property int $dias_licencia
 * @property int $afecta_transporte
 * @property int $cobrar_administradora
 * @property int $aplicar_adicional
 * @property int $pagar_empleado
 * @property string $observacion
 * @property string $usuariosistema
 *
 * @property ConfiguracionLicencia $codigoLicencia
 * @property Empleado $empleado
 * @property Contrato $contrato
 * @property GrupoPago $grupoPago
 */
class Licencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licencia';
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
            [['codigo_licencia', 'id_licencia_pk','id_empleado', 'id_contrato', 'id_grupo_pago', 'fecha_desde', 'fecha_hasta', 'fecha_aplicacion', 'dias_licencia', 'usuariosistema', 'identificacion'], 'required'],
            [['codigo_licencia', 'id_empleado', 'id_contrato', 'id_grupo_pago', 'dias_licencia', 'afecta_transporte', 'cobrar_administradora', 'aplicar_adicional', 'pagar_empleado'], 'integer'],
            [['fecha_desde', 'fecha_hasta', 'fecha_proceso', 'fecha_aplicacion'], 'safe'],
            [['observacion'], 'string', 'max' => 200],
            [['usuariosistema'], 'string', 'max' => 30],
            [['codigo_licencia'], 'exist', 'skipOnError' => true, 'targetClass' => ConfiguracionLicencia::className(), 'targetAttribute' => ['codigo_licencia' => 'codigo_licencia']],
            [['id_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['id_empleado' => 'id_empleado']],
            [['id_contrato'], 'exist', 'skipOnError' => true, 'targetClass' => Contrato::className(), 'targetAttribute' => ['id_contrato' => 'id_contrato']],
            [['id_grupo_pago'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoPago::className(), 'targetAttribute' => ['id_grupo_pago' => 'id_grupo_pago']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_licencia_pk' => 'Id',
            'codigo_licencia' => 'Tipo Licencia',
            'id_empleado' => 'Empleado',
            'identificacion'=>'Documento',
            'id_contrato' => 'Contrato',
            'id_grupo_pago' => 'Grupo Pago',
            'fecha_desde' => 'Desde',
            'fecha_hasta' => ' Hasta',
            'fecha_proceso' => 'Fecha Proceso',
            'fecha_aplicacion' => 'Fecha Aplicacion',
            'dias_licencia' => 'Dias Licencia',
            'afecta_transporte' => 'Afecta Transporte',
            'cobrar_administradora' => 'Cobrar Eps',
            'aplicar_adicional' => 'Adicional',
            'pagar_empleado' => 'Pagar Empleado',
            'observacion' => 'Observacion',
            'usuariosistema' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoLicencia()
    {
        return $this->hasOne(ConfiguracionLicencia::className(), ['codigo_licencia' => 'codigo_licencia']);
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
    public function getContrato()
    {
        return $this->hasOne(Contrato::className(), ['id_contrato' => 'id_contrato']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoPago()
    {
        return $this->hasOne(GrupoPago::className(), ['id_grupo_pago' => 'id_grupo_pago']);
    }
    
    public function getafectatransporte(){
        if($this->afecta_transporte == 1){
            $afectatransporte = "SI";
            
        }else{
           $afectatransporte = "NO"; 
        }
        return $afectatransporte;
    }
    
    public function getcobraradministradora(){
        if($this->cobrar_administradora == 1){
            $cobraradministradora= "SI";
            
        }else{
           $cobraradministradora = "NO"; 
        }
        return $cobraradministradora;
    }
    
    public function getaplicaradicional(){
        if($this->aplicar_adicional == 1){
            $aplicaradicional= "SI";
            
        }else{
           $aplicaradicional = "NO"; 
        }
        return $aplicaradicional;
    }
   
    public function getpagarempleado(){
        if($this->pagar_empleado == 1){
            $pagarempleado= "SI";
            
        }else{
           $pagarempleado = "NO"; 
        }
        return $pagarempleado;
    }
}
