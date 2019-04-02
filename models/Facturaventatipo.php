<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturaventatipo".
 *
 * @property int $id_factura_venta_tipo
 * @property string $concepto
 * @property int $estado
 *
 * @property Facturaventa[] $facturaventas
 */
class Facturaventatipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturaventatipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['concepto'], 'required'],
            [['estado'], 'integer'],
            [['concepto'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_factura_venta_tipo' => 'Id',
            'concepto' => 'Concepto',
            'estado' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaventas()
    {
        return $this->hasMany(Facturaventa::className(), ['id_factura_venta_tipo' => 'id_factura_venta_tipo']);
    }
    
    public function getEstados()
    {
        if($this->estado == 1){
            $estado = "SI";
        }else{
            $estado = "NO";
        }
        return $estado;
    }
}
