<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Insumos;

/**
 * InsumosSearch represents the model behind the search form of `app\models\Insumos`.
 */
class InsumosSearch extends Insumos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_insumos', 'estado_insumo','id_tipo_medida'], 'integer'],
            [['precio_unitario'], 'number'],
            [['codigo_insumo', 'descripcion', 'fecha_entrada', 'usuariosistema'], 'safe'],
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
        $query = Insumos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_insumos' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_insumos' => $this->id_insumos,
            'fecha_entrada' => $this->fecha_entrada,
            'estado_insumo' => $this->estado_insumo,
        ]);

        $query->andFilterWhere(['like', 'codigo_insumo', $this->codigo_insumo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
