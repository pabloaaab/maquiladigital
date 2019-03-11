<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormComprobanteegresonuevodetallelibre extends Model
{    
    public $vlr_abono;        
    
    public function rules()
    {
        return [            
            [['vlr_abono'], 'required'],            
            [['vlr_abono'], 'number'],                       
        ];
    }

    public function attributeLabels()
    {
        return [                        
            'vlr_abono' => 'Valor Pago:',            
        ];
    }
    
}
