<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name
        ];

        if ($this->id === Auth::user()->id) {
            $data['password_groups'] = $this->passwordGroups;
            $data['projects'] = new ProjectsCollection($this->projects);
            $data['passwords'] = new PasswordsCollection($this->passwords);
        }

        return $data;
    }
}
