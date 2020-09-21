<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormPagoAdicionalFecha extends Model
{        
    public $id_pago_fecha;
    public $fecha_corte;
    public $detalle;            
    public $estado_proceso;    

    public function rules()
    {
        return [            
            [['fecha_corte'], 'required'],
            [['fecha_corte'], 'safe'],
            [['estado_proceso'], 'integer'],
            [['detalle'],'string', 'max'=>50],
        ];
    }

    public function attributeLabels()
    {
        return [                                                       
            'id_pago_fecha' => 'id_pago_fecha',
            'fecha_corte' => 'fecha_corte:',
            'detalle'=>'Detalle:',    
            'estado_proceso'=>'estado_proceso',
            
            
            
        ];
    }
    
}
