<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormPrendasTerminadas extends Model
{        
   
    public $id_entrada;
    public $id_balanceo;
    public  $idordenproduccion;
    public $iddetalleorden;
    public $cantidad_terminada;
    public $fecha_entrada;
    public $fecha_procesada;
    public $usuariosistema;
    public $observacion;
    
    public function rules()
    {
        return [            
           [['cantidad_terminada'], 'required', 'message' => 'Campo requerido'],
            [['cantidad_terminada'], 'integer'],
            [['observacion'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [   
            'cantidad_terminada' => 'Nro prendas:',
            'fecha_entrada' => 'Fecha_entrada:',
            'observacion' => 'Observacion:',
            
        ];
    }
    
}
