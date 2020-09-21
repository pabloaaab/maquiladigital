<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo_pago".
 *
 * @property int $id_grupo_pago
 * @property string $grupo_pago
 * @property int $estado
 * @property string $nombre_periodo
 * @property string $iddepartamento
 * @property string $idmunicipio
 * @property int $id_sucursal
 */
class PeriodoNomina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grupo_pago';
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ultimo_pago_prima', 'ultimo_pago_cesantia','grupo_pago','id_periodo_pago'], 'required', 'message' => 'Este campo no puede ser vacio'],
            [['estado', 'contador', 'ano', 'mes'], 'integer'],
            [['ultimo_pago_prima', 'ultimo_pago_cesantia', 'fecha_creacion', 'ultimo_pago_nomina'], 'safe'],
            [['grupo_pago'], 'string', 'max' => 60],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_grupo_pago' => 'Id Grupo Pago',
            'grupo_pago' => 'Grupo Pago',
            'id_periodo_pago' => 'Periodo',
            'ultimo_pago_nomina' =>'Ultimo_pago_nomina',
            'ultimo_pago_prima' => 'Ultima fecha prima',
            'ultimo_pago_cesantia' => 'Ultima fecha cesantia',
            'estado' => 'Estado',
            'contador' => 'contador',
            'ano' => 'Ano',
            'mes' => 'Mes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getPeriodoPago() {
        return $this->hasOne(PeriodoPago::className(), ['id_periodo_pago' => 'id_periodo_pago']);
    }
    public function getGrupopago()
    {
        return $this->hasOne(GrupoPago::className(), ['id_grupo_pago' => 'id_grupo_pago']);
    }
    public function getActivo()
    {
        if($this->estado == 1){
            $activo = "SI";
        }else{
            $activo = "NO";
        }
        return $activo;
    }
}
