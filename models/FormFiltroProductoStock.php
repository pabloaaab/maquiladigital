<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroProductoStock extends Model
{
    public $idproducto;
    public $idcliente;
    public $idtipo;

    public function rules()
    {
        return [

            ['idcliente', 'default' ],
            ['idproducto', 'default'],
            ['idtipo', 'default'],
        ];
    }

    public function attributeLabels()
    {
        return [

            'idcliente' => 'Cliente:',
            'idproducto' => 'Id Producto:',
            'idtipo' => 'Tipo:',
        ];
    }
}
