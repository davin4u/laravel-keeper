<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Password;
use App\PasswordType;
use App\User;

use App\Repositories\PasswordsRepository;
use App\Repositories\ProjectsRepository;

class PasswordsController extends Controller
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
    return view('passwords.index', [
      'passwords' => $this->passwords->all()
    ]);
  }

  public function projectPasswordsList(Project $project)
  {
    return view('passwords.index', [
      'passwords' => $this->passwords->getProjectPasswords($project->id),
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
    $password = $this->passwords->create(request([
      'project_id',
      'type',
      'name',
      'username',
      'password',
      'full_description'
    ]));

    return redirect(route('passwords_edit', ['id' => $password->id]));
  }

  public function edit($id)
  {
    $password = $this->passwords->getById($id);

    if (is_object($password)) {
      $password->updateViewed();
    }

    return view('passwords.edit', [
      'projects' => $this->projects->all(),
      'password' => $password,
      'password_types' => PasswordType::all(),
      'users' => $password->user_id == auth()->user()->id ? User::where('id', '<>', auth()->user()->id)->get() : []
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
      'full_description',
      'share_with'
    ]));

    return redirect('passwords');
  }

  public function delete($id)
  {
    $this->passwords->delete($id);

    return redirect('passwords');
  }
}
