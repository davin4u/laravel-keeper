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
        $this->validator->validate(array_except($data, ['files']));

        $project = Project::create(array_merge(array_except($data, ['files']), ['user_id' => auth()->user()->id]));

        if (isset($data['files'])) {
            $project->atachFiles($data['files']);
        }

        return $project;
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
        $this->validator->validate(array_except($data, ['files']));

        $project = $this->getById($id);

        if (!empty($project)) {
            $project->update(array_except($data, ['files']));

            if (isset($data['files'])) {
                $project->atachFiles($data['files']);
            }
        }

        return $project;
    }
}
