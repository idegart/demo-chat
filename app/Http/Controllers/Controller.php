<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function successJsonResponse(array $data = []): JsonResponse
    {
        return $this->jsonResponse(true, $data);
    }

    protected function errorJsonResponse(array $errors = []): JsonResponse
    {
        return $this->jsonResponse(false, [], $errors);
    }

    private function jsonResponse(bool $success, array $data = [], array $errors = [], $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json(compact('success', 'data', 'errors'), $status);
    }
}
