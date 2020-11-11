<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormVacacion extends Model
{        
   
    public $id_vacacion;
    public $id_empleado;
    public $fecha_desde_disfrute ;
    public $fecha_hasta_disfrute;
    public $dias_disfrutados;
    public $dias_pagados;
    public $fecha_ingreso;
    public $observacion;





    public function rules()
    {
        return [            
               [['id_empleado', 'fecha_desde_disfrute', 'fecha_hasta_disfrute', 'dias_disfrutados', 'dias_pagados','fecha_ingreso'], 'required'],
               [['id_empleado', 'dias_disfrutados', 'dias_pagados'], 'integer'],
               [['fecha_ingreso', 'fecha_hasta_disfurte','fecha_desde_disfrute'], 'safe'],
               [['observacion'], 'string', 'max' => 100],
               ];
    }

    public function attributeLabels()
    {
        return [   
            'id_empleado' => 'Empleado(a):',
            'fecha_desde_disfrute' => 'Fecha inicio vacaciones:',
            'fecha_hasta_disfrute' => 'Fecha final de vacaciones:',
            'dias_disfrutados' => 'Dias disfrutados:',
            'dias_pagados' => 'Dias reconocidos en dinero:',
            'fecha_ingreso' => 'Fecha inicio labores:',
            'observacion' => 'Observacion',
        ];
    }
    
}
