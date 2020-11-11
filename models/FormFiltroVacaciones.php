<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroVacaciones extends Model
{
    public $id_grupo_pago;
    public $id_empleado;
    public $documento;
    public $fecha_desde;
    public $fecha_hasta;
    public $estado_cerrado;
            


    public function rules()
    {
        return [

            [['id_grupo_pago', 'id_empleado','documento','estado_cerrado'], 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            [['fecha_desde','fecha_hasta'],'safe'],
           
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_grupo_pago' => 'Grupo:',
            'id_empleado' =>'Empleado:', 
            'documento' =>'Documento:',
            'fecha_desde' => 'Desde:',
            'fecha_hasta' => 'Hasta:',
            'estado_cerrado' => 'Aprobado:',
           
        ];
    }
}