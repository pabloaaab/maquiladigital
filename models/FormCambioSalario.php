<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormCambioSalario extends Model
{        
    public $id_formato_contenido;
    public $id_contrato;
    public $nuevo_salario;
    public $fecha_aplicacion;
    public $observacion;

    public function rules()
    {
        return [  
           [['nuevo_salario','fecha_aplicacion'], 'required'] ,
           [['nuevo_salario', 'id_formato_contenido'], 'integer'],
            [['fecha_aplicacion'], 'safe'],
           [['observacion'], 'string', 'max' => 40],
        ];
    }

    public function attributeLabels()
    {
        return [   
            'nuevo_salario' => 'Nuevo salario:',
            'observacion' => 'Observación:',
            'fecha_aplicacion'=>'Fecha aplicación:',
            'id_formato_contenido' => 'Tipo formato:',
      
        ];
    }
    
}
