<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function error()
    {
        return response()->json([
            'error' => 'Something went wrong. Please contact our support.'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFound()
    {
        return response()->json([
            'error' => 'Not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function success()
    {
        return response()->json([
            'success' => true,
            'user' => new UserResource(Auth::user())
        ], Response::HTTP_OK);
    }
}
