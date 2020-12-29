<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroRemisionEntrega extends Model
{        
    public $idcliente;
    public $fecha_entrega;
    

    public function rules()
    {
        return [            
            [['idcliente'], 'integer'],
            [['fecha_entrega'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [                        
            'idcliente' => 'Cliente:',                      
            'fecha_entrega' => 'Fecha entrega:',
        ];
    }
    
}
