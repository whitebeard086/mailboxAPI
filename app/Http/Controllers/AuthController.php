<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/login",
     * summary="Login",
     * description="Login",
     * operationId="authLogin",
     * tags={"Auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *      required={"email", "password"},
     *      @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *      @OA\Property(property="password", type="string", format="password", example="Pass1234")
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Logged in successfully",
     *    @OA\JsonContent(
     *       @OA\Property(property="token", type="string", example="1|4BkCbzvtrpO6kU3Qk..."),
     *    )
     * )
     * )
     */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'token' => $token, 
        ]);
    }
}
