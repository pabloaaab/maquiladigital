<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Operarios;
use app\models\Departamentos;
use app\models\Municipio;

/**
 * ContactForm is the model behind the contact form.
 */
class FormOperarios extends Model
{
    
    public $id_operario;
    public $documento;
    public $id_tipo_documento;
    public $nombres;
    public $apellidos;
    public $iddepartamento;
    public $nombrecompleto;
    public $idmunicipio;
    public $celular;
    public $email;
    public $estado;
    public $polivalente;
    public $vinculado;
    public $tipo_operaria;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['documento', 'nombres','apellidos','id_tipo_documento','iddepartamento','idmunicipio'], 'required', 'message' => 'Campo requerido'],
            ['documento', 'identificacion_existe'],
            ['email', 'email_existe'],
            [['documento', 'estado', 'id_tipo_documento','polivalente','vinculado','tipo_operaria'], 'integer'],
            ['documento', 'match', 'pattern' => '/^[0-9\s]+$/i', 'message' => 'Sólo se aceptan números'],
            [['nombres', 'apellidos'], 'string', 'max' => 40],
            [['iddepartamento', 'idmunicipio','celular'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 60],
            [['id_tipo_documento'], 'exist', 'skipOnError' => true, 'targetClass' => TipoDocumento::className(), 'targetAttribute' => ['id_tipo_documento' => 'id_tipo_documento']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_operario' => 'Id:',
            'documento' => 'Documento:',
            'id_tipo_documento' => 'Tipo Documento:',
            'nombres' => 'Nombres:',
            'apellidos' => 'Apellidos:',
            'celular' => 'Celular:',
            'email' => 'Email:',
            'estado' => 'Activo:',
            'vinculado' =>'Vinculado:',
            'tipo_operaria' => 'Tipo operaria:',
            'polivalente' => 'Polivalente:',
            'idmunicipio' => 'Municipio:',
            'iddepartamento' => 'Departamento:',
            
        ];
    }

    
    
    public function identificacion_existe($attribute, $params)
    {
        //Buscar la identificacion en la tabla
        $table = Operarios::find()->where("documento=:documento", [":documento" => $this->documento])->andWhere("iddepartamento!=:iddepartamento", [':iddepartamento' => $this->iddepartamento]);
        //Si la identificacion no existe en inscritos mostrar el error
        if ($table->count() > 0)
        {
            $this->addError($attribute, "El numero de identificacion ya existe");
        }
    }  

    public function email_existe($attribute, $params)
    {
        //Buscar el email en la tabla
        $table = Operarios::find()->where("email=:email", [":email" => $this->email])->andWhere("documento!=:documento", [':documento' => $this->documento]);
        //Si el email existe mostrar el error
        if ($table->count() > 0)
        {
            $this->addError($attribute, "El email ya existe");
        }
    }
    
    
}
