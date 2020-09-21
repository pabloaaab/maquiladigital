<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Incapacidad;

/**
 * IncapacidadSearch represents the model behind the search form of `app\models\Incapacidad`.
 */
class IncapacidadSearch extends Incapacidad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_incapacidad', 'codigo_incapacidad', 'id_empleado', 'identificacion', 'id_contrato', 'id_grupo_pago', 'id_codigo', 'numero_incapacidad','dias_incapacidad', 'dias_cobro_eps','dias_cobro_eps', 'transcripcion', 'cobrar_administradora','aplicar_adicional','pagar_empleado', 'id_entidad_salud', 'prorroga','numero_incapacidad'], 'integer'],
            [['fecha_inicio', 'fecha_final','fecha_documento_fisico','fecha_aplicacion','fecha_creacion', 'fecha_inicio_empresa', 'fecha_final_empresa', 'fecha_inicio_administradora', 'fecha_final_administradora'], 'safe'],
            [['salario_mes_anterior', 'salario', 'vlr_liquidado', 'porcentaje_pago', 'vlr_cobro_administradora', 'vlr_saldo_administrador', 'dias_administradora', 'dias_empresa', 'dias_acumulados', 'vlr_hora'], 'number'],
            [['codigo_diagnostico','nombre_medico','observacion','usuariosistema'], 'string'],
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
        $query = Incapacidad::find();

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
            'id_incapacidad' => $this->id_incapacidad,
            'codigo_incapacidad' => $this->codigo_incapacidad,
            'id_empleado' => $this->id_empleado,
            'identificacion' => $this->identificacion,
            'id_contrato' => $this->id_contrato,
            'id_grupo_pago' => $this->id_grupo_pago,
            'id_codigo' => $this->id_codigo,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_final' => $this->fecha_final,
            'fecha_creacion' => $this->fecha_creacion,
            'dias_incapacidad' => $this->dias_incapacidad,
            'salario_mes_anterior' => $this->salario_mes_anterior,
            'salario' => $this->salario,
            'vlr_liquidado' => $this->vlr_liquidado,
            'porcentaje_pago' => $this->porcentaje_pago,
            'dias_cobro_eps' => $this->dias_cobro_eps,
            'vlr_cobro_administradora' => $this->vlr_cobro_administradora,
            'pagar_empleado' => $this->pagar_empleado,
            'vlr_saldo_administrador' => $this->vlr_saldo_administrador,
            'id_entidad_salud' => $this->id_entidad_salud,
            'prorroga' => $this->prorroga,
            'fecha_inicio_empresa' => $this->fecha_inicio_empresa,
            'fecha_final_empresa' => $this->fecha_final_empresa,
            'fecha_inicio_administradora' => $this->fecha_inicio_administradora,
            'fecha_final_administradora' => $this->fecha_final_administradora,
            'dias_administradora' => $this->dias_administradora,
            'dias_empresa' => $this->dias_empresa,
            'dias_acumulados' => $this->dias_acumulados,
            'vlr_hora' => $this->vlr_hora,
        ]);

        $query->andFilterWhere(['like', 'numero_incapacidad', $this->numero_incapacidad])
            ->andFilterWhere(['like', 'nombre_medico', $this->nombre_medico])
            ->andFilterWhere(['like', 'usuariosistema', $this->usuariosistema]);

        return $dataProvider;
    }
}
