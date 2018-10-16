<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Facturaventa;

/**
 * FacturaventaSearch represents the model behind the search form of `app\models\Facturaventa`.
 */
class FacturaventaSearch extends Facturaventa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nrofactura', 'plazopago', 'idcliente', 'idordenproduccion'], 'integer'],
            [['fechainicio', 'fechavcto', 'formapago', 'valorletras', 'usuariosistema'], 'safe'],
            [['porcentajeiva', 'porcentajefuente', 'porcentajereteiva', 'subtotal', 'retencionfuente', 'impuestoiva', 'retencioniva', 'totalpagar'], 'number'],
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
        $query = Facturaventa::find();

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
            'nrofactura' => $this->nrofactura,
            'fechainicio' => $this->fechainicio,
            'fechavcto' => $this->fechavcto,
            'plazopago' => $this->plazopago,
            'porcentajeiva' => $this->porcentajeiva,
            'porcentajefuente' => $this->porcentajefuente,
            'porcentajereteiva' => $this->porcentajereteiva,
            'subtotal' => $this->subtotal,
            'retencionfuente' => $this->retencionfuente,
            'impuestoiva' => $this->impuestoiva,
            'retencioniva' => $this->retencioniva,
            'totalpagar' => $this->totalpagar,
            'idcliente' => $this->idcliente,
            'idordenproduccion' => $this->idordenproduccion,
        ]);

        $query->andFilterWhere(['like', 'formapago', $this->formapago])
            ->andFilterWhere(['like', 'valorletras', $this->valorletras])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
