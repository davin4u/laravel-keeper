<?php

namespace App\Repositories;

use App\Project;
use App\Validators\ProjectsValidator;

class ProjectsRepository
{

    protected $validator;

    public function __construct(ProjectsValidator $validator) {
        $this->validator = $validator;
    }

    public function create($data = [])
    {
        $this->validator->validate($data);

        return Project::create(array_merge($data, ['user_id' => auth()->user()->id]));
    }

    public function all()
    {
        return Project::where('user_id', auth()->user()->id)->get();
    }

    public function getById($id)
    {
        return Project::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->first();
    }

    public function delete($id)
    {
        return Project::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->delete();
    }

    public function update($id, $data = [])
    {
        $this->validator->validate($data);

        return Project::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->first()
                ->update($data);
    }
}
