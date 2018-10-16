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
 * @property int $idmunicipio
 * @property double $valorpagado
 * @property string $valorletras
 * @property int $idcliente
 * @property string $observacion
 * @property string $usuariosistema
 *
 * @property Tiporecibo $tiporecibo
 * @property Municipio $municipio
 * @property Cliente $cliente
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
            [['fecharecibo', 'fechapago', 'idtiporecibo', 'idmunicipio', 'valorpagado', 'valorletras', 'idcliente', 'observacion', 'usuariosistema'], 'required', 'message' => 'Campo requerido'],
            [['fecharecibo', 'fechapago'], 'safe'],
            [['idmunicipio', 'idcliente'], 'integer'],
            [['valorpagado'], 'number'],
            [['valorletras', 'observacion'], 'string'],
            [['idtiporecibo'], 'string', 'max' => 10],
            [['usuariosistema'], 'string', 'max' => 15],
            [['idtiporecibo'], 'exist', 'skipOnError' => true, 'targetClass' => Tiporecibo::className(), 'targetAttribute' => ['idtiporecibo' => 'idtiporecibo']],
            [['idmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idmunicipio' => 'idmunicipio']],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idcliente' => 'idcliente']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idrecibo' => 'Idrecibo:',
            'fecharecibo' => 'Fecha Recibo',
            'fechapago' => 'Fecha Pago:',
            'idtiporecibo' => 'Idtiporecibo:',
            'idmunicipio' => 'Idmunicipio:',
            'valorpagado' => 'Valor Pagado:',
            'valorletras' => 'Valor Letras:',
            'idcliente' => 'Idcliente:',
            'observacion' => 'Observación:',
            'usuariosistema' => 'Usuariosistema:',
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
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['idmunicipio' => 'idmunicipio']);
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
    public function getRecibocajadetalles()
    {
        return $this->hasMany(Recibocajadetalle::className(), ['idrecibo' => 'idrecibo']);
    }
	
		
}
