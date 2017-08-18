<?php

namespace App\Validators;

class PasswordsValidator
{

    public function validate($data)
    {
        validator($data, [
            'name' => 'required|max:190',
            'project_id' => 'required',
            'username' => 'max:190',
            'password' => 'max:190'
        ])->validate();
    }

}
