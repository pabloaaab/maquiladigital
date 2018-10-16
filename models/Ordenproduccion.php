<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenproduccion".
 *
 * @property int $idordenproduccion
 * @property int $idcliente
 * @property string $fechallegada
 * @property string $fechaprocesada
 * @property string $fechaentrega
 * @property string $totalorden
 * @property string $valorletras
 * @property string $observacion
 * @property string $estado
 * @property string $usuariosistema
 *
 * @property Facturaventa[] $facturaventas
 * @property Cliente $cliente
 * @property Ordenproducciondetalle[] $ordenproducciondetalles
 */
class Ordenproduccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenproduccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idordenproduccion', 'idcliente', 'fechallegada', 'fechaprocesada', 'fechaentrega', 'totalorden', 'valorletras', 'observacion', 'estado', 'usuariosistema'], 'required', 'message' => 'Campo requerido'],
            [['idordenproduccion', 'idcliente'], 'integer'],
            [['fechallegada', 'fechaprocesada', 'fechaentrega'], 'safe'],
            [['valorletras', 'observacion'], 'string'],
            [['totalorden', 'estado', 'usuariosistema'], 'string', 'max' => 15],
            [['idordenproduccion'], 'unique'],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idordenproduccion' => 'Idordenproduccion:',
            'idcliente' => 'Idcliente:',
            'fechallegada' => 'Fecha Llegada:',
            'fechaprocesada' => 'Fecha Procesada:',
            'fechaentrega' => 'Fecha Entrega:',
            'totalorden' => 'Total Orden:',
            'valorletras' => 'Valor Letras:',
            'observacion' => 'Observación:',
            'estado' => 'Estado:',
            'usuariosistema' => 'Usuariosistema:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaventas()
    {
        return $this->hasMany(Facturaventa::className(), ['idordenproduccion' => 'idordenproduccion']);
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
    public function getOrdenproducciondetalles()
    {
        return $this->hasMany(Ordenproducciondetalle::className(), ['idordenproduccion' => 'idordenproduccion']);
    }
}
