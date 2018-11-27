<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "matriculaempresa".
 *
 * @property string $nitmatricula
 * @property int $dv
 * @property string $razonsocialmatricula
 * @property string $nombrematricula
 * @property string $apellidomatricula
 * @property string $direccionmatricula
 * @property string $telefonomatricula
 * @property string $celularmatricula
 * @property string $emailmatricula
 * @property string $iddepartamento
 * @property string $idmunicipio
 * @property string $paginaweb
 * @property double $porcentajeiva
 * @property double $porcentajeretefuente
 * @property double $retefuente
 * @property double $porcentajereteiva
 * @property double $tiporegimen
 *
 * @property Resolucion[] $resolucions
 */
class Matriculaempresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'matriculaempresa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nitmatricula', 'dv', 'razonsocialmatricula', 'nombrematricula', 'apellidomatricula', 'direccionmatricula', 'telefonomatricula', 'celularmatricula', 'emailmatricula', 'iddepartamento', 'idmunicipio', 'paginaweb'], 'required'],
            [['dv'], 'integer'],
            [['porcentajeiva', 'porcentajeretefuente', 'retefuente', 'porcentajereteiva'], 'number'],
            [['nitmatricula', 'telefonomatricula', 'celularmatricula', 'iddepartamento', 'idmunicipio','tiporegimen'], 'string', 'max' => 100],
            [['razonsocialmatricula', 'nombrematricula', 'apellidomatricula', 'direccionmatricula', 'emailmatricula', 'paginaweb'], 'string', 'max' => 40],
            [['nitmatricula'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nitmatricula' => 'Nitmatricula',
            'dv' => 'Dv',
            'razonsocialmatricula' => 'Razonsocialmatricula',
            'nombrematricula' => 'Nombrematricula',
            'apellidomatricula' => 'Apellidomatricula',
            'direccionmatricula' => 'Direccionmatricula',
            'telefonomatricula' => 'Telefonomatricula',
            'celularmatricula' => 'Celularmatricula',
            'emailmatricula' => 'Emailmatricula',
            'iddepartamento' => 'Iddepartamento',
            'idmunicipio' => 'Idmunicipio',
            'paginaweb' => 'Paginaweb',
            'porcentajeiva' => 'Porcentajeiva',
            'porcentajeretefuente' => 'Porcentajeretefuente',
            'retefuente' => 'Retefuente',
            'porcentajereteiva' => 'Porcentajereteiva',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResolucions()
    {
        return $this->hasMany(Resolucion::className(), ['nitmatricula' => 'nitmatricula']);
    }
}
