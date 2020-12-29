<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormFiltroReferencias extends Model
{        
    public $codigo_producto;
    public $idproveedor;
    public $fecha_creacion;
    public $descripcion;
    public $id_bodega;


    public function rules()
    {
        return [            
            [['codigo_producto','idproveedor','id_bodega'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['descripcion'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [                        
            'codigo_producto' => 'Código producto:',                      
            'idproveedor' => 'Proveedor:',
            'fecha_creacion' => 'Fecha creación:',
            'descripcion' => 'Producto:',
            'id_bodega' => 'Bodega:',
        ];
    }
    
}
