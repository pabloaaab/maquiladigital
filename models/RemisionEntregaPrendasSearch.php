<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RemisionEntregaPrendas;

/**
 * RemisionEntregaPrendasSearch represents the model behind the search form of `app\models\RemisionEntregaPrendas`.
 */
class RemisionEntregaPrendasSearch extends RemisionEntregaPrendas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_remision', 'idcliente', 'nro_remision', 'cantidad', 'valor_total', 'valor_pagar', 'estado_remision', 'autorizado'], 'integer'],
            [['fecha_entrega', 'fecha_registro', 'usuariosistema'], 'safe'],
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
        $query = RemisionEntregaPrendas::find();

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
            'id_remision' => $this->id_remision,
            'idcliente' => $this->idcliente,
            'nro_remision' => $this->nro_remision,
            'fecha_entrega' => $this->fecha_entrega,
            'fecha_registro' => $this->fecha_registro,
            'cantidad' => $this->cantidad,
            'valor_total' => $this->valor_total,
            'valor_pagar' => $this->valor_pagar,
            'estado_remision' => $this->estado_remision,
            'autorizado' => $this->autorizado,
        ]);

        $query->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
