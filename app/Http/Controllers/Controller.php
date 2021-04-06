<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Models\Socket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validationError($errors)
    {
        return response(['body' => [
            'message'  => 'Validation error',
            'Validation error' => $errors
        ]],422);
    }

    public function MessageResponse($message, $status = 200)
    {
        return response(['body' => [
            'message' => $message
        ]],$status);
    }

    public function brand()
    {
        return response([
            'body' => [
                'brands' => BrandResource::collection(Brand::all())
            ]
        ]);
    }

    public function socket()
    {
        return response([
            'body' => [
                'sockets' => BrandResource::collection(Socket::all())
            ]
        ]);
    }
}
