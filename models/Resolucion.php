<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "resolucion".
 *
 * @property int $idresolucion
 * @property string $nroresolucion
 * @property string $desde
 * @property string $hasta
 * @property string $fechavencimiento
 * @property string $nitmatricula
 * @property int $activo
 *
 * @property Matriculaempresa $nitmatricula0
 */
class Resolucion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resolucion';
    }	
	
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nroresolucion', 'desde', 'hasta', 'fechavencimiento', 'nitmatricula'], 'required'],

            ['fechavencimiento', 'default', 'value' => null],


            ['fechavencimiento', 'integer'],
            [['activo'], 'integer'],
            [['nroresolucion'], 'string', 'max' => 40],
            [['desde', 'hasta'], 'string', 'max' => 10],
            [['nitmatricula'], 'string', 'max' => 11],
            [['nitmatricula'], 'exist', 'skipOnError' => true, 'targetClass' => Matriculaempresa::className(), 'targetAttribute' => ['nitmatricula' => 'nitmatricula']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idresolucion' => 'Código:',
            'nroresolucion' => 'Nro Resolución',
            'desde' => 'Desde:',
            'hasta' => 'Hasta:',
            'fechavencimiento' => 'Fecha Vencimiento:',
            'nitmatricula' => 'Nit/Matricula:',
            'activo' => 'Activo:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNitmatricula0()
    {
        return $this->hasOne(Matriculaempresa::className(), ['nitmatricula' => 'nitmatricula']);
    }
}
