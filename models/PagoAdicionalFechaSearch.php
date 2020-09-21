<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PagoAdicionalFecha;

/**
 * PagoAdicionalFechaSearch represents the model behind the search form of `app\models\PagoAdicionalFecha`.
 */
class PagoAdicionalFechaSearch extends PagoAdicionalFecha
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pago_fecha', 'estado_proceso'], 'integer'],
            [['fecha_corte', 'fecha_creacion', 'detalle', 'usuariosistema'], 'safe'],
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
        $query = PagoAdicionalFecha::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort'=> ['defaultOrder' => ['id_pago_fecha' => SORT_DESC]] // Agregar esta linea para agregar el orden por defecto
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pago_fecha' => $this->id_pago_fecha,
            'fecha_corte' => $this->fecha_corte,
            'fecha_creacion' => $this->fecha_creacion,
            'estado_proceso' => $this->estado_proceso,
        ]);

        $query->andFilterWhere(['like', 'detalle', $this->detalle])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
