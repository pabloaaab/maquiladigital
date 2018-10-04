<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroCliente extends Model
{
    public $cedulanit;
    public $nitmatricula;

    public function rules()
    {
        return [

            ['cedulanit', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan numeros'],
            ['nitmatricula', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan numeros'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cedulanit' => 'Nro Identificacion',
            'nitmatricula' => 'Cliente:',
        ];
    }
}
