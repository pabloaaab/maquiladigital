<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Balanceo;

/**
 * BalanceoSearch represents the model behind the search form of `app\models\Balanceo`.
 */
class BalanceoSearch extends Balanceo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_balanceo', 'idordenproduccion', 'cantidad_empleados'], 'integer'],
            [['fecha_creacion', 'fecha_inicio', 'usuariosistema'], 'safe'],
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
        $query = Balanceo::find();

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
            'id_balanceo' => $this->id_balanceo,
            'idordenproduccion' => $this->idordenproduccion,
            'cantidad_empleados' => $this->cantidad_empleados,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_inicio' => $this->fecha_inicio,
        ]);

        $query->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
