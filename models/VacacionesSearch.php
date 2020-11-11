<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacaciones;

/**
 * VacacionesSearch represents the model behind the search form of `app\models\Vacaciones`.
 */
class VacacionesSearch extends Vacaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_vacacion', 'id_empleado', 'id_contrato', 'id_grupo_pago', 'dias_disfrutados', 'dias_pagados', 'dias_total_vacacion', 'dias_real_disfrutados', 'salario_contrato', 'salario_promedio', 'total_pago_vacacion', 'vlr_vacacion_disfrute', 'vlr_vacacion_dinero', 'vlr_recargo_nocturno', 'dias_ausentismo', 'descuento_eps', 'descuento_pension', 'total_descuentos', 'total_bonificaciones', 'estado_autorizado', 'estado_cerrado', 'estado_anulado', 'nro_pago'], 'integer'],
            [['fecha_desde', 'fecha_hasta', 'fecha_proceso', 'fecha_ingreso', 'fecha_inicio_disfrute', 'fecha_final_disfrute', 'observacion', 'usuariosistema'], 'safe'],
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
        $query = Vacaciones::find();

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
            'id_vacacion' => $this->id_vacacion,
            'id_empleado' => $this->id_empleado,
            'id_contrato' => $this->id_contrato,
            'id_grupo_pago' => $this->id_grupo_pago,
            'fecha_desde' => $this->fecha_desde,
            'fecha_hasta' => $this->fecha_hasta,
            'fecha_proceso' => $this->fecha_proceso,
            'fecha_ingreso' => $this->fecha_ingreso,
            'fecha_inicio_disfrute' => $this->fecha_inicio_disfrute,
            'fecha_final_disfrute' => $this->fecha_final_disfrute,
            'dias_disfrutados' => $this->dias_disfrutados,
            'dias_pagados' => $this->dias_pagados,
            'dias_total_vacacion' => $this->dias_total_vacacion,
            'dias_real_disfrutados' => $this->dias_real_disfrutados,
            'salario_contrato' => $this->salario_contrato,
            'salario_promedio' => $this->salario_promedio,
            'total_pago_vacacion' => $this->total_pago_vacacion,
            'vlr_vacacion_disfrute' => $this->vlr_vacacion_disfrute,
            'vlr_vacacion_dinero' => $this->vlr_vacacion_dinero,
            'vlr_recargo_nocturno' => $this->vlr_recargo_nocturno,
            'dias_ausentismo' => $this->dias_ausentismo,
            'descuento_eps' => $this->descuento_eps,
            'descuento_pension' => $this->descuento_pension,
            'total_descuentos' => $this->total_descuentos,
            'total_bonificaciones' => $this->total_bonificaciones,
            'estado_autorizado' => $this->estado_autorizado,
            'estado_cerrado' => $this->estado_cerrado,
            'estado_anulado' => $this->estado_anulado,
            'nro_pago' => $this->nro_pago,
        ]);

        $query->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
