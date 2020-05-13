<?php

namespace App\Http\Controllers;

use App\PasswordGroup;
use App\Repositories\PasswordGroupsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordGroupsController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var PasswordGroupsRepository
     */
    protected $passwordGroups;

    /**
     * PasswordGroupsController constructor.
     * @param Request $request
     * @param PasswordGroupsRepository $passwordGroups
     */
    public function __construct(Request $request, PasswordGroupsRepository $passwordGroups)
    {
        $this->request = $request;

        $this->passwordGroups = $passwordGroups;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        if ($group = $this->passwordGroups->create(['name' => $this->request->get('name')])) {
            return response()->json([
                'success' => true,
                'group' => $group
            ]);
        }

        return $this->error();
    }
}