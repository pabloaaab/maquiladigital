<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Users;

class FormAccesoSinDatos extends model{

    public $documento;
    public $id_tipo_documento;
    public $nombrecompleto;
    public $telefono;
    public $celular;    
    public $idmunicipio;
    public $temperatura_inicial;   
    public $tiene_sintomas;
    public $observacion;
    public $sintomascovid;

    public function rules()
    {
        return [
            [['documento', 'nombrecompleto','idmunicipio','id_tipo_documento','temperatura_inicial','tiene_sintomas'], 'required', 'message' => 'Campo requerido'],
            ['documento', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Sólo se aceptan números'],
            ['telefono', 'integer'], 
            ['celular', 'integer'],
            ['idmunicipio', 'string'],            
            ['temperatura_inicial', 'string'],            
            ['tiene_sintomas', 'integer'],            
            ['observacion', 'string'],
            ['sintomascovid', 'default']
        ];
    }

    public function attributeLabels()
    {
        return [
            'documento' => 'N° Identificación:',
            'nombrecompleto' => 'Nombre Completo:',
            'idmunicipio' => 'Municipio de Residencia:',
            'telefono' => 'Teléfono:',
            'celular' => 'Celular:', 
            'temperatura_inicial' => 'Temperatura Inicial:', 
            'tiene_sintomas' => 'Tiene Sintomas:', 
            'observacion' => 'Observación:',
            'sintomascovid' => 'Sintomas',
        ];
    }    

}