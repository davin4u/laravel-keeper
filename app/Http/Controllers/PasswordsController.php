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
     * @param Password $password
     * @return PasswordResource
     */
    public function show(Password $password)
    {
        return new PasswordResource($password);
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
            return response()->json([
                'success' => true,
                'user' => new UserResource(Auth::user())
            ], Response::HTTP_OK);
        }

        return response()->json([
            'error' => 'Something went wrong. Please contact our support'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param Password $password
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Password $password)
    {
        if ($this->validator->fails()) {
            return response()->json([
                'errors' => $this->validator->errors()->toArray()
            ], Response::HTTP_BAD_REQUEST);
        }

        $password->update($this->request->all());

        return response()->json([
            'success' => true,
            'user' => new UserResource(Auth::user())
        ], Response::HTTP_OK);
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
