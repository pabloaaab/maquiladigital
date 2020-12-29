<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Referencias;

/**
 * ReferenciasSearch represents the model behind the search form of `app\models\Referencias`.
 */
class ReferenciasSearch extends Referencias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_referencia', 'id_producto', 'codigo_producto', 'existencias', 'total_existencias', 'precio_costo', 'precio_venta_mayorista', 'precio_venta_deptal', 'id_proveedor', 'estado_existencia', 'autorizado', 't2', 't4', 't6', 't8', 't10', 't12', 't14', 't16', 't18', 't20', 't22', 't24', 't26', 't28', 't30', 't32', 't34', 't36', 't38', 't40', 't42', 't44', 'xs', 's', 'm', 'l', 'xl'], 'integer'],
            [['porcentaje_mayorista', 'porcentaje_deptal'], 'number'],
            [['fecha_creacion', 'usuariosistema'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Referencias::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_referencia' => $this->id_referencia,
            'id_producto' => $this->id_producto,
            'codigo_producto' => $this->codigo_producto,
            'existencias' => $this->existencias,
            'total_existencias' => $this->total_existencias,
            'precio_costo' => $this->precio_costo,
            'porcentaje_mayorista' => $this->porcentaje_mayorista,
            'porcentaje_deptal' => $this->porcentaje_deptal,
            'precio_venta_mayorista' => $this->precio_venta_mayorista,
            'precio_venta_deptal' => $this->precio_venta_deptal,
            'id_proveedor' => $this->id_proveedor,
            'estado_existencia' => $this->estado_existencia,
            'autorizado' => $this->autorizado,
            'fecha_creacion' => $this->fecha_creacion,
            't2' => $this->t2,
            't4' => $this->t4,
            't6' => $this->t6,
            't8' => $this->t8,
            't10' => $this->t10,
            't12' => $this->t12,
            't14' => $this->t14,
            't16' => $this->t16,
            't18' => $this->t18,
            't20' => $this->t20,
            't22' => $this->t22,
            't24' => $this->t24,
            't26' => $this->t26,
            't28' => $this->t28,
            't30' => $this->t30,
            't32' => $this->t32,
            't34' => $this->t34,
            't36' => $this->t36,
            't38' => $this->t38,
            't40' => $this->t40,
            't42' => $this->t42,
            't44' => $this->t44,
            'xs' => $this->xs,
            's' => $this->s,
            'm' => $this->m,
            'l' => $this->l,
            'xl' => $this->xl,
        ]);

        $query->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
