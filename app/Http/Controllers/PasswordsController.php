<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Password;

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

    public function create()
    {
        return view('passwords.create', [
            'projects' => $this->projects->all()
        ]);
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|max:190',
            'project_id' => 'required',
            'username' => 'max:190',
            'password' => 'max:190'
        ]);

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
}
