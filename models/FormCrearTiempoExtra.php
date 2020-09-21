<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormCrearTiempoExtra extends Model
{        
    public $codigo_salario;
    public $vlr_hora;
    public $nro_horas;    
    public $id_periodo_pago_nomina;
    public $nombre_concepto;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_salario','nro_horas'], 'required', 'message' => 'Campo requerido'],
            [['nro_horas'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'codigo_salario' => 'Código',
            'nro_horas' => 'Nro_Horas',
        ];
    }
   
}
