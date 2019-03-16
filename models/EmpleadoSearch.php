<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empleado;

/**
 * EmpleadoSearch represents the model behind the search form of `app\models\Empleado`.
 */
class EmpleadoSearch extends Empleado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empleado', 'id_empleado_tipo', 'identificacion', 'dv', 'contrato'], 'integer'],
            [['nombre1', 'nombre2', 'apellido1', 'apellido2', 'nombrecorto', 'direccion', 'telefono', 'celular', 'email', 'iddepartamento', 'idmunicipio', 'observacion', 'fechaingreso', 'fecharetiro'], 'safe'],
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
        $query = Empleado::find();

        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_empleado' => SORT_DESC]] // Agregar esta linea para agregar el orden por defecto
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_empleado' => $this->id_empleado,
            'id_empleado_tipo' => $this->id_empleado_tipo,
            'identificacion' => $this->identificacion,
            'celular' => $this->celular,
            'dv' => $this->dv,
            'contrato' => $this->contrato,
            'fechaingreso' => $this->fechaingreso,
            'fecharetiro' => $this->fecharetiro,
        ]);

        $query->andFilterWhere(['like', 'nombre1', $this->nombre1])
            ->andFilterWhere(['like', 'nombre2', $this->nombre2])
            ->andFilterWhere(['like', 'apellido1', $this->apellido1])
            ->andFilterWhere(['like', 'apellido2', $this->apellido2])
            ->andFilterWhere(['like', 'nombrecorto', $this->nombrecorto])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'celular', $this->celular])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'iddepartamento', $this->iddepartamento])
            ->andFilterWhere(['like', 'idmunicipio', $this->idmunicipio])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
