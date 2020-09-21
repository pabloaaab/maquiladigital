<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormPeriodoPagoNomina extends Model
{        
    public $id_grupo_pago;
    public $id_periodo_pago;
    public $id_tipo_nomina;
    public $fecha_desde;
    public $fecha_hasta;
    public $dias_periodo;
    
    public function rules()
    {
        return [            
            [['id_grupo_pago','id_periodo_pago','id_tipo_nomina','fecha_desde','fecha_hasta','dias_periodo'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [                        
            'id_grupo_pago' => 'Grupo Pago:',                      
            'id_periodo_pago' => 'Periodo:',
            'id_tipo_nomina' => 'Tipo Nomina:',
            'fecha_desde' => 'Fecha Desde:',
            'fecha_hasta' => 'Fecha Hasta:',
            'dias_periodo' => 'Dias Periodo:',
        ];
    }
    
}
