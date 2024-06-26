<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = User::findByEmail($request->input('email'));

        if (! $user ||  Hash::check($request->get('password'), $user->get('password'))){
            return response()->json([
                'error' => 'The Provided credentials are incorrect.',
            ], 422);
        }

        $device = substr($request->userAgent() ?? '' , 0 , 255);

        return response()->json([
           'access_token' => $user->createToken($device)->plainTextToken,
        ]);
    }
}
