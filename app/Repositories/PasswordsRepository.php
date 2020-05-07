<?php

namespace App\Repositories;

use App\Password;
use Illuminate\Support\Facades\Auth;

/**
 * Class PasswordsRepository
 * @package App\Repositories
 */
class PasswordsRepository
{
    /**
     * @param array $data
     * @return Password|null
     */
    public function create($data = [])
    {
        $data['user_id'] = Auth::user()->id;

        try {
            $password = Password::create($data);
        }
        catch (\Exception $e) {
            return null;
        }

        Auth::user()->passwords()->attach($password->id);

        return $password;
    }
}
