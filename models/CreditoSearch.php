<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Credito;

/**
 * CreditoSearch represents the model behind the search form of `app\models\Credito`.
 */
class CreditoSearch extends Credito
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_credito', 'id_empleado', 'codigo_credito', 'id_tipo_pago', 'numero_cuotas', 'numero_cuota_actual', 'validar_cuotas', 'estado_credito', 'estado_periodo', 'aplicar_prima', 'vlr_aplicar'], 'integer'],
            [['vlr_credito', 'vlr_cuota', 'seguro', 'saldo_credito'], 'number'],
            [['fecha_creacion', 'fecha_inicio', 'numero_libranza', 'observacion', 'usuariosistema'], 'safe'],
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
        $query = Credito::find();

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
            'id_credito' => $this->id_credito,
            'id_empleado' => $this->id_empleado,
            'codigo_credito' => $this->codigo_credito,
            'id_tipo_pago' => $this->id_tipo_pago,
            'vlr_credito' => $this->vlr_credito,
            'vlr_cuota' => $this->vlr_cuota,
            'numero_cuotas' => $this->numero_cuotas,
            'numero_cuota_actual' => $this->numero_cuota_actual,
            'validar_cuotas' => $this->validar_cuotas,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_inicio' => $this->fecha_inicio,
            'seguro' => $this->seguro,
            'saldo_credito' => $this->saldo_credito,
            'estado_credito' => $this->estado_credito,
            'estado_periodo' => $this->estado_periodo,
            'aplicar_prima' => $this->aplicar_prima,
            'vlr_aplicar' => $this->vlr_aplicar,
        ]);

        $query->andFilterWhere(['like', 'numero_libranza', $this->numero_libranza])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
