<?php

namespace App\Repositories;

use App\PasswordGroup;
use Illuminate\Support\Facades\Auth;

class PasswordGroupsRepository
{
    /**
     * @param $data
     * @return |null
     */
    public function create($data)
    {
        try {
            $group = PasswordGroup::create(array_merge($data, [
                'user_id' => Auth::user()->id
            ]));

            return $group;
        }
        catch (\Exception $e) {
            return null;
        }
    }
}