<?php

namespace App\Validators;

class ProjectsValidator
{

    public function validate($data)
    {
        validator($data, [
            'name' => 'required|max:190',
            'url' => 'url|max:190'
        ])->validate();
    }

}
