<?php

namespace app\forms;

use Yii;
use yii\base\Model;

/**
 * Fomulario para enviar el password
 */
class ValidateForm extends Model
{
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['password'], 'required'],
        ];
    }
}