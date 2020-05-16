<?php

namespace App\Repositories;

use App\PasswordGroup;
use Illuminate\Support\Facades\Auth;

class PasswordGroupsRepository
{
    /**
     * @param array $data
     * @return |null
     */
    public function create(array $data)
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

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        if ($group = $this->findById($id)) {
            $group->update($data);

            return true;
        }

        return false;
    }

    /**
     * @param int $id
     * @return PasswordGroup|null
     */
    public function findById(int $id)
    {
        return PasswordGroup::where('user_id', Auth::user()->id)->where('id', $id)->first();
    }
}