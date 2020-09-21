<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GrupoPago;
use app\models\PeriodoPago;


/**
 * GrupoPagoSearch represents the model behind the search form of `app\models\GrupoPago`.
 */
class GrupoPagoSearch extends GrupoPago
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['estado', 'id_grupo_pago', 'id_periodo_pago','id_sucursal', 'limite_devengado'], 'integer'],
             [['ultimo_pago_prima', 'ultimo_pago_cesantia', 'fecha_creacion', 'ultimo_pago_nomina'], 'safe'],
            [['grupo_pago', 'iddepartamento', 'idmunicipio', 'dias_pago', 'observacion'], 'string'],
            ['limite_devengado', 'match', 'pattern' => '/^[0-9]+$/i', 'message' => 'Sólo se aceptan números'],
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
        $query = GrupoPago::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_grupo_pago' => SORT_ASC]] // Agregar esta linea para agregar el orden por defecto
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_grupo_pago' => $this->id_grupo_pago,
            'id_periodo_pago' => $this->id_periodo_pago,
            'ultimo_pago_nomina' => $this->ultimo_pago_nomina,
             'ultimo_pago_prima' => $this->ultimo_pago_prima,
             'ultimo_pago_cesantia' => $this->ultimo_pago_cesantia,
            'estado' => $this->estado,
        ]);
         $query->andFilterWhere(['like', 'id_grupo_pago', $this->id_grupo_pago]);
         $query->andFilterWhere(['like', 'grupo_pago', $this->grupo_pago]);
         $query->andFilterWhere(['like', 'id_periodo_pago', $this->id_periodo_pago]);
          $query->andFilterWhere(['like', 'ultimo_pago_nomina', $this->ultimo_pago_nomina]);
        $query->andFilterWhere(['like', 'ultimo_pago_prima', $this->ultimo_pago_prima]);
        $query->andFilterWhere(['like', 'ultimo_pago_cesantia', $this->ultimo_pago_cesantia]);
        return $dataProvider;
    }
}
