<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Password;
use App\PasswordType;

use App\Repositories\PasswordsRepository;
use App\Repositories\ProjectsRepository;

class PasswordsController extends Controller
{
    protected $projects;
    protected $passwords;

    public function __construct(ProjectsRepository $projects, PasswordsRepository $passwords)
    {
        $this->projects = $projects;
        $this->passwords = $passwords;
    }

    public function index()
    {
        return view('passwords.index', [
            'passwords' => $this->passwords->all()
        ]);
    }

    public function projectPasswordsList(Project $project)
    {
        return view('passwords.index', [
            'passwords' => $project->passwords()->get(),
            'project' => $project
        ]);
    }

    public function create()
    {
        return view('passwords.create', [
            'projects' => $this->projects->all(),
            'password_types' => PasswordType::all()
        ]);
    }

    public function store()
    {
        $this->passwords->create(request([
            'project_id',
            'type',
            'name',
            'username',
            'password',
            'full_description'
        ]));

        return redirect('passwords');
    }

    public function edit($id)
    {
        return view('passwords.edit', [
            'projects' => $this->projects->all(),
            'password' => $this->passwords->getById($id),
            'password_types' => PasswordType::all()
        ]);
    }

    public function update($id)
    {
        $this->passwords->update($id, request([
            'project_id',
            'type',
            'name',
            'username',
            'password',
            'full_description'
        ]));

        return redirect('passwords');
    }

    public function delete($id)
    {
        $this->passwords->delete($id);

        return redirect('passwords');
    }
}
