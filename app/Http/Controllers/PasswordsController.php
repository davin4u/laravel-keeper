<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectsRepository;
use App\Password;
use App\PasswordsRepository;

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
        
    }
}
