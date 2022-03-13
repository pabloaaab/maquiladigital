<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "piloto_detalle_produccion".
 *
 * @property int $id_proceso
 * @property int $iddetalleorden
 * @property int $idordenproduccion
 * @property string $concepto
 * @property double $medida_ficha_tecnica
 * @property int $medida_confeccion
 * @property double $tolerancia
 * @property string $fecha_registro
 * @property string $usuariosistema
 *
 * @property Ordenproducciondetalle $detalleorden
 * @property Ordenproduccion $ordenproduccion
 */
class PilotoDetalleProduccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'piloto_detalle_produccion';
    }

     public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->observacion = strtoupper($this->observacion); 
         $this->concepto = strtoupper($this->concepto); 
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddetalleorden', 'idordenproduccion','aplicado'], 'integer'],
            [['medida_ficha_tecnica', 'tolerancia','medida_confeccion'], 'number'],
            [['fecha_registro'], 'safe'],
            [['concepto'], 'string', 'max' => 40],
            [['observacion'], 'string', 'max' => 35],
            [['usuariosistema'], 'string', 'max' => 20],
            [['iddetalleorden'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproducciondetalle::className(), 'targetAttribute' => ['iddetalleorden' => 'iddetalleorden']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_proceso' => 'Id Proceso',
            'iddetalleorden' => 'Iddetalleorden',
            'idordenproduccion' => 'Idordenproduccion',
            'concepto' => 'Concepto',
            'medida_ficha_tecnica' => 'Medida Ficha Tecnica',
            'medida_confeccion' => 'Medida Confeccion',
            'tolerancia' => 'Tolerancia',
            'fecha_registro' => 'Fecha Registro',
            'usuariosistema' => 'Usuariosistema',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleorden()
    {
        return $this->hasOne(Ordenproducciondetalle::className(), ['iddetalleorden' => 'iddetalleorden']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproduccion()
    {
        return $this->hasOne(Ordenproduccion::className(), ['idordenproduccion' => 'idordenproduccion']);
    }
    public function getAplicadoproceso() {
        if($this->aplicado == 0){
           $aplicado = 'NO';
        }else{
           $aplicado = 'SI';
        }
        return $aplicado;
    }
    
}
