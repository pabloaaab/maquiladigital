<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroComprobantePagoPrestacion extends Model
{
    public $id_grupo_pago;
    public $id_empleado;
    public $documento;
    public $fecha_inicio_contrato;
    public $fecha_termino_contrato;
            


    public function rules()
    {
        return [

            [['id_grupo_pago', 'id_empleado','documento'], 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            [['fecha_termino_contrato','fecha_inicio_contrato'],'safe'],
           
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_grupo_pago' => 'Grupo:',
            'id_empleado' =>'Empleado:', 
            'documento' =>'Documento:',
            'fecha_inicio_contrato' => 'Desde:',
            'fecha_termino_contrato' => 'Hasta:',
           
        ];
    }
}