<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PasswordsRepository;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(\App\Repositories\PasswordsRepository $passwords)
  {
    return view('home', [
      'lastViewed' => $passwords->getLastViewed()
    ]);
  }
}
