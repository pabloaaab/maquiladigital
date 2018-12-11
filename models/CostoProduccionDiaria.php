<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costo_produccion_diaria".
 *
 * @property int $id_costo_produccion_diaria
 * @property int $idcliente
 * @property int $idordenproduccion
 * @property int $cantidad
 * @property string $ordenproduccion
 * @property string $ordenproduccionext
 * @property int $idtipo
 * @property double $cantidad_x_hora
 * @property double $cantidad_diaria
 * @property double $tiempo_entrega_dias
 * @property double $nro_horas
 * @property double $dias_entrega
 * @property double $costo_muestra_operaria
 * @property double $costo_x_hora
 */
class CostoProduccionDiaria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'costo_produccion_diaria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcliente', 'idordenproduccion', 'cantidad', 'idtipo'], 'integer'],
            [['cantidad_x_hora', 'cantidad_diaria', 'tiempo_entrega_dias', 'nro_horas', 'dias_entrega', 'costo_muestra_operaria', 'costo_x_hora'], 'number'],
            [['ordenproduccion', 'ordenproduccionext'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_costo_produccion_diaria' => 'Id Costo Produccion Diaria',
            'idcliente' => 'Idcliente',
            'idordenproduccion' => 'Idordenproduccion',
            'cantidad' => 'Cantidad',
            'ordenproduccion' => 'Ordenproduccion',
            'ordenproduccionext' => 'Ordenproduccionext',
            'idtipo' => 'Idtipo',
            'cantidad_x_hora' => 'Cantidad X Hora',
            'cantidad_diaria' => 'Cantidad Diaria',
            'tiempo_entrega_dias' => 'Tiempo Entrega Dias',
            'nro_horas' => 'Nro Horas',
            'dias_entrega' => 'Dias Entrega',
            'costo_muestra_operaria' => 'Costo Muestra Operaria',
            'costo_x_hora' => 'Costo X Hora',
        ];
    }
}
