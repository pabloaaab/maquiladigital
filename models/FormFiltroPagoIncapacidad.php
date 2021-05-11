<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroPagoIncapacidad extends Model
{        
   
    public $id_entidad_salud;
    public $fecha_desde;
    public $fecha_hasta;
    public $nro_pago;
    
    
    public function rules()
    {
        return [            
           [['id_entidad_salud', 'nro_pago'], 'integer'],
            [['fecha_desde','fecha_hasta'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [   
            'id_entidad_salud' => 'Administradora:',
            'fecha_desde' => 'Fecha inicio:',
            'Nro_pago'=>'Nr. Pago:',
            'fecha_hasta' => 'Fecha hasta',
       
        ];
    }
    
}
