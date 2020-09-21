<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProgramacionNomina;

/**
 * ProgramacionNominaSearch represents the model behind the search form of `app\models\ProgramacionNomina`.
 */
class ProgramacionNominaSearch extends ProgramacionNomina
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_programacion', 'id_grupo_pago', 'id_periodo_pago_nomina', 'id_contrato', 'id_empleado', 'cedula_empleado', 'nro_pago', 'dias_pago', 'estado_generado', 'estado_liquidado', 'estado_cerrado'], 'integer'],
            [['fecha_inicio_contrato', 'fecha_desde', 'fecha_hasta', 'fecha_real_corte', 'fecha_creacion', 'usuariosistema'], 'safe'],
            [['total_devengado', 'total_deduccion', 'ibc_prestacional', 'ibc_no_pestacional', 'total_licencia', 'total_incapacidad', 'total_tiempo_extra', 'total_recargo'], 'number'],
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
        $query = ProgramacionNomina::find();

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
            'id_programacion' => $this->id_programacion,
            'id_grupo_pago' => $this->id_grupo_pago,
            'id_periodo_pago_nomina' => $this->id_periodo_pago_nomina,
            'id_contrato' => $this->id_contrato,
            'id_empleado' => $this->id_empleado,
            'cedula_empleado' => $this->cedula_empleado,
            'fecha_inicio_contrato' => $this->fecha_inicio_contrato,
            'fecha_desde' => $this->fecha_desde,
            'nro_pago' => $this->nro_pago,
            'total_devengado' => $this->total_devengado,
            'total_deduccion' => $this->total_deduccion,
            'ibc_prestacional' => $this->ibc_prestacional,
            'ibc_no_pestacional' => $this->ibc_no_pestacional,
            'total_licencia' => $this->total_licencia,
            'total_incapacidad' => $this->total_incapacidad,
            'total_tiempo_extra' => $this->total_tiempo_extra,
            'total_recargo' => $this->total_recargo,
            'fecha_hasta' => $this->fecha_hasta,
            'fecha_real_corte' => $this->fecha_real_corte,
            'fecha_creacion' => $this->fecha_creacion,
            'dias_pago' => $this->dias_pago,
            'estado_generado' => $this->estado_generado,
            'estado_liquidado' => $this->estado_liquidado,
            'estado_cerrado' => $this->estado_cerrado,
        ]);

        $query->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
