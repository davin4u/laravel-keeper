<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'sometimes|exists:\App\Project,id',
            'group_id' => 'sometimes|exists:\App\PasswordGroup,id',
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'password' => 'required|max:100',
            'full_description' => 'max:1000'
        ];
    }
}
