<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroOrdenProduccionNuevo extends Model
{
    public $idcliente;
    public $ordenproduccion;
    public $idtipo;

    public function rules()
    {
        return [

            ['idcliente', 'default' ],
            ['ordenproduccion', 'default'],
            ['idtipo', 'default'],
        ];
    }

    public function attributeLabels()
    {
        return [

            'idcliente' => 'Cliente:',
            'ordenproduccion' => 'Orden de Producción:',
            'idtipo' => 'Tipo:',
        ];
    }
}
