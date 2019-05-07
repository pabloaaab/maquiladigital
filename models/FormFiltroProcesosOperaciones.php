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
    
    public function rules()
    {
        return [

            ['id', 'default' ],
            ['proceso', 'default'],            
        ];
    }

    public function attributeLabels()
    {
        return [

            'id' => 'Id:',
            'proceso' => 'Proceso:',            
        ];
    }
}
