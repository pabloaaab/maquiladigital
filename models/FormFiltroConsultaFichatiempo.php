<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroConsultaFichatiempo extends Model
{
    public $id_operario;
    public $desde;
    public $hasta;
    public $referencia;    
    
    public function rules()
    {
        return [

            ['id_operario', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['desde', 'safe'],
            ['hasta', 'safe'],
            ['referencia', 'default'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_operario' =>'Operario:',            
            'desde' => 'Desde:',
            'hasta' => 'Hasta:',
            'referencia' => 'Referencia:',
        ];
    }
}
