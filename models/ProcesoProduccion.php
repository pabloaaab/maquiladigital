<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proceso_produccion".
 *
 * @property int $idproceso
 * @property string $proceso
 * @property int $estado
 *
 * @property Ordenproducciondetalleproceso[] $ordenproducciondetalleprocesos
 */
class ProcesoProduccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proceso_produccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'integer'],
            [['proceso'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproceso' => 'Idproceso',
            'proceso' => 'Proceso',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenproducciondetalleprocesos()
    {
        return $this->hasMany(Ordenproducciondetalleproceso::className(), ['idproceso' => 'idproceso']);
    }
}
