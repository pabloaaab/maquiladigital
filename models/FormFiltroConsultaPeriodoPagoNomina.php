<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroConsultaPeriodoPagoNomina extends Model
{
    public $id_grupo_pago;
    public $id_periodo_pago;
    public $id_tipo_nomina;
    public $estado_periodo;
    
    public function rules()
    {
        return [

            [['id_grupo_pago', 'id_periodo_pago', 'id_tipo_nomina'], 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
           
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_grupo_pago' => 'Grupo:',
            'id_periodo_pago' => 'Periodo:',
            'id_tipo_nomina' =>'Tipo Nomina:', 
            'estado_periodo' =>'Estado periodo:',
           
        ];
    }
}