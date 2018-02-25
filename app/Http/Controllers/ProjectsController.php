<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Project;
use App\Password;

use App\Repositories\PasswordsRepository;
use App\Repositories\ProjectsRepository;

class ProjectsController extends Controller
{
    protected $projects;
    protected $passwords;

    public function __construct(ProjectsRepository $projects, PasswordsRepository $passwords)
    {
        $this->middleware('auth');

        $this->projects = $projects;
        $this->passwords = $passwords;
    }

    public function index()
    {
        return view('projects.index', [
            'projects' => $this->projects->all()
        ]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $project = $this->projects->create(request([
            'name',
            'url',
            'short_description',
            'full_description',
            'files'
        ]));

        return redirect(route('projects_edit', ['id' => $project->id]));
    }

    public function edit($id)
    {
        $project = $this->projects->getById($id);

        return view('projects.edit', [
            'project' => $project,
            'files' => $project->files()
        ]);
    }

    public function delete($id)
    {
        $this->projects->delete($id);

        return redirect('projects');
    }

    public function update($id)
    {
        $this->projects->update($id, request([
            'name',
            'url',
            'short_description',
            'full_description',
            'files'
        ]));

        return redirect('projects');
    }

}
