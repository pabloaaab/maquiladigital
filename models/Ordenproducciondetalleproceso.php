<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenproducciondetalleproceso".
 *
 * @property int $iddetalleproceso
 * @property string $proceso
 * @property int $duracion
 * @property int $ponderacion
 * @property int $total
 * @property int $idproceso
 * @property int $estado
 * @property int $iddetalleorden
 * @property int $totalproceso
 * @property int $porcentajeproceso
 * @property int $cantidad_operada
 *
 * @property ProcesoProduccion $proceso0
 * @property Ordenproducciondetalle $detalleorden
 */
class Ordenproducciondetalleproceso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenproducciondetalleproceso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duracion', 'ponderacion', 'idproceso', 'estado', 'iddetalleorden','cantidad_operada'], 'integer'],
            [['total','totalproceso','porcentajeproceso'], 'number'],
            [['idproceso', 'iddetalleorden'], 'required'],
            [['proceso'], 'string', 'max' => 50],
            [['idproceso'], 'exist', 'skipOnError' => true, 'targetClass' => ProcesoProduccion::className(), 'targetAttribute' => ['idproceso' => 'idproceso']],
            [['iddetalleorden'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproducciondetalle::className(), 'targetAttribute' => ['iddetalleorden' => 'iddetalleorden']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetalleproceso' => 'Iddetalleproceso',
            'proceso' => 'Proceso',
            'duracion' => 'Duracion',
            'ponderacion' => 'Ponderacion',
            'total' => 'Total',
            'idproceso' => 'Idproceso',
            'estado' => 'Estado',
            'iddetalleorden' => 'Iddetalleorden',
            'totalproceso' => 'total Proceso',
            'porcentajeproceso' => '% Proceso',
            'cantidad_operada' => 'Cantidad Operada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProceso0()
    {
        return $this->hasOne(ProcesoProduccion::className(), ['idproceso' => 'idproceso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleorden()
    {
        return $this->hasOne(Ordenproducciondetalle::className(), ['iddetalleorden' => 'iddetalleorden']);
    }
}
