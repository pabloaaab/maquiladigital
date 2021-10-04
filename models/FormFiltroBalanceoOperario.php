<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroBalanceoOperario extends Model
{
    public $id_proceso;
    public $id_balanceo;
    public $id_tipo;
    public $id_operario;


    public function rules()
    {
        return [

            [['id_proceso', 'id_balanceo','id_tipo','id_operario'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [

            'id_proceso' => 'Operaciones:',
            'id_balanceo' => 'Nro balanceo:',
            'id_tipo' => 'Tipo Maquina:',
            'id_operario' => 'Operarios:',
        ];
    }
}
