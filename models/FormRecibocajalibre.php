<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormRecibocajalibre extends Model
{        
    public $fechapago;
    public $idcliente;
    public $idtiporecibo;
    public $idmunicipio;
    public $observacion;    
    
    public function rules()
    {
        return [            
            [['idtiporecibo', 'idmunicipio','fechapago','idcliente'], 'required'],            
            [['observacion'], 'string'],            
            [['idtiporecibo','idmunicipio'], 'string', 'max' => 15],            
        ];
    }

    public function attributeLabels()
    {
        return [                        
            'fechapago' => 'Fecha Pago',
            'idtiporecibo' => 'Tipo Recibo',
            'idmunicipio' => 'Municipio',            
            'idcliente' => 'Cliente',                        
            'observacion' => 'Observacion',            
        ];
    }
    
}
