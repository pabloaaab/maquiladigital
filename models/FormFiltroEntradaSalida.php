<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroEntradaSalida extends Model
{
    public $idordenproduccion;
    public $idcliente;
    public $fecha_desde;
    public $fecha_hasta;
    public $tipo_proceso;
    public $codigo_producto;
    public $id_entrada_tipo;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idordenproduccion', 'idcliente','tipo_proceso','id_entrada_tipo'], 'integer'],
          [['fecha_desde','fecha_hasta'], 'safe'],
          [['codigo_producto'], 'string', 'max' => 20],  
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idordenproduccion' => 'Orden producción:',
            'fecha_desde' => 'Fecha inicio:',
            'idcliente' => 'Cliente:',
            'fecha_hasta' =>  'Fecha corte:', 
            'tipo_proceso' => 'Tipo proceso:',
            'codigo_producto' => 'Codigo producto:',
            'id_entrada_tipo' => 'Tipo entrada:'
        ];
    }
     
    
}
