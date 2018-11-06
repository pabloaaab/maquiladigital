<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recibocaja".
 *
 * @property int $idrecibo
 * @property string $fecharecibo
 * @property string $fechapago
 * @property string $idtiporecibo
 * @property string $idmunicipio
 * @property double $valorpagado
 * @property string $valorletras
 * @property int $idcliente
 * @property string $observacion
 * @property string $usuariosistema
 * @property string $estado
 * @property string $autorizado
 *
 * @property Tiporecibo $tiporecibo
 * @property Cliente $cliente
 * @property Municipio $municipio
 * @property Recibocajadetalle[] $recibocajadetalles
 */
class Recibocaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recibocaja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecharecibo', 'fechapago'], 'safe'],
            [['idtiporecibo', 'idmunicipio', 'idcliente'], 'required'],
            [['valorpagado'], 'number'],
            [['valorletras', 'observacion'], 'string'],
            [['idcliente','estado','autorizado'], 'integer'],
            [['idtiporecibo'], 'string', 'max' => 10],
            [['idmunicipio', 'usuariosistema'], 'string', 'max' => 15],
            [['idtiporecibo'], 'exist', 'skipOnError' => true, 'targetClass' => Tiporecibo::className(), 'targetAttribute' => ['idtiporecibo' => 'idtiporecibo']],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
            [['idmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idmunicipio' => 'idmunicipio']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idrecibo' => 'Id',
            'fecharecibo' => 'Fecha Recibo',
            'fechapago' => 'Fecha Pago',
            'idtiporecibo' => 'Tipo Recibo',
            'idmunicipio' => 'Municipio',
            'valorpagado' => 'Valor Pagado',
            'valorletras' => 'Valor Letras',
            'idcliente' => 'Cliente',
            'estado' => 'Estado',
            'autorizado' => 'Autorizado',
            'observacion' => 'Observacion',
            'usuariosistema' => 'Usuario Sistema',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiporecibo()
    {
        return $this->hasOne(Tiporecibo::className(), ['idtiporecibo' => 'idtiporecibo']);
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
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['idmunicipio' => 'idmunicipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecibocajadetalles()
    {
        return $this->hasMany(Recibocajadetalle::className(), ['idrecibo' => 'idrecibo']);
    }
}
