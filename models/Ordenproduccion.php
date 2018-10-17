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
 * @property string $usuariosistema
 *
 * @property Facturaventa[] $facturaventas
 * @property Cliente $cliente
 * @property Ordenproducciondetalle[] $ordenproducciondetalles
 */
class Ordenproduccion extends \yii\db\ActiveRecord
{
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;

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

    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)){
            return false;
        }
        $this->observacion = strtoupper($this->observacion);
        $this->ordenproduccion = strtoupper($this->ordenproduccion);
        return true;
    }

    public function rules()
    {
        return [
            [['idcliente', 'fechallegada', 'fechaprocesada', 'fechaentrega', 'observacion'], 'required', 'message' => 'Campo requerido'],
            [['idcliente', 'estado'], 'integer'],
            [['fechallegada', 'fechaprocesada', 'fechaentrega'], 'safe', 'message' => 'Campo requerido'],
            [['totalorden'], 'number', 'message' => 'Solo se acpetan números'],
            [['valorletras', 'observacion'], 'string'],
            [['ordenproduccion'], 'string', 'max' => 25],
            [['usuariosistema'], 'string', 'max' => 50],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
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
    public function getOrdenproducciondetalles()
    {
        return $this->hasMany(Ordenproducciondetalle::className(), ['idordenproduccion' => 'idordenproduccion']);
    }

    public function getEtiquetaEstado(){
        if($this->estado == 0){
            return ('ABIERTO');
        } else {

            return ('CERRADO');
        }
    }
}
