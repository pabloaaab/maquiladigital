<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstudioEmpleado;

/**
 * EstudioEmpleadoSearch represents the model behind the search form of `app\models\EstudioEmpleado`.
 */
class EstudioEmpleadoSearch extends EstudioEmpleado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_empleado', 'documento', 'id_tipo_estudio', 'anio_cursado', 'graduado', 'validar_vencimiento'], 'integer'],
            [['idmunicipio', 'institucion_educativa', 'titulo_obtenido', 'fecha_inicio', 'fecha_terminacion', 'fecha_vencimiento', 'registro', 'observacion'], 'safe'],
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
        $query = EstudioEmpleado::find();

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
            'id' => $this->id,
            'id_empleado' => $this->id_empleado,
            'documento' => $this->documento,
            'id_tipo_estudio' => $this->id_tipo_estudio,
            'anio_cursado' => $this->anio_cursado,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_terminacion' => $this->fecha_terminacion,
            'graduado' => $this->graduado,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'validar_vencimiento' => $this->validar_vencimiento,
        ]);

        $query->andFilterWhere(['like', 'idmunicipio', $this->idmunicipio])
            ->andFilterWhere(['like', 'institucion_educativa', $this->institucion_educativa])
            ->andFilterWhere(['like', 'titulo_obtenido', $this->titulo_obtenido])
            ->andFilterWhere(['like', 'registro', $this->registro])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
