<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormGenerarCostoProduccionDiaria extends Model
{
    public $operarias;
    public $horaslaboradas;
    public $minutoshora;
    public $idordenproduccion;

    public function rules()
    {
        return [            
            [['idordenproduccion','operarias','horaslaboradas'],'required', 'message' => 'Campo requerido para generar el informe'],
            ['operarias', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['horaslaboradas', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['minutoshora', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            ['idordenproduccion','default']
        ];
    }

    public function attributeLabels()
    {
        return [
            'operarias' => 'Nro Operarias',
            'horaslaboradas' => 'Horas Laboradas',
            'minutoshora' => 'Minutos Hora:',
            'idordenproduccion' => 'Orden Producción:',
        ];
    }
}
