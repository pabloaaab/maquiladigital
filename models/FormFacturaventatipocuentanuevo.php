<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFacturaventatipocuentanuevo extends Model
{        
    public $cuenta;
    public $tipocuenta;    
    public $base;
    public $subtotal;
    public $iva;
    public $rete_fuente;
    public $rete_iva;
    public $total;
    public $base_rete_fuente;
    
    public function rules()
    {
        return [            
            [['cuenta','tipocuenta'], 'required'],            
            [['cuenta','tipocuenta','base','subtotal','iva','rete_fuente','rete_iva','total','base_rete_fuente'], 'integer'],                                    
        ];
    }

    public function attributeLabels()
    {
        return [                        
            'cuenta' => 'Cuenta:',                      
            'tipocuenta' => 'Tipo:',
            'base' => 'Base:',
            'subtotal' => 'Subtotal:', 
            'iva' => 'Iva:', 
            'rete_fuente' => 'Rete Fte:', 
            'rete_iva' => 'Rete Iva:', 
            'total' => 'Valor Fact:', 
            'base_rete_fuente' => 'Base Rte Fte:', 
        ];
    }
    
}
