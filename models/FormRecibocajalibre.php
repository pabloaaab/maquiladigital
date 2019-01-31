<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormRecibocajalibre extends Model
{    
    public $nitcedula;
    public $fechapago;
    public $clienterazonsocial;
    public $idtiporecibo;
    public $idmunicipio;
    public $observacion;
    public $telefono;
    public $direccion;
    
    public function rules()
    {
        return [            
            [['idtiporecibo', 'idmunicipio','fechapago','nitcedula','clienterazonsocial'], 'required'],            
            [['observacion','direccion','clienterazonsocial'], 'string'],
            [['telefono','nitcedula'], 'integer'],
            [['idtiporecibo','idmunicipio'], 'string', 'max' => 15],            
        ];
    }

    public function attributeLabels()
    {
        return [                        
            'fechapago' => 'Fecha Pago',
            'idtiporecibo' => 'Tipo Recibo',
            'idmunicipio' => 'Municipio',            
            'clienterazonsocial' => 'Cliente',
            'nitcedula' => 'Nit/Cedula',            
            'observacion' => 'Observacion',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
        ];
    }
    
}
