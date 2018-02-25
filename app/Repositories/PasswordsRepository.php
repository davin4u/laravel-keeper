<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

use App\Password;
use App\Validators\PasswordsValidator;
use App\Repositories\FilesRepository;

class PasswordsRepository
{

    protected $validator;

    public function __construct(PasswordsValidator $validator, FilesRepository $files) {
        $this->validator = $validator;
        $this->files = $files;
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

        $password = Password::create(array_merge(array_except($data, ['files']), ['user_id' => auth()->user()->id]));

        if (isset($data['files'])) {
            $password->atachFiles($data['files']);
        }

        auth()->user()->passwords()->attach($password->id);

        return $password;
    }

    public function delete($id)
    {
        $password = $this->getById($id);

        if (is_object($password)) {
            if ($password->removable()) {
                return $password->delete();
            }
        }

        return false;
    }

    public function update($id, $data = [])
    {
        $password = $this->getById($id);

        if (!is_object($password) || !$password->editable()) {
            return false;
        }

        $this->validator->validate(array_except($data, ['share_with', 'files']));

        $password->update(array_except($data, ['share_with', 'files']));

        if (isset($data['files'])) {
            $password->atachFiles($data['files']);
        }

        if (isset($data['share_with'])) {
            $this->sharePasswordWithUsers($id, $data['share_with'], true);
        }

        return $password;
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

    public function getLastViewed($limit = 5)
    {
      return auth()->user()->passwords()
                            ->orderBy('viewed_at', 'DESC')
                            ->offset(0)
                            ->take($limit)
                            ->get();
    }
}
