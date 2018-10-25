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
 * @property double $totalorden
 * @property string $valorletras
 * @property string $observacion
 * @property int $estado
 * @property string $ordenproduccion
 * @property int $idtipo
 * @property string $usuariosistema
 *
 * @property Facturaventa[] $facturaventas
 * @property Cliente $cliente
 * @property Ordenproducciontipo $tipo
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
            [['idcliente', 'fechallegada', 'fechaprocesada', 'fechaentrega', 'observacion', 'idtipo'], 'required'],
            [['idcliente', 'estado', 'idtipo'], 'integer'],
            [['fechallegada', 'fechaprocesada', 'fechaentrega'], 'safe'],
            [['totalorden'], 'number'],
            [['valorletras', 'observacion'], 'string'],
            [['ordenproduccion'], 'string', 'max' => 25],
            [['usuariosistema'], 'string', 'max' => 50],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idtipo'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproducciontipo::className(), 'targetAttribute' => ['idtipo' => 'idtipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idordenproduccion' => 'Idordenproduccion',
            'idcliente' => 'Idcliente',
            'fechallegada' => 'Fechallegada',
            'fechaprocesada' => 'Fechaprocesada',
            'fechaentrega' => 'Fechaentrega',
            'totalorden' => 'Totalorden',
            'valorletras' => 'Valorletras',
            'observacion' => 'Observacion',
            'estado' => 'Estado',
            'ordenproduccion' => 'Ordenproduccion',
            'idtipo' => 'Idtipo',
            'usuariosistema' => 'Usuariosistema',
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
    public function getTipo()
    {
        return $this->hasOne(Ordenproducciontipo::className(), ['idtipo' => 'idtipo']);
    }

    public function getOrdenProduccion()
    {
        return " Id: {$this->idordenproduccion} - Orden Producción: {$this->ordenproduccion} - Fecha Llegada: {$this->fechallegada} - Total: {$this->totalorden} - Tipo: {$this->tipo->tipo}";
    }
}