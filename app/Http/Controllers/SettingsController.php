<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PasswordType;
use App\Repositories\PasswordTypesRepository;

class SettingsController extends Controller
{

  protected $passwordTypes;

  public function __construct(PasswordTypesRepository $passwordTypes)
  {
    $this->passwordTypes = $passwordTypes;
  }

  public function index()
  {
    return view('settings.password_types.index', [
      'types' => $this->passwordTypes->all()
    ]);
  }

  public function edit($id)
  {
    $type = $this->passwordTypes->getById($id);

    if (!is_object($type)) {
      return redirect('/settings/password-types');
    }

    return view('settings.password_types.edit', ['type' => $type]);
  }

  public function create()
  {
    return view('settings.password_types.create');
  }

  public function update($id)
  {
    $this->passwordTypes->update($id, request()->only([
      'name',
      'icon'
    ]));

    return redirect('/settings/password-types');
  }

  public function store()
  {
    $this->passwordTypes->create(request()->only([
      'name',
      'icon'
    ]));

    return redirect('/settings/password-types');
  }

  public function delete($id)
  {
    $this->passwordTypes->delete($id);

    return redirect('/settings/password-types');
  }

  public function profile()
  {
    if (request()->isMethod('post')) {
      auth()->user()->saveProfile(request());
    }

    return view('settings.profile', ['user' => auth()->user()]);
  }

}
