<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "otros_costos_produccion".
 *
 * @property int $id_costo
 * @property int $idordenproduccion
 * @property int $id_compra
 * @property double $vlr_costo
 * @property string $nrofactura
 * @property string $fecha_proceso
 * @property string $usuariosistema
 *
 * @property Ordenproduccion $ordenproduccion
 * @property Compra $compra
 */
class OtrosCostosProduccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otros_costos_produccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idordenproduccion', 'id_compra', 'vlr_costo','id_proveedor'], 'required'],
            [['idordenproduccion', 'id_compra'], 'integer'],
            [['vlr_costo'], 'number'],
            [['fecha_proceso','fecha_compra'], 'safe'],
            [['nrofactura'], 'string', 'max' => 15],
            [['usuariosistema'], 'string', 'max' => 20],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
            [['id_compra'], 'exist', 'skipOnError' => true, 'targetClass' => Compra::className(), 'targetAttribute' => ['id_compra' => 'id_compra']],
            [['id_proveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['id_proveedor' => 'idproveedor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_costo' => 'Id Costo',
            'idordenproduccion' => 'Idordenproduccion',
            'id_compra' => 'Id Compra',
            'vlr_costo' => 'Vlr Costo',
            'nrofactura' => 'Nrofactura',
            'fecha_proceso' => 'Fecha Proceso',
            'fecha_compra' => 'Fecha compra',
            'id_proveedor' => 'Proveedor',
            'usuariosistema' => 'Usuariosistema',
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
    public function getCompra()
    {
        return $this->hasOne(Compra::className(), ['id_compra' => 'id_compra']);
    }
    
    public function getProveedorCostos()
    {
        return $this->hasOne(Proveedor::className(), ['idproveedor' => 'id_proveedor']);
    }
}
