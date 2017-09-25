<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

use App\Password;
use App\Validators\PasswordsValidator;

class PasswordsRepository
{

    protected $validator;

    public function __construct(PasswordsValidator $validator) {
        $this->validator = $validator;
    }

    public function all()
    {
        return auth()->user()->passwords()->get();
    }

    public function getById($id)
    {
        return auth()->user()->passwords()->wherePivot('password_id', $id)->first();
    }

    /**
     * @todo create some password protection instead of keeping password in the database
     * @param mixed $data
     * @return App\Password
     */
    public function create($data = [])
    {
        $this->validator->validate($data);

        $password = Password::create(array_merge($data, ['user_id' => auth()->user()->id]));

        auth()->user()->passwords()->attach($password->id);

        return $password;
    }

    public function delete($id)
    {
        return Password::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->delete();
    }

    public function update($id, $data = [])
    {
        $shareWith = [];

        if (isset($data['share_with'])) {
            $shareWith = $data['share_with'];
            unset($data['share_with']);
        }

        $this->validator->validate($data);

        $update = Password::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->first()
                ->update($data);

        if ($update) {
            $this->sharePasswordWithUsers($id, $shareWith, true);
        }

        return $update;
    }

    public function getProjectPasswords($projectId)
    {
        $passwordsIds = auth()->user()->passwords()->pluck('password_id')->toArray();

        if (!empty($passwordsIds)) {
            return Password::where('project_id', $projectId)
                    ->whereIn('id', $passwordsIds)->get();
        }

        return [];
    }

    public function sharePasswordWithUsers($passwordId, $shareWith = [], $sync = false)
    {
        $password = $this->getById($passwordId);

        if ($password) {
            if (!in_array($password->user_id, $shareWith)) {
                $shareWith[] = $password->user_id;
            }

            if ($sync) {
                $password->users()->sync($shareWith);
            }
            else {
                $password->users()->attach($shareWith);
            }
        }
    }
}
