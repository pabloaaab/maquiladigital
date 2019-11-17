<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstadoCivil;

/**
 * EstadoCivilSearch represents the model behind the search form of `app\models\EstadoCivil`.
 */
class EstadoCivilSearch extends EstadoCivil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estado_civil'], 'integer'],
            [['estado_civil'], 'safe'],
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
        $query = EstadoCivil::find();

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
            'id_estado_civil' => $this->id_estado_civil,
        ]);

        $query->andFilterWhere(['like', 'estado_civil', $this->estado_civil]);

        return $dataProvider;
    }
}
