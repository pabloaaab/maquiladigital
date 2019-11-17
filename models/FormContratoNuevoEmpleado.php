<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Empleado;
use app\models\Contrato;
use app\models\Departamentos;
use app\models\Municipio;
use app\models\Cargo;
use app\models\Arl;
use app\models\TipoCotizante;
use app\models\SubtipoCotizante;
use app\models\TipoContrato;
use app\models\EntidadPension;
use app\models\EntidadSalud;
use app\models\CajaCompensacion;
use app\models\Cesantia;

/**
 * ContactForm is the model behind the contact form.
 */
class FormContratoNuevoEmpleado extends Model
{        
    public $id_tipo_contrato;
    public $tiempo_contrato;
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
    public $tipo_salud;
    public $id_entidad_salud;
    public $tipo_pension;
    public $id_entidad_pension;
    public $id_caja_compensacion;        
    public $id_cesantia;
    public $id_arl;    
    public $ciudad_laboral;
    public $ciudad_contratado;
    public $id_centro_trabajo;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tipo_contrato','tiempo_contrato','id_cargo','descripcion','fecha_inicio','fecha_final','tipo_salario','salario','auxilio_transporte','horario_trabajo','comentarios','funciones_especificas','id_tipo_cotizante','id_subtipo_cotizante','tipo_salud','id_entidad_salud','tipo_pension','id_entidad_pension','id_caja_compensacion','id_cesantia','id_arl','ciudad_laboral','ciudad_contratado','id_centro_trabajo'], 'required', 'message' => 'Campo requerido'],            
            [['id_contrato','id_tipo_contrato','id_cargo','id_tipo_cotizante','id_subtipo_cotizante'], 'integer'],
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
            'tiempo_contrato' => 'Tiempo',
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
            'tipo_salud' => 'Tipo Salud',
            'id_centro_trabajo' => 'Centro trabajo',
            'tipo_pension' => 'Tipo Pension',
            'id_entidad_pension' => 'Entidad Pension',
            'id_caja_compensacion' => 'Caja Compensacion',
            'id_cesantia' => 'Cesantia',
            'id_arl' => 'Arl',            
            'ciudad_laboral' => 'Ciudad Laboral',
            'ciudad_contratado' => 'Ciudad Contratado',            
        ];
    }                   
}
