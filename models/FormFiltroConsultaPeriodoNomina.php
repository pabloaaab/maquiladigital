<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroConsultaPeriodoNomina extends Model
{
    public $id_grupo_pago;
    public $id_periodo_pago;
    public  $estadoperiodo;
        
    public function rules()
    {
        return [

            [['id_grupo_pago', 'id_periodo_pago'], 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
              ['estadoperiodo', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_grupo_pago' => 'Grupo:',
            'id_periodo_pago' => 'Periodo:',
             'estadoperiodo' => 'Periodo cerrado:',
        ];
    }
}
