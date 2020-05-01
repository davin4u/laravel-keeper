<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @var Request|null
     */
    protected $request = null;

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $email = $this->request->get('email');
        $password = $this->request->get('password');

        if (auth()->attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'success' => true
            ], Response::HTTP_OK);
        }

        return response()->json([
            'error' => 'Wong credentials.'
        ], Response::HTTP_BAD_REQUEST);
    }
}
