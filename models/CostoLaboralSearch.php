<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CostoLaboral;

/**
 * CostoLaboralSearch represents the model behind the search form of `app\models\CostoLaboral`.
 */
class CostoLaboralSearch extends CostoLaboral
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_costo_laboral'], 'integer'],
            [['total_otros', 'total_administrativo', 'total_administracion', 'total_operativo', 'total_general'], 'number'],
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
        $query = CostoLaboral::find();

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
            'id_costo_laboral' => $this->id_costo_laboral,
            'total_otros' => $this->total_otros,
            'total_administrativo' => $this->total_administrativo,
            'total_administracion' => $this->total_administracion,
            'total_operativo' => $this->total_operativo,
            'total_general' => $this->total_general,
        ]);

        return $dataProvider;
    }
}
