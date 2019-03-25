<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroConsultaFichatiempo extends Model
{
    public $idempleado;
    public $desde;
    public $hasta;
    public $referencia;    
    
    public function rules()
    {
        return [

            ['idempleado', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['desde', 'safe'],
            ['hasta', 'safe'],
            ['referencia', 'default'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'idempleado' => 'Empleado:',            
            'desde' => 'Desde:',
            'hasta' => 'Hasta:',
            'referencia' => 'Referencia:',
        ];
    }
}
