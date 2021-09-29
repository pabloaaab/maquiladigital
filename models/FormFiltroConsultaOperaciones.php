<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroConsultaOperaciones extends Model
{
    public $idproceso;
    public $idordenproduccion;
    public $id_tipo;
   
    
    public function rules()
    {
        return [

            ['idproceso', 'default' ],
            ['idordenproduccion', 'default'],
            ['id_tipo', 'default'],
         
        
        ];
    }

    public function attributeLabels()
    {
        return [

            'idproceso' => 'Operaciones:',
            'idordenproduccion' => 'Orden de Producción:',
            'id_tipo' => 'Maquina:',
           
        ];
    }
}
