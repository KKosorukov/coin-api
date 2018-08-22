<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

/**
 * This controller uses by anyone for auth
 *
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->post('login'),
            'password' => $request->post('password')
        ];

        $rememberMe = $request->post('rememberMe');

        if (! $token = auth()->attempt($credentials, true)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(UserResource::make(auth()->user()));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $expires_time = auth()->factory()->getTTL() * 60;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expires_time,
            'create_time' => time() + $expires_time,
            'is_activated' => $this->_isActivatedCurrentUser(),
            'user' => UserResource::make(auth()->user())
        ]);
    }

    /**
     * Get activation status of current user
     *
     * @return bool
     */
    private function _isActivatedCurrentUser() {
        $user = Sentinel::findById(auth()->user()->id);
        $activationRecord = Activation::exists($user);
        return $activationRecord && $activationRecord->completed;
    }
}
