<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormPagoIncapacidad extends Model
{        
   
    public  $id_entidad_salud;
    public $fecha_pago_entidad;
    public $idbanco;
    public $observacion;

    public function rules()
    {
        return [            
           [['id_entidad_salud', 'idbanco', 'fecha_pago_entidad'], 'required'],
           [['id_entidad_salud','idbanco'], 'integer'],
            [['fecha_pago_entidad'], 'safe'],
            [['observacion'], 'string', 'max' => 100],
        
        ];
    }

    public function attributeLabels()
    {
        return [   
            'id_entidad_salud' => 'Administradora:',
            'idbanco' => 'Forma de Pago:',
            'fecha_pago_entidad' => 'Fecha pago:',
            'observacion' => 'Observacion:',
        ];
    }
    
}
