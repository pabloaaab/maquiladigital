<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tiporecibo".
 *
 * @property string $idtiporecibo
 * @property string $concepto
 * @property int $activo
 */
class TipoRecibo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiporecibo';
    }
	
	public function beforeSave($insert) {
	if(!parent::beforeSave($insert)){
            return false;
        }	       
	$this->concepto = strtoupper($this->concepto);
	
    return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtiporecibo', 'concepto'], 'required'],
            [['activo'], 'integer'],
            [['idtiporecibo'], 'string', 'max' => 10],
            [['concepto'], 'string', 'max' => 30],
            [['idtiporecibo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtiporecibo' => 'Idtiporecibo',
            'concepto' => 'Concepto',
            'activo' => 'Activo',
        ];
    }
}
