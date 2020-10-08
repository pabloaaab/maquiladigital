<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "balanceo".
 *
 * @property int $id_balanceo
 * @property int $idordenproduccion
 * @property int $cantidad_empleados
 * @property string $fecha_creacion
 * @property string $fecha_inicio
 * @property string $usuariosistema
 *
 * @property Ordenproduccion $ordenproduccion
 */
class Balanceo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'balanceo';
    }
 public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->observacion = strtolower($this->observacion); 
        $this->observacion = ucfirst($this->observacion);  
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_inicio'], 'required'],
            [['idordenproduccion', 'cantidad_empleados','idcliente','modulo'], 'integer'],
            [['fecha_inicio'], 'safe'],
            [['total_minutos','total_segundos','tiempo_operario','porcentaje'],'number'],
            [['observacion'],'string', 'max' => 150],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_balanceo' => 'Id Balanceo',
            'idordenproduccion' => 'Orden producción:',
            'cantidad_empleados' => 'Cantidad Empleados:',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_inicio' => 'Fecha Inicio:',
            'observacion' => 'Observacion:',
            'usuariosistema' => 'Usuariosistema',
            'idcliente' => 'Cliente',
            'modulo' => 'Nro modulo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproduccion()
    {
        return $this->hasOne(Ordenproduccion::className(), ['idordenproduccion' => 'idordenproduccion']);
    }
    
     public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['idcliente' => 'idcliente']);
    }
    
    public function getEstadomodulo() {
        if($this->estado_modulo == '0'){
            $estadomodulo = 'ABIERTO';
        }else{
            $estadomodulo = 'CERRADO';
        }
        
        return $estadomodulo;
    }
}
