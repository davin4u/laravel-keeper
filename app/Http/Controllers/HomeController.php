<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PasswordsRepository;
use Illuminate\Support\Facades\Storage;
use App\File;

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

  public function download($id)
  {
    $file = File::find($id);

    if (!empty($file)) {
      return response()->download(storage_path('app/public/' . $file->path), $file->original_name);
    }

    return response()->redirect()->back();
  }

  public function deleteFile($id)
  {
    $file = File::find($id);

    if (!empty($file)) {
      $entity = $file->entity();

      if (!is_object($entity) || !$entity->removable()) {
        return response()->json(['status' => 'fail']);
      }

      Storage::disk('public')->delete($file->path);

      $file->delete();
    }
  }
}
