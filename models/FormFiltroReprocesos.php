<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroReprocesos extends Model
{
    public $id_operario;
    public $idordenproduccion;
    public $fecha_inicio;
    public $fecha_final;
    public $id_balanceo;
    public $id_proceso;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_operario', 'id_balanceo','id_proceso','idordenproduccion'], 'integer'],
          [['fecha_inicio','fecha_final'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idordenproduccion' => 'Orden producción:',
            'fecha_inicio' => 'Fecha inicio:',
            'id_operario' => 'Operario:',
             'id_proceso' => 'Operacion:',
            'id_balanceo' => 'Nro Balanceo:',
            'fecha_corte' =>  'Fecha final:', 
        ];
    }
     
    
}
