<?php

namespace App\Validators;

class ProjectsValidator
{

    public function validate($data)
    {
        $validator = validator($data, [
            'name' => 'required|max:190',
        ]);

        $validator->sometimes('url', 'url|max:190', function($input) {
          return !empty($input->url);
        });

        $validator->validate();
    }

}
