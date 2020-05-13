<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\UserResource;
use App\Project;
use App\Repositories\ProjectsRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ProjectsRepository
     */
    protected $projects;

    /**
     * @var \Illuminate\Contracts\Validation\Validator
     */
    protected $validator;

    /**
     * ProjectsController constructor.
     * @param Request $request
     * @param ProjectsRepository $projects
     */
    public function __construct(Request $request, ProjectsRepository $projects)
    {
        $this->request = $request;

        $this->projects = $projects;

        $this->validator = $this->makeValidator($this->request->all(), new StoreProjectRequest());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        if ($this->validator->fails()) {
            return response()->json([
                'errors' => $this->validator->errors()->toArray()
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($project = $this->projects->create($this->request->all())) {
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
        if ($this->validator->fails()) {
            return response()->json([
                'errors' => $this->validator->errors()->toArray()
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($this->projects->update((int)$id, $this->request->all())) {
            return $this->success();
        }

        return $this->notFound();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($id)
    {
        if ($this->projects->delete((int)$id)) {
            return $this->success();
        }

        return $this->notFound();
    }

    /**
     * @param array $data
     * @param FormRequest $requestClass
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function makeValidator(array $data, $requestClass)
    {
        return Validator::make($data, $requestClass->rules());
    }
}
