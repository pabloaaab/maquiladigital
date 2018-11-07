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
 *
 * @property Ordenproducciondetalle[] $ordenproducciondetalles
 * @property ProcesoProduccion $proceso0
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
            [['duracion', 'ponderacion', 'total', 'idproceso', 'estado'], 'integer'],
            [['idproceso'], 'required'],
            [['proceso'], 'string', 'max' => 50],
            [['idproceso'], 'exist', 'skipOnError' => true, 'targetClass' => ProcesoProduccion::className(), 'targetAttribute' => ['idproceso' => 'idproceso']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproducciondetalles()
    {
        return $this->hasMany(Ordenproducciondetalle::className(), ['iddetalleproceso' => 'iddetalleproceso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProceso0()
    {
        return $this->hasOne(ProcesoProduccion::className(), ['idproceso' => 'idproceso']);
    }
}
