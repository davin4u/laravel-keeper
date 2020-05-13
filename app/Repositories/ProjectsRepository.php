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
        try {
            $project = Project::create(array_merge($data, [
                'user_id' => Auth::user()->id
            ]));
        }
        catch (\Exception $e) {
            return null;
        }

        return $project;
    }

    /**
     * @param $id
     * @param $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        if ($project = $this->getById($id)) {
            $project->update($data);

            return true;
        }

        return false;
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
    public function getById(int $id)
    {
        return Project::where('user_id', Auth::user()->id)
                ->where('id', $id)
                ->first();
    }

    /**
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        if ($project = $this->getById($id)) {
            $project->delete();

            return true;
        }

        return false;
    }
}
