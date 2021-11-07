<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cantidad_prenda_terminadas_preparacion".
 *
 * @property int $id_entrada
 * @property int $id_balanceo
 * @property int $idordenproduccion
 * @property int $iddetalleorden
 * @property int $id_proceso_confeccion
 * @property int $id_operario
 * @property int $cantidad_terminada
 * @property int $nro_operarios
 * @property int $id_proceso
 * @property string $fecha_entrada
 * @property string $fecha_procesada
 * @property string $usuariosistema
 * @property string $observacion
 *
 * @property Balanceo $balanceo
 * @property Ordenproduccion $ordenproduccion
 * @property Ordenproducciondetalle $detalleorden
 * @property ProcesoConfeccionPrenda $procesoConfeccion
 * @property ProcesoProduccion $proceso
 * @property Operarios $operario
 */
class CantidadPrendaTerminadasPreparacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cantidad_prenda_terminadas_preparacion';
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
            [['id_entrada', 'id_proceso_confeccion', 'cantidad_terminada'], 'required'],
            [['id_entrada', 'id_balanceo', 'idordenproduccion', 'iddetalleorden', 'id_proceso_confeccion', 'id_operario', 'cantidad_terminada', 'nro_operarios', 'id_proceso','total_operaciones'], 'integer'],
            [['fecha_entrada', 'fecha_procesada'], 'safe'],
            [['usuariosistema'], 'string', 'max' => 20],
            [['observacion'], 'string', 'max' => 50],
            [['id_entrada'], 'unique'],
            [['id_balanceo'], 'exist', 'skipOnError' => true, 'targetClass' => Balanceo::className(), 'targetAttribute' => ['id_balanceo' => 'id_balanceo']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
            [['iddetalleorden'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproducciondetalle::className(), 'targetAttribute' => ['iddetalleorden' => 'iddetalleorden']],
            [['id_proceso_confeccion'], 'exist', 'skipOnError' => true, 'targetClass' => ProcesoConfeccionPrenda::className(), 'targetAttribute' => ['id_proceso_confeccion' => 'id_proceso_confeccion']],
            [['id_proceso'], 'exist', 'skipOnError' => true, 'targetClass' => ProcesoProduccion::className(), 'targetAttribute' => ['id_proceso' => 'idproceso']],
            [['id_operario'], 'exist', 'skipOnError' => true, 'targetClass' => Operarios::className(), 'targetAttribute' => ['id_operario' => 'id_operario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_entrada' => 'Id Entrada',
            'id_balanceo' => 'Id Balanceo',
            'idordenproduccion' => 'Idordenproduccion',
            'iddetalleorden' => 'Iddetalleorden',
            'id_proceso_confeccion' => 'Id Proceso Confeccion',
            'id_operario' => 'Id Operario',
            'cantidad_terminada' => 'Cantidad Terminada',
            'nro_operarios' => 'Nro Operarios',
            'id_proceso' => 'Id Proceso',
            'fecha_entrada' => 'Fecha Entrada',
            'fecha_procesada' => 'Fecha Procesada',
            'usuariosistema' => 'Usuariosistema',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBalanceo()
    {
        return $this->hasOne(Balanceo::className(), ['id_balanceo' => 'id_balanceo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproduccion()
    {
        return $this->hasOne(Ordenproduccion::className(), ['idordenproduccion' => 'idordenproduccion']);
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
    public function getProcesoConfeccion()
    {
        return $this->hasOne(ProcesoConfeccionPrenda::className(), ['id_proceso_confeccion' => 'id_proceso_confeccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProceso()
    {
        return $this->hasOne(ProcesoProduccion::className(), ['idproceso' => 'id_proceso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperario()
    {
        return $this->hasOne(Operarios::className(), ['id_operario' => 'id_operario']);
    }
}
