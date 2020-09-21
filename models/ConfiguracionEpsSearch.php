<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ConfiguracionEpsSearch;
use app\models\ConfiguracionEps;


/**
 * ConfiguracionpensionSearch represents the model behind the search form of `app\models\Configuracionpension`.
 */
class ConfiguracionEpsSearch extends ConfiguracionEps
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_eps', 'codigo_salario'], 'integer'],
            [['porcentaje_empleado_eps', 'porcentaje_empleador_eps'], 'number'],
            [['concepto_eps'], 'string', 'max' => 30],
            ['concepto_eps', 'match', 'pattern' => '/^[a-zA-Z]+$/i', 'message' => 'Sólo se aceptan letras'],
           
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
        $query = ConfiguracionEps::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_eps' => SORT_ASC]] // Agregar esta linea para agregar el orden por defecto
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_eps' => $this->id_eps,
            'codigo_salario' => $this->codigo_salario,
            'concepto_eps' => $this->concepto_eps,
            'porcentaje_empleado_eps' => $this->porcentaje_empleado_eps,
             'porcentaje_empleador_eps' => $this->porcentaje_empleador_eps,
        ]);
         $query->andFilterWhere(['like', 'id_eps', $this->id_eps]);
         $query->andFilterWhere(['like', 'codigo_salario', $this->codigo_salario]);
         $query->andFilterWhere(['like', 'concepto_eps', $this->concepto_eps]);
         $query->andFilterWhere(['like', 'porcentaje_empleado_eps', $this->porcentaje_empleado_eps]);
         $query->andFilterWhere(['like', 'porcentaje_empleador_eps', $this->porcentaje_empleador_eps]);

        return $dataProvider;
    }
}
