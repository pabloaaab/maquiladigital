<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Contrato;

/**
 * ContactForm is the model behind the contact form.
 */
class FormBuscarOperacionesOperario extends Model
{        
    public $id_valor;
    public $idordenproduccion;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_valor','idordenproduccion'],'integer'],
          
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [            
            'id_valor' => 'Identificador:', 
            'idordenproduccion' => 'Orden produccion:'
        ];
    }
    
   
    
}
