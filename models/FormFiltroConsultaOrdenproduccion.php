<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroConsultaOrdenproduccion extends Model
{
    public $idcliente;
    public $desde;
    public $hasta;
    public $codigoproducto;
    public $facturado;
    public $tipo;
    public $ordenproduccionint;
    public $ordenproduccionext;
    
    public function rules()
    {
        return [

            ['idcliente', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['desde', 'safe'],
            ['hasta', 'safe'],
            ['codigoproducto', 'default'],
            ['facturado', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['tipo', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['ordenproduccionext', 'default'],
            ['ordenproduccionint', 'default'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'idcliente' => 'Cliente:',
            'codigoproducto' => 'Cod Producto:',
            'desde' => 'Desde:',
            'hasta' => 'Hasta:',
            'facturado' => 'Facturado:',
            'tipo' => 'Tipo:',
            'ordenproduccionint' => 'Orden Prod Int:',
            'ordenproduccionext' => 'Orden Prod Ext:',
        ];
    }
}
