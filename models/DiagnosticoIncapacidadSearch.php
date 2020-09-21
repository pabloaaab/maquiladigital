<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DiagnosticoIncapacidad;

/**
 * DepartamentoSearch represents the model behind the search form of `app\models\Departamento`.
 */
class DiagnosticoIncapacidadSearch extends DiagnosticoIncapacidad
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_diagnostico', 'diagnostico'], 'safe'],
            [['id_codigo'], 'integer'],

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
        $query = DiagnosticoIncapacidad::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['diagnostico' => SORT_ASC]] // Agregar esta linea para agregar el orden por defecto
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_codigo' => $this->id_codigo,
        ]);

        $query->andFilterWhere(['like', 'id_codigo', $this->id_codigo])
            ->andFilterWhere(['like', 'codigo_diagnostico', $this->codigo_diagnostico]);

        return $dataProvider;
    }
}
