<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormPrestamoOperario extends Model
{        
   
    public $id_credito;
    public $id_operario;
    public  $codigo_credito;
    public $vlr_credito;
    public $vlr_cuota;
    public $numero_cuotas;
    public $validar_cuotas;
    public $fecha_inicio;
    public $numero_cuota_actual;
    public $fecha_creacion;
    public $observacion;
    public $saldo_credito;  

    public function rules()
    {
        return [            
           [['id_operario', 'codigo_credito', 'vlr_credito', 'vlr_cuota', 'numero_cuotas', 'validar_cuotas', 'fecha_inicio'], 'required'],
            [['id_operario', 'codigo_credito', 'numero_cuotas', 'numero_cuota_actual', 'validar_cuotas'], 'integer'],
            [['vlr_credito', 'vlr_cuota'], 'number'],
            [['fecha_creacion', 'fecha_inicio'], 'safe'],
            [['observacion'], 'string', 'max' => 100],
            
        
        ];
    }

    public function attributeLabels()
    {
        return [   
            'id_credito' => 'Id',
            'id_operario' => 'Operario:',
            'codigo_credito' => 'Tipo crédito:',
            'vlr_credito' => 'Vlr credito:',
            'vlr_cuota' => 'Vlr cuota:',
            'numero_cuotas' => 'Numero cuotas:',
            'numero_cuota_actual' => 'Número cuota actual:',
            'validar_cuotas' => 'Validar cuota:',
            'fecha_inicio' => 'Fecha inicio:',
            'observacion' => 'Observacion:',
        ];
    }
    
}
