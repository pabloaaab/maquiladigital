<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormComprobanteEgresoTipoCuentaNuevo extends Model
{        
    public $cuenta;
    public $tipocuenta;    
    public $base;    
    
    public function rules()
    {
        return [            
            [['cuenta','tipocuenta'], 'required'],            
            [['cuenta','tipocuenta','base'], 'integer'],                                    
        ];
    }

    public function attributeLabels()
    {
        return [                        
            'cuenta' => 'Cuenta:',                      
            'tipocuenta' => 'Tipo:',
            'base' => 'Base:',             
        ];
    }
    
}
