<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ValorPrendaUnidad;

/**
 * ValorPrendaUnidadSearch represents the model behind the search form of `app\models\ValorPrendaUnidad`.
 */
class ValorPrendaUnidadSearch extends ValorPrendaUnidad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_valor', 'idordenproduccion', 'idtipo', 'estado_valor','autorizado','cerrar_pago','total_pagar'], 'integer'],
            [['vlr_vinculado', 'vlr_contrato'], 'number'],
            [['fecha_proceso', 'usuariosistema'], 'safe'],
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
        $query = ValorPrendaUnidad::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort'=> ['defaultOrder' => ['id_valor' => SORT_DESC]] // Agregar esta linea para agregar el orden por defecto
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_valor' => $this->id_valor,
            'idordenproduccion' => $this->idordenproduccion,
            'idtipo' => $this->idtipo,
            'vlr_vinculado' => $this->vlr_vinculado,
            'vlr_contrato' => $this->vlr_contrato,
            'estado_valor' => $this->estado_valor,
            'fecha_proceso' => $this->fecha_proceso,
            'autorizado' => $this->autorizado,
            'cerrar_pago' => $this->cerrar_pago,
             'total_pagar' => $this->total_pagar,
        ]);

        $query->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);
        $query->andFilterWhere(['=', 'id_valor', $this->id_valor]);
        $query->andFilterWhere(['=', 'vlr_vinculado', $this->vlr_vinculado]);
        $query->andFilterWhere(['=', 'vlr_contrato', $this->vlr_contrato]);
        $query->andFilterWhere(['=', 'estado_valor', $this->estado_valor]);
        $query->andFilterWhere(['=', 'autorizado', $this->autorizado]);
        $query->andFilterWhere(['=', 'cerrar_pago', $this->cerrar_pago]);
        $query->andFilterWhere(['like', 'total_pagar', $this->total_pagar]);

        return $dataProvider;
    }
}
