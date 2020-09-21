<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroPagoFecha extends Model
{
    public $id_pago_fecha;
    public $estado_proceso;


    public function rules()
    {
        return [

            [['estado_proceso'], 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
           
           
        ];
    }

    public function attributeLabels()
    {
        return [
            'estado_proceso' => 'Abiero/Cerrado:',
           
           
        ];
    }
}