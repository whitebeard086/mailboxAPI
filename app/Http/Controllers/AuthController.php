<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="Operations about authentication",
 * )
 */

class AuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/login",
     * summary="Login",
     * description="Login",
     * operationId="authLogin",
     * tags={"Authentication"},
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
     *       @OA\Property(property="user", ref="#/components/schemas/UserResource"),
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
            'user' => new UserResource($user)
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/user",
     * summary="Get authenticated user",
     * description="Get the currently logged in user",
     * operationId="authUser",
     * tags={"Authentication"},
     * @OA\Response(
     *    response=200,
     *    description="Get user success",
     *    @OA\JsonContent(
     *       @OA\Property(property="data", ref="#/components/schemas/UserResource")
     *    )
     * )
     * )
     */
    public function getAuthenticatedUser()
    {
        return response()->json([
            'user' => new UserResource(Auth::user())
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/logout",
     * summary="Logout",
     * description="Logout",
     * operationId="authLogout",
     * tags={"Authentication"},
     * @OA\Response(
     *    response=200,
     *    description="Logged out successfully",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Logged out")
     *    )
     * )
     * )
     */
    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
