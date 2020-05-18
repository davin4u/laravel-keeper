<?php

namespace App\Http\Controllers;

use App\Repositories\PasswordGroupsRepository;
use Illuminate\Http\Request;

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
        $group = $this->passwordGroups->create([
            'name' => $this->request->get('name'),
            'icon' => $this->request->get('icon')
        ]);

        if ($group) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $data = [
            'name' => $this->request->get('name'),
            'icon' => $this->request->get('icon')
        ];

        if ($this->passwordGroups->update((int)$id, $data)) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($id)
    {
        return $this->passwordGroups->delete((int)$id) ? $this->success() : $this->error();
    }
}