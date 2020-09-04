<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroControlAcceso extends Model
{
    public $documento;
    public $tipo_personal;
    public $fecha;

    public function rules()
    {
        return [

            ['documento', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['tipo_personal', 'match', 'pattern' => '/^[0-9a-z\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['fecha','safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'documento' => 'Nro Identificación:',
            'tipo_personal' => 'Tipo Personal:',
            'fecha' => 'Fecha:',
        ];
    }
}
