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
            'project' => new ProjectResource($this->project),
            'group' => new PasswordGroupResource($this->group),
            'decrypted_password' => $this->decryptedPassword,
            'full_description' => $this->full_description
        ];
    }
}
