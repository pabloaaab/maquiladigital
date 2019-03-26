<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroConsultaSeguimientoproduccion extends Model
{
    public $idcliente;
    public $desde;
    public $hasta;
    public $idorden;
    public $codigoproducto;
    public $ordenproduccionint;
    
    public function rules()
    {
        return [

            ['idcliente', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['desde', 'safe'],
            ['hasta', 'safe'],
            ['idorden', 'default'],
            ['codigoproducto', 'default'],
            ['ordenproduccionint', 'default'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'idcliente' => 'Empleado:',            
            'desde' => 'Desde:',
            'hasta' => 'Hasta:',
            'idorden' => 'Id orden:',
            'codigoproducto' => 'Cod Prod:',
            'ordenproduccionint' => 'Orden Prod Int:',
        ];
    }
}
