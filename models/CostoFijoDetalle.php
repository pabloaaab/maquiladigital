<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costo_fijo_detalle".
 *
 * @property int $id_detalle_costo_fijo
 * @property int $id_costo_fijo
 * @property string $descripcion
 * @property double $valor
 *
 * @property CostoFijo $costoFijo
 */
class CostoFijoDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'costo_fijo_detalle';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->descripcion = strtoupper($this->descripcion);        
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_costo_fijo', 'descripcion', 'valor'], 'required'],
            [['id_costo_fijo'], 'integer'],
            [['valor'], 'number'],
            [['descripcion'], 'string', 'max' => 50],
            [['id_costo_fijo'], 'exist', 'skipOnError' => true, 'targetClass' => CostoFijo::className(), 'targetAttribute' => ['id_costo_fijo' => 'id_costo_fijo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detalle_costo_fijo' => 'Id Detalle Costo Fijo',
            'id_costo_fijo' => 'Id Costo Fijo',
            'descripcion' => 'Descripcion',
            'valor' => 'Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostoFijo()
    {
        return $this->hasOne(CostoFijo::className(), ['id_costo_fijo' => 'id_costo_fijo']);
    }
}
