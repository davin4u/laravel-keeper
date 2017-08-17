<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

use App\Password;

class PasswordsRepository
{

    public function all()
    {
        return Password::where('user_id', auth()->user()->id)->get();
    }

    public function getById($id)
    {
        return Password::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->get();
    }

    /**
     * @todo create some password protection instead of keeping password in the database
     * @param mixed $data
     * @return App\Password
     */
    public function create($data = [])
    {
        return Password::create(array_merge($data, ['user_id' => auth()->user()->id]));
    }

    public function delete($id)
    {
        return Password::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->delete();
    }
}
