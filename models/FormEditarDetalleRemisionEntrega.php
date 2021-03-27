<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class   FormEditarDetalleRemisionEntrega extends Model
{        
    public $id_remision;
    public $id_detalle;
    public $cantidad;
    public $valor_unitario;
    public $porcentaje_descuento;
    public $total_linea;
    public $t2, $t4, $t6, $t8, $t10, $t12, $t14, $t16, $t18, $t20, $t22, $t24, $t26, $t28, $t30, $t32, $t34;
    public $t36, $t38, $t40, $t42, $t44, $xs, $s, $m, $l, $xl, $xxl, $t_unica; 



    public function rules()
    {
        return [  
            [['cantidad','valor_unitario'], 'required'],
            [['cantidad', 'valor_unitario','t2','t4','t6','t8','t10','t12','t14','t16','t18','t20','t22','t24','t26','t28','t30','t32','t34','t36','t38','t40','t42','t44',
                'xs','s','m','l','xl','xxl','t_unica'], 'integer'],
            [['porcentaje_descuento'],'number'],
        ];
    }

    public function attributeLabels()
    {
        return [   
            'cantidad' => 'Cantidad:',
            'valor_unitario' => 'Vr. Unitario:',
            'porcentaje_descuento' => '% Descuento:',
            'total_linea' => 'Total pagar:',
            'id_detalle' => 'Id detalle:',
            't2' => 'Talla 2:', 't4' => 'Talla 4:','t6' => 'Talla 6:','t8' => 'Talla 8:','t10' => 'Talla 10:','t12' => 'Talla 12:','t14' => 'Talla 14:','t16' => 'Talla 16:',
            't18' => 'Talla 18:','t20' => 'Talla 20:','t22' => 'Talla 22:','t24' => 'Talla 24:','t26' => 'Talla 26:','t28' => 'Talla 28:','t30' => 'Talla 30:','t32' => 'Talla 32:',
            't34' => 'Talla 34:','t36' => 'Talla 36:','t38' => 'Talla 38:','t40' => 'Talla 40:','t42' => 'Talla 42:','t44' => 'Talla 44:','xs' => 'Talla xs:','s' => 'Talla s:',
            'm' => 'Talla m:','l' => 'Talla l:','xl' => 'Talla xl:','xxl' => 'Talla xxl:','t_unica' => 'T unica:',
      
        ];
    }
    
}
