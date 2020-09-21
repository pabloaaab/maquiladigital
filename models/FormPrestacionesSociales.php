<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Empleado;
use app\models\Contrato;

/**
 * ContactForm is the model behind the contact form.
 */
class FormPrestacionesSociales extends Model
{        
    public $id_empleado;
    public $id_contrato;
    public $id_grupo_pago;    
    public $documento;
    public $fecha_inicio_contrato;
    public $fecha_termino_contrato;
    public $observacion;
    public $usuariosistema;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empleado','id_contrato','id_grupo_pago'], 'required', 'message' => 'Campo requerido'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'id_empleado' => 'id_empleado',
            'id_contrato' => 'id_contrato',
            'id_grupo_pago' => 'id_grupo_pago',            
            'observacion' => 'Observacion',
        ];
    }
    
   
    
}
