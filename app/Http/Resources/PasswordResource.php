<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PasswordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'password' => '********',
            'project' => new ProjectResource($this->project),
            'decrypted_password' => $this->decryptedPassword
        ];
    }
}
