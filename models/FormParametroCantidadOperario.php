<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Contrato;

/**
 * ContactForm is the model behind the contact form.
 */
class FormParametroCantidadOperario extends Model
{        
    public $tiempo_balanceo;
    public $fecha_inicio;
    public $fecha_final; 
    public $cantidad_empleados;
    public $idordenproduccion;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_inicio','fecha_final'],'safe'],
            [['tiempo_balanceo'],'number'],
            [['cantidad_empleados','idordenproduccion'],'integer'],
          
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'fecha_inicio' => 'Fecha inicio:',
            'tiempo_balanceo' => 'Sam balanceo:',
            'cantidad_empleados' => 'Nueva cantidad:',
            'idordenproduccion' => 'Orden producción:',            
        ];
    }
    
   
    
}
