<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormNuevaAdicion extends Model
{        
    public $id_pago_adicion;
    public $id_formato_contenido;
    public $vlr_adicion;
    public $fecha_aplicacion;
    public $fecha_proceso;
    public $codigo_salario;
    





    public function rules()
    {
        return [  
            [['id_formato_contenido','vlr_adicion','fecha_aplicacion','codigo_salario'], 'required'],
            [['fecha_aplicacion'], 'safe'],
            [['codigo_salario'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [   
            'id_formato_contenido' => 'Tipo formato:',
            'vlr_adicion' => 'Valor adición:',
            'fecha_aplicacion' => 'Fecha aplicación:',
            'fecha_proceso' => 'Fecha proceso:',
            'codigo_salario' => 'Concepto salario:'
      
        ];
    }
    
}
