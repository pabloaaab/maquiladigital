<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ConfiguracionPensionSearch;
use app\models\ConfiguracionPension;


/**
 * ConfiguracionpensionSearch represents the model behind the search form of `app\models\Configuracionpension`.
 */
class ConfiguracionPensionSearch extends ConfiguracionPension
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pension', 'codigo_salario'], 'integer'],
            [['porcentaje_empleado', 'porcentaje_empleador'], 'number'],
            [['concepto'], 'string', 'max' => 30],
            ['concepto', 'match', 'pattern' => '/^[a-zA-Z]+$/i', 'message' => 'Sólo se aceptan letras'],
           
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
        $query = ConfiguracionPension::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_pension' => SORT_ASC]] // Agregar esta linea para agregar el orden por defecto
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pension' => $this->id_pension,
            'codigo_salario' => $this->codigo_salario,
            'concepto' => $this->concepto,
            'porcentaje_empleado' => $this->porcentaje_empleado,
             'porcentaje_empleador' => $this->porcentaje_empleador,
        ]);
         $query->andFilterWhere(['like', 'id_pension', $this->id_pension]);
         $query->andFilterWhere(['like', 'codigo_salario', $this->codigo_salario]);
         $query->andFilterWhere(['like', 'concepto', $this->concepto]);
         $query->andFilterWhere(['like', 'porcentaje_empleado', $this->porcentaje_empleado]);
         $query->andFilterWhere(['like', 'porcentaje_empleador', $this->porcentaje_empleador]);

        return $dataProvider;
    }
}
