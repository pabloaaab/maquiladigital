<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fichatiempo;

/**
 * FichatiempoSearch represents the model behind the search form of `app\models\Fichatiempo`.
 */
class FichatiempoSearch extends Fichatiempo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ficha_tiempo', 'id_empleado'], 'integer'],
            [['cumplimiento'], 'number'],
            [['observacion'], 'safe'],
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
        $query = Fichatiempo::find();

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
            'id_ficha_tiempo' => $this->id_ficha_tiempo,
            'id_empleado' => $this->id_empleado,
            'cumplimiento' => $this->cumplimiento,
        ]);

        $query->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}