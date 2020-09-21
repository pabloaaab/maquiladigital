<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormNuevaProrroga extends Model
{        
    public $id_contrato;
    public $fecha_desde;
    public $fecha_ultima_contrato;
    public $fecha_nueva_renovacion;
    public $id_formato_contenido;



    public function rules()
    {
        return [  
            [['fecha_nueva_renovacion','id_formato_contenido'], 'required'],
            [['fecha_ultima_contrato', 'fecha_desde', 'fecha_nueva_renovacion'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [   
            'fecha_desde' => 'Fecha Inicio Contrato:',
            'fecha_ultima_contrato' => 'Fecha Ultima renovación:',
            'fecha_nueva_renovacion' => 'Fecha_nueva_renovacion:',
            'id_formato_contenido' => 'Tipo formato:',
      
        ];
    }
    
}
