<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "remision".
 *
 * @property int $id_remision
 * @property int $idordenproduccion
 * @property int $numero
 * @property int $total_tulas
 * @property double $total_exportacion
 * @property double $totalsegundas
 * @property double $total_colombia
 * @property double $total_confeccion
 * @property double $total_despachadas
 * @property string $fechacreacion
 *
 * @property Ordenproduccion $ordenproduccion
 * @property Remisiondetalle[] $remisiondetalles
 */
class Remision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'remision';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idordenproduccion', 'numero', 'total_tulas'], 'integer'],
            [['total_exportacion', 'totalsegundas', 'total_colombia', 'total_confeccion', 'total_despachadas'], 'number'],
            [['fechacreacion'], 'safe'],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_remision' => 'Id',
            'idordenproduccion' => 'Id Orden Produccion',
            'numero' => 'Numero',
            'total_tulas' => 'Total Tulas',
            'total_exportacion' => 'Total Exportacion',
            'totalsegundas' => 'Total Segundas',
            'total_colombia' => 'Total Colombia',
            'total_confeccion' => 'Total Confeccion',
            'total_despachadas' => 'Total Despachadas',
            'fechacreacion' => 'Fecha',
        ];
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
    public function getRemisiondetalles()
    {
        return $this->hasMany(Remisiondetalle::className(), ['id_remision' => 'id_remision']);
    }
}
