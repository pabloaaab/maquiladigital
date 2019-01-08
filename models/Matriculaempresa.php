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
 * @property int $id_tipo_regimen
 * @property string $declaracion
 * @property int $id_banco_factura
 * @property int $idresolucion
 *
 * @property Banco $bancoFactura
 * @property TipoRegimen $tipoRegimen
 * @property Departamento $departamento
 * @property Municipio $municipio
 * @property Resolucion $resolucion
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
            [['nitmatricula', 'dv', 'razonsocialmatricula', 'nombrematricula', 'apellidomatricula', 'direccionmatricula', 'telefonomatricula', 'celularmatricula', 'emailmatricula', 'iddepartamento', 'idmunicipio', 'paginaweb', 'id_tipo_regimen', 'declaracion', 'idresolucion'], 'required'],
            [['dv', 'id_tipo_regimen', 'id_banco_factura', 'idresolucion'], 'integer'],
            [['porcentajeiva', 'porcentajeretefuente', 'retefuente', 'porcentajereteiva'], 'number'],
            [['declaracion'], 'string'],
            [['nitmatricula', 'telefonomatricula', 'celularmatricula', 'iddepartamento', 'idmunicipio'], 'string', 'max' => 15],
            [['razonsocialmatricula', 'nombrematricula', 'apellidomatricula', 'direccionmatricula', 'emailmatricula', 'paginaweb'], 'string', 'max' => 40],
            [['nitmatricula'], 'unique'],
            [['id_banco_factura'], 'exist', 'skipOnError' => true, 'targetClass' => Banco::className(), 'targetAttribute' => ['id_banco_factura' => 'idbanco']],
            [['id_tipo_regimen'], 'exist', 'skipOnError' => true, 'targetClass' => TipoRegimen::className(), 'targetAttribute' => ['id_tipo_regimen' => 'id_tipo_regimen']],
            [['iddepartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['iddepartamento' => 'iddepartamento']],
            [['idmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idmunicipio' => 'idmunicipio']],
            [['idresolucion'], 'exist', 'skipOnError' => true, 'targetClass' => Resolucion::className(), 'targetAttribute' => ['idresolucion' => 'idresolucion']],
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
            'id_tipo_regimen' => 'Id Tipo Regimen',
            'declaracion' => 'Declaracion',
            'id_banco_factura' => 'Id Banco Factura',
            'idresolucion' => 'Idresolucion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBancoFactura()
    {
        return $this->hasOne(Banco::className(), ['idbanco' => 'id_banco_factura']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoRegimen()
    {
        return $this->hasOne(TipoRegimen::className(), ['id_tipo_regimen' => 'id_tipo_regimen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['iddepartamento' => 'iddepartamento']);
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
    public function getResolucion()
    {
        return $this->hasOne(Resolucion::className(), ['idresolucion' => 'idresolucion']);
    }
}
