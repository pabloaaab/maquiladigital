<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PrestacionesSociales;

/**
 * PrestacionesSocialesSearch represents the model behind the search form of `app\models\PrestacionesSociales`.
 */
class PrestacionesSocialesSearch extends PrestacionesSociales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prestacion', 'id_empleado', 'id_contrato', 'documento', 'nro_pago', 'id_grupo_pago', 'dias_primas', 'ibp_prima', 'dias_ausencia_prima', 'dias_cesantias', 'ibp_cesantias', 'dias_ausencia_primas', 'interes_cesantia', 'dias_vacaciones', 'ibp_vacaciones', 'dias_ausencia_vacaciones', 'total_deduccion', 'total_devengado', 'total_pagar'], 'integer'],
            [['fecha_inicio_contrato', 'fecha_termino_contrato', 'fecha_creacion', 'observacion', 'usuariosistema'], 'safe'],
            [['porcentaje_intreres'], 'number'],
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
        $query = PrestacionesSociales::find();

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
            'id_prestacion' => $this->id_prestacion,
            'id_empleado' => $this->id_empleado,
            'id_contrato' => $this->id_contrato,
            'documento' => $this->documento,
            'nro_pago' => $this->nro_pago,
            'id_grupo_pago' => $this->id_grupo_pago,
            'fecha_inicio_contrato' => $this->fecha_inicio_contrato,
            'fecha_termino_contrato' => $this->fecha_termino_contrato,
            'fecha_creacion' => $this->fecha_creacion,
            'dias_primas' => $this->dias_primas,
            'ibp_prima' => $this->ibp_prima,
            'dias_ausencia_prima' => $this->dias_ausencia_prima,
            'dias_cesantias' => $this->dias_cesantias,
            'ibp_cesantias' => $this->ibp_cesantias,
            'dias_ausencia_primas' => $this->dias_ausencia_primas,
            'interes_cesantia' => $this->interes_cesantia,
            'porcentaje_intreres' => $this->porcentaje_intreres,
            'dias_vacaciones' => $this->dias_vacaciones,
            'ibp_vacaciones' => $this->ibp_vacaciones,
            'dias_ausencia_vacaciones' => $this->dias_ausencia_vacaciones,
            'total_deduccion' => $this->total_deduccion,
            'total_devengado' => $this->total_devengado,
            'total_pagar' => $this->total_pagar,
        ]);

        $query->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
