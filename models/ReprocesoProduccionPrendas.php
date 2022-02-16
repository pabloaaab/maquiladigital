<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reproceso_produccion_prendas".
 *
 * @property int $id_reproceso
 * @property int $id_detalle
 * @property int $id_proceso
 * @property int $id_balanceo
 * @property int $id_operario
 * @property int $cantidad
 * @property int $idproductodetalle
 * @property string $fecha_registro
 * @property string $observacion
 * @property string $usuariosistema
 *
 * @property BalanceoDetalle $detalle
 * @property ProcesoProduccion $proceso
 * @property Balanceo $balanceo
 * @property Operarios $operario
 * @property Productodetalle $productodetalle
 */
class ReprocesoProduccionPrendas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reproceso_produccion_prendas';
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
            [['id_detalle', 'id_proceso', 'id_balanceo', 'id_operario', 'cantidad', 'idproductodetalle', 'fecha_registro','idordenproduccion'], 'required'],
            [['id_detalle', 'id_proceso', 'id_balanceo', 'id_operario', 'cantidad', 'idproductodetalle','idordenproduccion','tipo_reproceso'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['observacion'], 'string', 'max' => 50],
            [['usuariosistema'], 'string', 'max' => 20],
            [['id_detalle'], 'exist', 'skipOnError' => true, 'targetClass' => BalanceoDetalle::className(), 'targetAttribute' => ['id_detalle' => 'id_detalle']],
            [['id_proceso'], 'exist', 'skipOnError' => true, 'targetClass' => ProcesoProduccion::className(), 'targetAttribute' => ['id_proceso' => 'idproceso']],
            [['id_balanceo'], 'exist', 'skipOnError' => true, 'targetClass' => Balanceo::className(), 'targetAttribute' => ['id_balanceo' => 'id_balanceo']],
            [['id_operario'], 'exist', 'skipOnError' => true, 'targetClass' => Operarios::className(), 'targetAttribute' => ['id_operario' => 'id_operario']],
            [['idproductodetalle'], 'exist', 'skipOnError' => true, 'targetClass' => Productodetalle::className(), 'targetAttribute' => ['idproductodetalle' => 'idproductodetalle']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_reproceso' => 'Id Reproceso',
            'id_detalle' => 'Id Detalle',
            'id_proceso' => 'Id Proceso',
            'id_balanceo' => 'Id Balanceo',
            'id_operario' => 'Id Operario',
            'cantidad' => 'Cantidad',
            'idproductodetalle' => 'Idproductodetalle',
            'fecha_registro' => 'Fecha Registro',
            'observacion' => 'Observacion',
            'usuariosistema' => 'Usuariosistema',
            'idordenproduccion' => 'idordenproduccion',
            'tipo_reproceso' => 'Tipo reproceso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalle()
    {
        return $this->hasOne(BalanceoDetalle::className(), ['id_detalle' => 'id_detalle']);
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
    public function getBalanceo()
    {
        return $this->hasOne(Balanceo::className(), ['id_balanceo' => 'id_balanceo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperario()
    {
        return $this->hasOne(Operarios::className(), ['id_operario' => 'id_operario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductodetalle()
    {
        return $this->hasOne(Productodetalle::className(), ['idproductodetalle' => 'idproductodetalle']);
    }
    public function getOrdenproduccion()
    {
        return $this->hasOne(Ordenproduccion::className(), ['idordenproduccion' => 'idordenproduccion']);
    }
}
