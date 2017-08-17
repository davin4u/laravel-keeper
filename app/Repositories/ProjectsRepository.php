<?php

namespace App\Repositories;

use App\Project;

class ProjectsRepository
{
    public function create($data = [])
    {
        return Project::create(array_merge($data, ['user_id' => auth()->user()->id]));
    }

    public function all()
    {
        return Project::all();
    }

    public function getById($id)
    {
        return Project::find($id);
    }

    public function delete($id)
    {
        Project::delete($id);
    }
}
