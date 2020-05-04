<?php

namespace App\Http\Controllers;

use App\PasswordGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordGroupsController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * PasswordGroupsController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $group = PasswordGroup::create([
            'user_id' => Auth::user()->id,
            'name' => $this->request->get('name')
        ]);

        return response()->json([
            'success' => true,
            'group' => $group
        ]);
    }
}