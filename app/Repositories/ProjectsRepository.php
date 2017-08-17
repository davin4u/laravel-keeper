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
}
