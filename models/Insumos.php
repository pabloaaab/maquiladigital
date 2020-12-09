<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insumos".
 *
 * @property int $id_insumos
 * @property string $codigo_insumo
 * @property string $descripcion
 * @property string $fecha_entrada
 * @property int $estado_insumo
 * @property string $usuariosistema
 */
class Insumos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insumos';
    }
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->codigo_insumo = strtoupper($this->codigo_insumo);        
        $this->descripcion = strtoupper($this->descripcion);        
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_insumo', 'descripcion', 'estado_insumo','id_tipo_medida'], 'required'],
            [['fecha_entrada'], 'safe'],
            [['estado_insumo'], 'integer'],
             [['precio_unitario'], 'number'],
            [['codigo_insumo'], 'string', 'max' => 15],
            [['descripcion'], 'string', 'max' => 60],
            [['usuariosistema'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_insumos' => 'Id',
            'codigo_insumo' => 'Código:',
            'descripcion' => 'Descripción:',
            'precio_unitario' => 'Precio unitario:',
            'fecha_entrada' => 'Fecha Entrada',
            'estado_insumo' => 'Activo:',
            'usuariosistema' => 'Usuario',
            'id_tipo_medida' => 'Tipo medida:',
        ];
    }
    
    public function getEstado()
    {
        if($this->estado_insumo == 1){
            $estado = "SI";
        }else{
            $estado = "NO";
        }
        return $estado;
    }
    
      public function getTipomedida()
    {
        return $this->hasOne(TipoMedida::className(), ['id_tipo_medida' => 'id_tipo_medida']);
    }
}
