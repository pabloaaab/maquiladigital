<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
 * ProductoSearch represents the model behind the search form of `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproducto', 'cantidad', 'stock', 'costoconfeccion', 'vlrventa', 'idcliente', 'activo', 'idprendatipo', 'idtipo'], 'integer'],
            [['codigoproducto', 'producto', 'observacion', 'fechaproceso', 'usuariosistema'], 'safe'],
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
        $query = Producto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['idproducto' => SORT_DESC]] // Agregar esta linea para agregar el orden por defecto
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idproducto' => $this->idproducto,
            'cantidad' => $this->cantidad,
            'stock' => $this->stock,
            'costoconfeccion' => $this->costoconfeccion,
            'vlrventa' => $this->vlrventa,
            'idcliente' => $this->idcliente,
            'activo' => $this->activo,
            'fechaproceso' => $this->fechaproceso,
            'idprendatipo' => $this->idprendatipo,
            'idtipo' => $this->idtipo,
        ]);

        $query->andFilterWhere(['like', 'codigoproducto', $this->codigoproducto])
            ->andFilterWhere(['like', 'producto', $this->producto])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
