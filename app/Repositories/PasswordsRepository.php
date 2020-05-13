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
    public function create(array $data = [])
    {
        try {
            $password = Password::create(array_merge($data, [
                'user_id' => Auth::user()->id
            ]));
        }
        catch (\Exception $e) {
            return null;
        }

        return $password;
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        if ($password = $this->getById($id)) {
            $password->update($data);

            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return \App\Password|null
     */
    public function getById(int $id)
    {
        return Password::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->first();
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        if ($password = $this->getById($id)) {
            $password->delete();

            return true;
        }

        return false;
    }
}
