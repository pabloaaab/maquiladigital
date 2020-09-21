<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Empleado;
use app\models\Contrato;
use app\models\Departamentos;
use app\models\TiempoServicio;
use app\models\Municipio;
use app\models\Cargo;
use app\models\Arl;
use app\models\TipoCotizante;
use app\models\SubtipoCotizante;
use app\models\TipoContrato;
use app\models\EntidadPension;
use app\models\EntidadSalud;
use app\models\CajaCompensacion;
use app\models\ConfiguracionEps;
use app\models\ConfiguracionPension;
use app\models\Cesantia;

/**
 * ContactForm is the model behind the contact form.
 */
class FormContratoNuevoEmpleado extends Model
{        
    public $id_tipo_contrato;
    public $id_tiempo;
    public $id_contrato;
    public $id_cargo;
    public $descripcion;
    public $fecha_inicio;
    public $fecha_final;
    public $tipo_salario;
    public $salario;
    public $auxilio_transporte;
    public $horario_trabajo;
    public $comentarios;
    public $funciones_especificas;
    public $id_tipo_cotizante;
    public $id_subtipo_cotizante;
    public $id_eps;
    public $id_entidad_salud;
    public $id_pension;
    public $id_entidad_pension;
    public $id_caja_compensacion;        
    public $id_cesantia;
    public $id_arl;    
    public $ciudad_laboral;
    public $ciudad_contratado;
    public $id_centro_trabajo;
    public $id_grupo_pago;
    public $genera_prorroga;
    public $dias_contrato;
    public $fecha_preaviso;
    public $generar_liquidacion;
    public $usuario_creacion;
    public $usuario_editor;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tipo_contrato','id_tiempo','id_cargo','descripcion','fecha_inicio','tipo_salario','salario','auxilio_transporte','horario_trabajo','id_tipo_cotizante','id_subtipo_cotizante',
                'id_entidad_salud','id_entidad_pension','id_caja_compensacion','id_cesantia','id_arl','ciudad_laboral','ciudad_contratado',
                'id_centro_trabajo','id_grupo_pago','id_eps','id_pension'], 'required', 'message' => 'Campo requerido'],            
            [['id_contrato','id_tipo_contrato','id_cargo','id_tipo_cotizante','id_subtipo_cotizante','id_tiempo','id_eps', 'id_pension','generar_liquidacion'], 'integer'],
            [['comentarios','funciones_especificas'], 'string'],            
            [['salario'], 'number'], 
            [['fecha_inicio','fecha_final'], 'safe'],            
            [['id_tipo_contrato'], 'exist', 'skipOnError' => true, 'targetClass' => TipoContrato::className(), 'targetAttribute' => ['id_tipo_contrato' => 'id_tipo_contrato']],            
            [['ciudad_laboral'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['ciudad_laboral' => 'idmunicipio']],
            [['ciudad_contratado'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['ciudad_contratado' => 'idmunicipio']],
            [['id_arl'], 'exist', 'skipOnError' => true, 'targetClass' => Arl::className(), 'targetAttribute' => ['id_arl' => 'id_arl']],
            [['id_cargo'], 'exist', 'skipOnError' => true, 'targetClass' => Cargo::className(), 'targetAttribute' => ['id_cargo' => 'id_cargo']],
            [['id_tipo_cotizante'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCotizante::className(), 'targetAttribute' => ['id_tipo_cotizante' => 'id_tipo_cotizante']],
            [['id_subtipo_cotizante'], 'exist', 'skipOnError' => true, 'targetClass' => SubtipoCotizante::className(), 'targetAttribute' => ['id_subtipo_cotizante' => 'id_subtipo_cotizante']],
            [['id_entidad_salud'], 'exist', 'skipOnError' => true, 'targetClass' => EntidadSalud::className(), 'targetAttribute' => ['id_entidad_salud' => 'id_entidad_salud']],
            [['id_entidad_pension'], 'exist', 'skipOnError' => true, 'targetClass' => EntidadPension::className(), 'targetAttribute' => ['id_entidad_pension' => 'id_entidad_pension']],
            [['id_caja_compensacion'], 'exist', 'skipOnError' => true, 'targetClass' => CajaCompensacion::className(), 'targetAttribute' => ['id_caja_compensacion' => 'id_caja_compensacion']],
            [['id_cesantia'], 'exist', 'skipOnError' => true, 'targetClass' => Cesantia::className(), 'targetAttribute' => ['id_cesantia' => 'id_cesantia']],
            [['id_tiempo'], 'exist', 'skipOnError' => true, 'targetClass' => TiempoServicio::className(), 'targetAttribute' => ['id_tiempo' => 'id_tiempo']],
            [['id_eps'], 'exist', 'skipOnError' => true, 'targetClass' => ConfiguracionEps::className(), 'targetAttribute' => ['id_eps' => 'id_eps']],
            [['id_pension'], 'exist', 'skipOnError' => true, 'targetClass' => ConfiguracionPension::className(), 'targetAttribute' => ['id_pension' => 'id_pension']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'id_contrato' => 'Id',
            'id_tipo_contrato' => 'Tipo Contrato',
            'id_tiempo' => 'Tiempo',
            'id_cargo' => 'Cargo',
            'descripcion' => 'Descripcion',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_final' => 'Fecha Final',
            'tipo_salario' => 'Tipo Salario',
            'salario' => 'Salario',
            'auxilio_transporte' => 'Auxilio Transporte',
            'horario_trabajo' => 'Horario Trabajo',
            'comentarios' => 'Comentarios',
            'funciones_especificas' => 'Funciones Especificas',
            'id_tipo_cotizante' => 'Tipo Cotizante',
            'id_subtipo_cotizante' => 'Subtipo Cotizante',
            'id_subtipo_cotizante' => 'Subtipo Cotizante',
            'id_entidad_salud' => 'Entidad Salud',
            'id_eps' => 'Tipo Salud',
            'id_centro_trabajo' => 'Centro trabajo',
            'id_grupo_pago' => 'Grupo Pago',
            'id_pension' => 'Tipo Pension',
            'id_entidad_pension' => 'Entidad Pension',
            'id_caja_compensacion' => 'Caja Compensacion',
            'id_cesantia' => 'Cesantia',
            'id_arl' => 'Arl',            
            'ciudad_laboral' => 'Ciudad Laboral',
            'ciudad_contratado' => 'Ciudad Contratado',     
            'generar_liquidacion' => 'generar_liquidacion',
        ];
    }                   
}
