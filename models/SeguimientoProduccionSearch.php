<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SeguimientoProduccion;

/**
 * SeguimientoProduccionSearch represents the model behind the search form of `app\models\SeguimientoProduccion`.
 */
class SeguimientoProduccionSearch extends SeguimientoProduccion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_seguimiento_produccion', 'idcliente', 'idordenproduccion'], 'integer'],
            [['fecha_inicio_produccion', 'hora_inicio'], 'safe'],
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
        $query = SeguimientoProduccion::find();

        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_seguimiento_produccion' => SORT_DESC]] // Agregar esta linea para agregar el orden por defecto
        ]);

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
            'id_seguimiento_produccion' => $this->id_seguimiento_produccion,
            'fecha_inicio_produccion' => $this->fecha_inicio_produccion,
            'hora_inicio' => $this->hora_inicio,
            'idcliente' => $this->idcliente,
            'idordenproduccion' => $this->idordenproduccion,
        ]);

        return $dataProvider;
    }
}
