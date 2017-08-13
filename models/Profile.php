<?php

namespace app\models;

class Profile extends \dektrium\user\models\Profile
{
    public function rules()
    {
        $rules = parent::rules();
        // add some rules
        $rules['email_massageLength'] = ['email_massage', 'integer'];
        $rules['broweserMassage']   = ['broweser_massage', 'integer'];
        return $rules;
    }
}
