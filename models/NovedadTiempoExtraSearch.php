<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NovedadTiempoExtra;

/**
 * NovedadTiempoExtraSearch represents the model behind the search form of `app\models\NovedadTiempoExtra`.
 */
class NovedadTiempoExtraSearch extends NovedadTiempoExtra
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_novedad', 'id_empleado', 'codigo_salario', 'id_periodo_pago_nomina', 'id_grupo_pago'], 'integer'],
            [['fecha_inicio', 'fecha_corte', 'fecha_creacion', 'usuariosistema'], 'safe'],
            [['vlr_hora', 'nro_horas', 'total_novedad'], 'number'],
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
        $query = NovedadTiempoExtra::find();

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
            'id_novedad' => $this->id_novedad,
            'id_empleado' => $this->id_empleado,
            'codigo_salario' => $this->codigo_salario,
            'id_periodo_pago_nomina' => $this->id_periodo_pago_nomina,
            'id_grupo_pago' => $this->id_grupo_pago,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_corte' => $this->fecha_corte,
            'fecha_creacion' => $this->fecha_creacion,
            'vlr_hora' => $this->vlr_hora,
            'nro_horas' => $this->nro_horas,
            'total_novedad' => $this->total_novedad,
        ]);

        $query->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
