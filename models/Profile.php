<?php

namespace app\models;

class User extends \dektrium\user\models\User
{
    public function rules()
    {
        $rules = parent::rules();
        // add some rules
        $rules['emailMassageLength'] = ['email_massage', 'integer'];
        $rules['broweserMassage']   = ['broweser_massage', 'integer'];
        return $rules;
    }
}
