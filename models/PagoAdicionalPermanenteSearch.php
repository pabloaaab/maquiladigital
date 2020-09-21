<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PagoAdicionalPermanente;

/**
 * PagoAdicionalPermanenteSearch represents the model behind the search form of `app\models\PagoAdicionalPermanente`.
 */
class PagoAdicionalPermanenteSearch extends PagoAdicionalPermanente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pago_permanente', 'id_empleado', 'codigo_salario', 'id_contrato', 'tipo_adicion', 'vlr_adicion', 'permanente', 'aplicar_dia_laborado', 'aplicar_prima', 'aplicar_cesantias', 'estado_registro', 'estado_periodo'], 'integer'],
            [['detalle', 'fecha_creacion', 'usuariosistema'], 'safe'],
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
        $query = PagoAdicionalPermanente::find();

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
            'id_pago_permanente' => $this->id_pago_permanente,
            'id_empleado' => $this->id_empleado,
            'codigo_salario' => $this->codigo_salario,
            'id_contrato' => $this->id_contrato,
            'tipo_adicion' => $this->tipo_adicion,
            'vlr_adicion' => $this->vlr_adicion,
            'permanente' => $this->permanente,
            'aplicar_dia_laborado' => $this->aplicar_dia_laborado,
            'aplicar_prima' => $this->aplicar_prima,
            'aplicar_cesantias' => $this->aplicar_cesantias,
            'estado_registro' => $this->estado_registro,
            'estado_periodo' => $this->estado_periodo,
            'fecha_creacion' => $this->fecha_creacion,
        ]);

        $query->andFilterWhere(['like', 'detalle', $this->detalle])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
