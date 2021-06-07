<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroCreditoOperarios extends Model
{
    public $id_operario;
    public $codigo_credito;
    public $desde;
    public $hasta;


    public function rules()
    {
        return [

            [['id_operario', 'codigo_credito'], 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            [['desde','hasta'], 'safe'],
           
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_operario' => 'Operario:',
            'codigo_credito' =>'Tipo crédito:',
            'desde' => 'Desde:',
            'hasta' => 'Hasta:',
        ];
    }
}