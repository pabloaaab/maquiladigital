<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Users;

class FormAccesoConDatos extends model{

    public $documento;
    public $id_tipo_documento;
    public $nombrecompleto;
    public $telefono;
    public $celular;    
    public $idmunicipio;
    public $temperatura_final;   
    public $tiene_sintomas;
    public $observacion;
    public $sintomascovid;

    public function rules()
    {
        return [
            [['documento', 'nombrecompleto','idmunicipio','id_tipo_documento','temperatura_final','tiene_sintomas'], 'required', 'message' => 'Campo requerido'],
            ['documento', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Sólo se aceptan números'],
            ['telefono', 'integer'], 
            ['celular', 'integer'],
            ['idmunicipio', 'string'],            
            ['temperatura_final', 'string'],            
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
            'temperatura_final' => 'Temperatura Final:', 
            'tiene_sintomas' => 'Tiene Sintomas:', 
            'observacion' => 'Observación:',
            'sintomascovid' => 'Sintomas',
        ];
    }    

}