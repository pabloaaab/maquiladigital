<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormProgramacionNominaDetalle extends Model
{        
    public $id_programacion;
    public $codigo_salario;
    public $horas_periodo;
    public $horas_periodo_real;
    public $dias;
    public $dias_reales;
    public $dias_transporte;
    public $factor_dia;
    public $fecha_desde;
    public $fecha_hasta;
    public $salario_basico;
    public $vlr_deduccion;
    public $vlr_credito;
    public $vlr_hora;
    public $vlr_dia;
    public $vlr_neto_pagar;
    public $descuento_salud;
    public $descuento_pension;
    public $auxilio_transporte;
    public $vlr_licencia;
    public $nro_horas;
    public $vlr_incapacidad;
    public $vlr_pagar;
    public $deduccion;
    
    
    public function rules()
    {
        return [            
            
        ];
    }

    public function attributeLabels()
    {
        return [                        
            
        ];
    }
    
}
