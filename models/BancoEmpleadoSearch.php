<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BancoEmpleado;

/**
 * BancoEmpleadoSearch represents the model behind the search form of `app\models\BancoEmpleado`.
 */
class BancoEmpleadoSearch extends BancoEmpleado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_banco_empleado'], 'integer'],
            [['banco', 'codigo_interfaz'], 'safe'],
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
        $query = BancoEmpleado::find();

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
            'id_banco_empleado' => $this->id_banco_empleado,
        ]);

        $query->andFilterWhere(['like', 'banco', $this->banco])
            ->andFilterWhere(['like', 'codigo_interfaz', $this->codigo_interfaz]);

        return $dataProvider;
    }
}
