<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormCredito extends Model
{        
   
    public $id_credito;
    public $id_empleado;
    public  $codigo_credito;
    public $id_tipo_pago;
    public $vlr_credito;
    public $vlr_cuota;
    public $numero_cuotas;
    public $validar_cuotas;
    public $fecha_inicio;
    public $numero_cuota_actual;
    public $aplicar_prima;
    public $vlr_aplicar;
    public $fecha_creacion;
    public $seguro;
    public $numero_libranza;
    public $observacion;
    public $estado_periodo;
    public $saldo_credito;
    public $id_grupo_pago;







    public function rules()
    {
        return [            
           [['id_empleado', 'codigo_credito', 'id_tipo_pago', 'vlr_credito', 'vlr_cuota', 'numero_cuotas', 'validar_cuotas', 'fecha_inicio'], 'required'],
            [['id_empleado', 'codigo_credito', 'id_tipo_pago', 'numero_cuotas', 'numero_cuota_actual', 'validar_cuotas', 'aplicar_prima', 'vlr_aplicar','seguro','numero_libranza'], 'integer'],
            [['vlr_credito', 'vlr_cuota', 'seguro'], 'number'],
            [['fecha_creacion', 'fecha_inicio'], 'safe'],
            [['numero_libranza'], 'string', 'max' => 15],
            [['observacion'], 'string', 'max' => 100],
            
        
        ];
    }

    public function attributeLabels()
    {
        return [   
            'id_credito' => 'Id',
            'id_empleado' => 'Empleado:',
            'codigo_credito' => 'Tipo crédito:',
            'id_tipo_pago' => 'Tipo pago:',
            'vlr_credito' => 'Vlr credito:',
            'vlr_cuota' => 'Vlr cuota:',
            'numero_cuotas' => 'Numero cuotas:',
            'numero_cuota_actual' => 'Número cuota actual:',
            'validar_cuotas' => 'Validar cuota:',
            'fecha_inicio' => 'Fecha inicio:',
            'seguro' => 'Seguro:',
            'numero_libranza' => 'Nro Libranza:',
            'aplicar_prima' => 'Aplicar prima',
            'vlr_aplicar' => 'Valor:',
            'observacion' => 'Observacion',
        ];
    }
    
}
