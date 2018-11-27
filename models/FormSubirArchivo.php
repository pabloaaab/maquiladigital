<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Archivodir;
use yii\web\UploadedFile;


class FormSubirArchivo extends Model
{
    public $imageFile;
    public $numero;
    public $codigo;
    
    public function rules()
    {
        return [
            [['imageFile'], 'required', 'message' => 'Campo requerido'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, ],            
            ['numero', 'default'],
            ['codigo', 'default'],
            
        ];
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'Archivo:',            
            'numero' => '',
            'codigo' => '',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $this->imageFile->saveAs('Documentos/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}