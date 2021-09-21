<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormEficienciaFecha extends Model
{        
    public $id_balanceo;
    public $fecha_entrada;
    public $fecha_inicio;
    public $fecha_terminacion;
    public $orden_produccion;


    public function rules()
    {
        return [  
           
        ];
    }

    public function attributeLabels()
    {
        return [   
            'id_balanceo' => 'Nro Balanceo:',
            'fecha_entrada' => 'Fecha entrada:',
            'fecha_inicio' => 'Fecha Inicio:',
            'fecha_terminacion' => 'Fecha terminacion:',
            'orden_produccion' => 'Op_Cliente:',
     
        ];
    }
    
    
}
