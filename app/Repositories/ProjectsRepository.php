<?php

namespace App\Repositories;

use App\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProjectsRepository
 * @package App\Repositories
 */
class ProjectsRepository
{
    /**
     * @param array $data
     * @return Project|null
     */
    public function create(array $data)
    {
        $data['user_id'] = Auth::user()->id;

        try {
            $project = Project::create($data);
        }
        catch (\Exception $e) {
            return null;
        }

        return $project;
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return Project::where('user_id', Auth::user()->id)->get();
    }

    /**
     * @param $id
     * @return Project|null
     */
    public function getById($id)
    {
        return Project::where('user_id', Auth::user()->id)
                ->where('id', $id)
                ->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return Project::where('user_id', Auth::user()->id)
                ->where('id', $id)
                ->delete();
    }
}
