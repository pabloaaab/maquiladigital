<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Licencia;

/**
 * LicenciaSearch represents the model behind the search form of `app\models\Licencia`.
 */
class LicenciaSearch extends Licencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_licencia_pk', 'codigo_licencia', 'id_empleado', 'id_contrato', 'id_grupo_pago', 'dias_licencia', 'afecta_transporte', 'cobrar_administradora', 'aplicar_adicional', 'pagar_empleado','identificacion'], 'integer'],
            [['fecha_desde', 'fecha_hasta', 'fecha_proceso', 'fecha_aplicacion', 'observacion', 'usuariosistema'], 'safe'],
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
        $query = Licencia::find();

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
            'id_licencia_pk' => $this->id_licencia_pk,
            'codigo_licencia' => $this->codigo_licencia,
            'id_empleado' => $this->id_empleado,
            'id_contrato' => $this->id_contrato,
            'id_grupo_pago' => $this->id_grupo_pago,
            'fecha_desde' => $this->fecha_desde,
            'fecha_hasta' => $this->fecha_hasta,
            'fecha_proceso' => $this->fecha_proceso,
            'fecha_aplicacion' => $this->fecha_aplicacion,
            'dias_licencia' => $this->dias_licencia,
            'afecta_transporte' => $this->afecta_transporte,
            'cobrar_administradora' => $this->cobrar_administradora,
            'aplicar_adicional' => $this->aplicar_adicional,
            'pagar_empleado' => $this->pagar_empleado,
        ]);

        $query->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
