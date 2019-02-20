<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seguimiento_produccion".
 *
 * @property int $id_seguimiento_produccion
 * @property string $fecha_inicio_produccion
 * @property string $hora_inicio
 * @property int $idcliente
 * @property int $idordenproduccion
 * @property double $minutos 
 * @property double $horas_a_trabajar
 * @property double $operarias
 * @property double $prendas_reales
 * 
 * @property Cliente $cliente
 * @property Ordenproduccion $ordenproduccion
 * @property SeguimientoProduccionDetalle[] $seguimientoProduccionDetalles
 */
class SeguimientoProduccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguimiento_produccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_inicio_produccion', 'hora_inicio', 'idcliente', 'idordenproduccion'], 'required'],
            [['fecha_inicio_produccion', 'hora_inicio'], 'safe'],
            [['idcliente', 'idordenproduccion'], 'integer'],
            [['minutos', 'horas_a_trabajar', 'prendas_reales'], 'number'],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_seguimiento_produccion' => 'Id',
            'fecha_inicio_produccion' => 'Fecha Inicio',
            'hora_inicio' => 'Hora Inicio',
            'idcliente' => 'Cliente',
            'idordenproduccion' => 'Orden',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['idcliente' => 'idcliente']);
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
    public function getSeguimientoProduccionDetalles()
    {
        return $this->hasMany(SeguimientoProduccionDetalle::className(), ['id_seguimiento_produccion' => 'id_seguimiento_produccion']);
    }
}
