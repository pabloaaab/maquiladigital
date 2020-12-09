<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CostoProducto;

/**
 * CostoProductoSearch represents the model behind the search form of `app\models\CostoProducto`.
 */
class CostoProductoSearch extends CostoProducto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_producto', 'id_tipo_producto', 'costo_sin_iva', 'costo_con_iva'], 'integer'],
            [['codigo_producto', 'descripcion', 'fecha_creacion', 'usuariosistema'], 'safe'],
            [['porcentaje_iva'], 'number'],
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
        $query = CostoProducto::find();

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
            'id_producto' => $this->id_producto,
            'id_tipo_producto' => $this->id_tipo_producto,
            'fecha_creacion' => $this->fecha_creacion,
            'costo_sin_iva' => $this->costo_sin_iva,
            'costo_con_iva' => $this->costo_con_iva,
            'porcentaje_iva' => $this->porcentaje_iva,
        ]);

        $query->andFilterWhere(['like', 'codigo_producto', $this->codigo_producto])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
