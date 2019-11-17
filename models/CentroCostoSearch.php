<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CentroCosto;

/**
 * CentroCostoSearch represents the model behind the search form of `app\models\CentroCosto`.
 */
class CentroCostoSearch extends CentroCosto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_centro_costo'], 'integer'],
            [['centro_costo'], 'safe'],
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
        $query = CentroCosto::find();

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
            'id_centro_costo' => $this->id_centro_costo,
        ]);

        $query->andFilterWhere(['like', 'centro_costo', $this->centro_costo]);

        return $dataProvider;
    }
}
