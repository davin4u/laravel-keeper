<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use App\Http\Resources\PasswordResource;
use App\Http\Resources\UserResource;
use App\Password;
use App\Repositories\PasswordsRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class PasswordsController
 * @package App\Http\Controllers
 */
class PasswordsController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var \Illuminate\Contracts\Validation\Validator
     */
    protected $validator;

    /**
     * @var PasswordsRepository
     */
    protected $passwords;

    /**
     * PasswordsController constructor.
     * @param Request $request
     * @param PasswordsRepository $passwords
     */
    public function __construct(Request $request, PasswordsRepository $passwords)
    {
        $this->request = $request;

        $this->passwords = $passwords;

        $this->validator = $this->makeValidator($this->request->all(), new StorePasswordRequest());
    }

    /**
     * @param $id
     * @return PasswordResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if ($password = $this->passwords->getById((int)$id)) {
            return new PasswordResource($password);
        }

        return $this->notFound();
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

        if ($password = $this->passwords->create($this->request->all())) {
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

        if ($this->passwords->update((int)$id, $this->request->all())) {
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
        if ($this->passwords->delete((int)$id)) {
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
        $data = array_filter($data, function ($item) {
            return (bool) $item;
        });

        return Validator::make($data, $requestClass->rules());
    }
}
