<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroOrdenTercero extends Model
{
    public $idproveedor;
    public $idcliente;
    public $fecha_inicio;
    public $fecha_corte;
    public $idtipo;
    public $id_orden_tercero;
    public $idordenproduccion;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproveedor', 'idcliente','idtipo','id_orden_tercero','idordenproduccion'], 'integer'],
          [['fecha_inicio','fecha_corte'], 'safe'],
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
            'idcliente' => 'Cliente:',
            'idproveedor' => 'Proveedor:',
             'idtipo' => 'Tipo proceso:',
            'fecha_corte' =>  'Fecha corte:', 
        ];
    }
     
    
}
