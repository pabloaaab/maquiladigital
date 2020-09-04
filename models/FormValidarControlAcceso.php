<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Users;

class FormValidarControlAcceso extends model{

    public $cedula; 
    public $tipo_personal;    
    
    public function rules()
    {
        return [
            [['cedula','tipo_personal'], 'required', 'message' => 'Campo requerido'],           
            ['cedula', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Sólo se aceptan números'],
            ['tipo_personal', 'default'],            
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'cedula' => 'N° Identificación:',
            'tipo_personal' => 'Tipo Personal',            
        ];
    }

}