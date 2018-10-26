<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prendatipo;

/**
 * PrendatipoSearch represents the model behind the search form of `app\models\Prendatipo`.
 */
class PrendatipoSearch extends Prendatipo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idprendatipo', 'idtalla'], 'integer'],
            [['prenda'], 'safe'],
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
        $query = Prendatipo::find();

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
            'idprendatipo' => $this->idprendatipo,
            'idtalla' => $this->idtalla,
        ]);

        $query->andFilterWhere(['like', 'prenda', $this->prenda]);

        return $dataProvider;
    }
}
