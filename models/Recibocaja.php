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
            [['fecharecibo', 'fechapago', 'idtiporecibo', 'idmunicipio', 'valorpagado', 'valorletras', 'idcliente', 'observacion', 'usuariosistema'], 'required'],
            [['fecharecibo', 'fechapago'], 'safe'],
            [['idmunicipio', 'idcliente'], 'integer'],
            [['valorpagado'], 'number'],
            [['valorletras', 'observacion'], 'string'],
            [['idtiporecibo'], 'string', 'max' => 10],
            [['usuariosistema'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idrecibo' => 'Idrecibo',
            'fecharecibo' => 'Fecharecibo',
            'fechapago' => 'Fechapago',
            'idtiporecibo' => 'Idtiporecibo',
            'idmunicipio' => 'Idmunicipio',
            'valorpagado' => 'Valorpagado',
            'valorletras' => 'Valorletras',
            'idcliente' => 'Idcliente',
            'observacion' => 'Observacion',
            'usuariosistema' => 'Usuariosistema',
        ];
    }
}
