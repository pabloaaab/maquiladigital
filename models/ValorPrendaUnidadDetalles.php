<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "valor_prenda_unidad_detalles".
 *
 * @property int $consecutivo
 * @property int $id_operario
 * @property int $idordenproduccion
 * @property string $dia_pago
 * @property int $cantidad
 * @property int $vlr_prenda
 * @property int $vlr_pago
 * @property int $id_valor
 * @property string $fecha_creacion
 * @property string $usuariosistema
 * @property string $observacion
 *
 * @property Operarios $operario
 * @property Ordenproduccion $ordenproduccion
 * @property ValorPrendaUnidad $valor
 */
class ValorPrendaUnidadDetalles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valor_prenda_unidad_detalles';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->observacion = strtolower($this->observacion); 
        $this->observacion = ucfirst($this->observacion);  
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_operario', 'idordenproduccion', 'cantidad', 'vlr_prenda', 'vlr_pago', 'id_valor'], 'integer'],
            [['dia_pago', 'fecha_creacion'], 'safe'],
            [['usuariosistema', 'observacion'], 'string', 'max' => 20],
            [['id_operario'], 'exist', 'skipOnError' => true, 'targetClass' => Operarios::className(), 'targetAttribute' => ['id_operario' => 'id_operario']],
            [['idordenproduccion'], 'exist', 'skipOnError' => true, 'targetClass' => Ordenproduccion::className(), 'targetAttribute' => ['idordenproduccion' => 'idordenproduccion']],
            [['id_valor'], 'exist', 'skipOnError' => true, 'targetClass' => ValorPrendaUnidad::className(), 'targetAttribute' => ['id_valor' => 'id_valor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'consecutivo' => 'Consecutivo',
            'id_operario' => 'Id Operario',
            'idordenproduccion' => 'Idordenproduccion',
            'dia_pago' => 'Dia Pago',
            'cantidad' => 'Cantidad',
            'vlr_prenda' => 'Vlr Prenda',
            'vlr_pago' => 'Vlr Pago',
            'id_valor' => 'Id Valor',
            'fecha_creacion' => 'Fecha Creacion',
            'usuariosistema' => 'Usuariosistema',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperario()
    {
        return $this->hasOne(Operarios::className(), ['id_operario' => 'id_operario']);
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
    public function getValor()
    {
        return $this->hasOne(ValorPrendaUnidad::className(), ['id_valor' => 'id_valor']);
    }
}
