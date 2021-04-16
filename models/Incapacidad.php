<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "incapacidad".
 *
 * @property int $id_incapacidad
 * @property int $codigo_incapacidad
 * @property int $id_empleado
 * @property int $identificacion
 * @property int $id_contrato
 * @property int $id_grupo_pago
 * @property int $id_diagnostico
 * @property string $numero_incapacidad
 * @property string $nombre_medico
 * @property string $fecha_inicio
 * @property string $fecha_final
 * @property string $fecha_creacion
 * @property int $dias_incapacidad
 * @property double $salario_mes_anterior
 * @property double $salario
 * @property double $vlr_liquidado
 * @property double $porcentaje_pago
 * @property int $dias_cobro_eps
 * @property double $vlr_cobro_administradora
 * @property int $pagar_empleado
 * @property double $vlr_saldo_administrador
 * @property int $id_entidad_salud
 * @property int $prorroga
 * @property string $fecha_inicio_empresa
 * @property string $fecha_final_empresa
 * @property string $fecha_inicio_administradora
 * @property string $fecha_final_administradora
 * @property double $dias_administradora
 * @property double $dias_empresa
 * @property double $dias_acumulados
 * @property double $vlr_hora
 * @property string $usuariosistema
 *
 * @property ConfiguracionIncapacidad $codigoIncapacidad
 * @property Empleado $empleado
 * @property Contrato $contrato
 * @property GrupoPago $grupoPago
 * @property DiagnosticoIncapacidad $diagnostico
 * @property EntidadSalud $entidadSalud
 */
class Incapacidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incapacidad';
    }
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->numero_incapacidad = strtoupper($this->numero_incapacidad);        
        $this->nombre_medico = strtoupper($this->nombre_medico);        
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
            [['codigo_incapacidad', 'id_empleado', 'id_codigo', 'numero_incapacidad', 'fecha_inicio', 'fecha_final', 'fecha_documento_fisico', 'fecha_aplicacion'], 'required'],
            [['id_incapacidad', 'codigo_incapacidad', 'id_empleado', 'identificacion', 'id_contrato', 'id_grupo_pago', 'id_codigo', 'numero_incapacidad','dias_incapacidad', 'dias_cobro_eps','dias_cobro_eps', 'transcripcion',
                'cobrar_administradora','aplicar_adicional','pagar_empleado', 'id_entidad_salud', 'prorroga','numero_incapacidad','vlr_pago_empresa','ibc_total_incapacidad','estado_incapacidad_adicional'], 'integer'],
            [['fecha_inicio', 'fecha_final','fecha_documento_fisico','fecha_aplicacion','fecha_creacion', 'fecha_inicio_empresa', 'fecha_final_empresa', 'fecha_inicio_administradora', 'fecha_final_administradora'], 'safe'],
            [['salario_mes_anterior', 'salario', 'vlr_liquidado', 'porcentaje_pago', 'vlr_cobro_administradora', 'vlr_saldo_administrador', 'dias_administradora', 'dias_empresa', 'dias_acumulados', 'vlr_hora'], 'number'],
            [['nombre_medico'], 'string', 'max' => 50],
            [['usuariosistema'], 'string', 'max' => 30],
             [['observacion'], 'string', 'max' => 100],
            [['codigo_diagnostico'], 'string'],
            [['codigo_incapacidad'], 'exist', 'skipOnError' => true, 'targetClass' => ConfiguracionIncapacidad::className(), 'targetAttribute' => ['codigo_incapacidad' => 'codigo_incapacidad']],
            [['id_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['id_empleado' => 'id_empleado']],
            [['id_contrato'], 'exist', 'skipOnError' => true, 'targetClass' => Contrato::className(), 'targetAttribute' => ['id_contrato' => 'id_contrato']],
            [['id_grupo_pago'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoPago::className(), 'targetAttribute' => ['id_grupo_pago' => 'id_grupo_pago']],
            [['id_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => DiagnosticoIncapacidad::className(), 'targetAttribute' => ['id_codigo' => 'id_codigo']],
            [['id_entidad_salud'], 'exist', 'skipOnError' => true, 'targetClass' => EntidadSalud::className(), 'targetAttribute' => ['id_entidad_salud' => 'id_entidad_salud']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_incapacidad' => 'Id Incapacidad',
            'codigo_incapacidad' => 'Tipo Incapacidad',
            'id_empleado' => 'Empleado(a)',
            'identificacion' => 'Identificacion',
            'id_contrato' => 'Id Contrato',
            'id_grupo_pago' => 'Grupo Pago',
            'id_codigo' => 'Codigo',
            'codigo_diagnostico'=>'Codigo diagnóstico',
            'numero_incapacidad' => 'Numero Incapacidad',
            'nombre_medico' => 'Nombre Medico',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_final' => 'Fecha Final',
            'fecha_creacion' => 'Fecha Creacion',
            'dias_incapacidad' => 'Dias Incapacidad',
            'salario_mes_anterior' => 'Salario Mes Anterior',
            'salario' => 'Salario',
            'vlr_liquidado' => 'Vlr incapacidad',
            'porcentaje_pago' => 'Porcentaje Pago',
            'dias_cobro_eps' => 'Dias Cobro Eps',
            'vlr_cobro_administradora' => 'Cobro administradora',
            'pagar_empleado' => 'Pagar Empleado',
            'vlr_saldo_administradora' => 'Vlr Saldo Administradora',
            'id_entidad_salud' => 'Eps',
            'prorroga' => 'Prorroga',
            'fecha_inicio_empresa' => 'Fecha Inicio Empresa',
            'fecha_final_empresa' => 'Fecha Final Empresa',
            'fecha_inicio_administradora' => 'Fecha Inicio Administradora',
            'fecha_final_administradora' => 'Fecha Final Administradora',
            'dias_administradora' => 'Dias Administradora',
            'dias_empresa' => 'Dias Empresa',
            'vlr_pago_empresa' => 'vlr_pago_empresa',
            'dias_acumulados' => 'Dias Acumulados',
            'vlr_hora' => 'Vlr Hora',
            'usuariosistema' => 'Usuario',
            'fecha_documento_fisico'=> 'Fecha_documento_fisico',
            'fecha_aplicacion'=> 'Fecha_aplicacion',
            'transcripcion' =>'Transcripcion',
            'cobrar_administradora'=> 'Cobrar_administradora',
            'aplicar_adicional' => 'Aplicar_adicional',
            'observacion' => 'Observacion',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoIncapacidad()
    {
        return $this->hasOne(ConfiguracionIncapacidad::className(), ['codigo_incapacidad' => 'codigo_incapacidad']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnostico()
    {
        return $this->hasOne(DiagnosticoIncapacidad::className(), ['id_codigo' => 'id_diagnostico']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntidadSalud()
    {
        return $this->hasOne(EntidadSalud::className(), ['id_entidad_salud' => 'id_entidad_salud']);
    }
    
    public function getCobraradministradora(){
         if($this->cobrar_administradora == 1){
            $cobraradministradora = "SI";
        }else{
            $cobraradministradora = "NO";
        }
        return $cobraradministradora;
    }
    public function getAplicaradicional(){
         if($this->aplicar_adicional == 1){
            $aplicaradicional = "SI";
        }else{
            $aplicaradicional = "NO";
        }
        return $aplicaradicional;
    }
    public function getTranscripcionincapacidad(){
         if($this->transcripcion == 1){
            $transcripcionincapacidad = "SI";
        }else{
            $transcripcionincapacidad = "NO";
        }
        return $transcripcionincapacidad;
    }
     public function getPagarempleado(){
         if($this->pagar_empleado == 1){
            $pagarempleado = "SI";
        }else{
            $pagarempleado = "NO";
        }
        return $pagarempleado;
    }
    public function getProrrogaIncapacidad(){
         if($this->prorroga == 1){
            $prorrogaincapacidad = "SI";
        }else{
            $prorrogaincapacidad = "NO";
        }
        return $prorrogaincapacidad;
    }
}
