<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroProcesosOperaciones extends Model
{
    public $id;
    public $proceso;   
    public $id_tipo;


    public function rules()
    {
        return [

            ['id', 'default' ],
            ['proceso', 'default'], 
            ['id_tipo', 'default'],
        ];
    }

    public function attributeLabels()
    {
        return [

            'id' => 'Id:',
            'proceso' => 'Proceso:',    
            'id_tipo' => 'Tipo Maquina:',
        ];
    }
}
