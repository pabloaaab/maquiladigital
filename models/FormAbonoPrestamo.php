<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormAbonoPrestamo extends Model
{        
   
    public $id_credito;
    public $observacion;
    public $vlr_abono;
    public $saldo_credito;
    public $fecha_creacion;

    public function rules()
    {
        return [  
           [['vlr_abono'], 'required'] ,
           [['id_credito'], 'integer'],
           [['vlr_abono'],'number'],
            [['fecha_creacion'], 'safe'],
           [['observacion'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [   
            'id_credito' => 'id_credito:',
            'observacion' => 'Observación:',
            'vlr_abono'=>'Abono crédito:',
            'saldo_credito' =>'saldo_credito'
       
        ];
    }
    
}
