<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notacredito".
 *
 * @property int $idnotacredito
 * @property int $idcliente
 * @property string $fecha
 * @property string $fechapago
 * @property int $idconceptonota
 * @property double $valor
 * @property int $numero
 * @property int $autorizado
 * @property int $anulado
 * @property string $usuariosistema
 * @property string $observacion
 *
 * @property Cliente $cliente
 * @property Conceptonota $conceptonota
 */
class Notacredito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notacredito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcliente', 'idconceptonota'], 'required'],
            [['idcliente', 'idconceptonota', 'numero', 'autorizado', 'anulado'], 'integer'],
            [['fecha', 'fechapago'], 'safe'],
            [['valor'], 'number'],
            [['observacion'], 'string'],
            [['usuariosistema'], 'string', 'max' => 50],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idconceptonota'], 'exist', 'skipOnError' => true, 'targetClass' => Conceptonota::className(), 'targetAttribute' => ['idconceptonota' => 'idconceptonota']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idnotacredito' => 'Id',
            'idcliente' => 'Cliente',
            'fecha' => 'Fecha',
            'fechapago' => 'Fechapago',
            'idconceptonota' => 'Concepto',
            'valor' => 'Valor',
            'numero' => 'Numero',
            'autorizado' => 'Autorizado',
            'anulado' => 'Anulado',
            'usuariosistema' => 'Usuariosistema',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['idcliente' => 'idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConceptonota()
    {
        return $this->hasOne(Conceptonota::className(), ['idconceptonota' => 'idconceptonota']);
    }
}
