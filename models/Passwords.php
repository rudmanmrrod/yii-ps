<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "passwords".
 *
 * @property integer $pkpassword
 * @property string $descripcion
 * @property string $password
 * @property string $creado_en
 * @property string $actualizado_en
 * @property integer $fkuser
 *
 * @property User $fkuser0
 */
class Passwords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'passwords';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'password', 'creado_en', 'actualizado_en', 'fkuser'], 'required'],
            [['descripcion'], 'string'],
            [['creado_en', 'actualizado_en','password'], 'safe'],
            [['fkuser'], 'integer'],
            [['password'], 'string', 'max' => 255],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fkuser' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkpassword' => 'Pkpassword',
            'descripcion' => 'Descripcion',
            'password' => 'Password',
            'creado_en' => 'Creado En',
            'actualizado_en' => 'Actualizado En',
            'fkuser' => 'Fkuser',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkuser0()
    {
        return $this->hasOne(User::className(), ['id' => 'fkuser']);
    }
}
