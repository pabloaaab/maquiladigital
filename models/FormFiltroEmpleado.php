<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroEmpleado extends Model
{
    public $id_empleado;
    public $identificacion;
    public $fechaingreso;
    public $contrato;
    public $fecharetiro;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empleado', 'identificacion','contrato'], 'integer'],
            [['fechaingreso','fecharetiro'],'safe'],
            ['identificacion', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_empleado' => 'Empleado:',
            'identificacion' => 'Documento:',
            'contrato' => 'Activo:',
            'fechaingreso' => 'Desde:',
            'fecharetiro' => 'Hasta:'
            
        ];
    }
     
    
}
