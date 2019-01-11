<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ordenproduccion;

/**
 * OrdenproduccionSearch represents the model behind the search form of `app\models\Ordenproduccion`.
 */
class OrdenproduccionSearch extends Ordenproduccion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idordenproduccion', 'idcliente', 'idtipo'], 'integer'],
            [['fechallegada', 'fechaprocesada', 'fechaentrega', 'totalorden', 'valorletras', 'observacion', 'estado', 'usuariosistema','autorizado','facturado','ordenproduccion','ordenproduccionext'], 'safe'],
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
        $query = Ordenproduccion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['idordenproduccion' => SORT_DESC]] // Agregar esta linea para agregar el orden por defecto
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idordenproduccion' => $this->idordenproduccion,
            'idcliente' => $this->idcliente,
            'fechallegada' => $this->fechallegada,
            'fechaprocesada' => $this->fechaprocesada,
            'fechaentrega' => $this->fechaentrega,
            'autorizado' => $this->autorizado,
            'facturado' => $this->facturado,
            'idtipo' => $this->idtipo,
        ]);

        $query->andFilterWhere(['like', 'totalorden', $this->totalorden])
            ->andFilterWhere(['like', 'valorletras', $this->valorletras])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
